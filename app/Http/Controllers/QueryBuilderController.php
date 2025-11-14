<?php
// app/Http/Controllers/QueryBuilderController.php

namespace App\Http\Controllers;

use App\Services\LLMQueryGenerator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class QueryBuilderController extends Controller
{
    public function index()
    {
        $notAllowedTables = ['migrations', 'password_reset_tokens', 'failed_jobs', 'personal_access_tokens', 'settings'];
        $allTables = $this->getAllTables();
        $allowedTables = array_diff($allTables, $notAllowedTables);

        return view('queryBuilder.query-builder', compact('allowedTables'));
    }

    public function getColumns(string $table)
    {
        $notAllowedTables = ['migrations', 'password_reset_tokens', 'failed_jobs', 'personal_access_tokens', 'settings'];
        $allTables = $this->getAllTables();
        $allowedTables = array_diff($allTables, $notAllowedTables);

        if (!in_array($table, $allowedTables)) {
            return response()->json(['error' => 'Table not allowed'], 404);
        }

        try {
            $columns = Schema::getColumnListing($table);
            $columns = array_values($columns);
            $columnTypes = [];

            foreach ($columns as $column) {
                $columnTypes[$column] = Schema::getColumnType($table, $column);
            }

            return response()->json([
                'columns' => $columns,
                'column_types' => $columnTypes
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch columns'], 500);
        }
    }

    public function execute(Request $request)
    {
        $notAllowedTables = ['migrations', 'password_reset_tokens', 'failed_jobs', 'personal_access_tokens'];
        $allTables = $this->getAllTables();
        $allowedTables = array_diff($allTables, $notAllowedTables);

        $validated = $request->validate([
            'table' => 'required|in:' . implode(',', $allowedTables),
            'prompt' => 'nullable|string|max:500',
            'columns' => 'nullable|array',
            'filters' => 'nullable|array',
            'sort_by' => 'nullable|string',
            'sort_order' => 'nullable|in:asc,desc',
            'limit' => 'nullable|integer|min:1|max:1000'
        ]);

        // Generate query based on options or AI prompt
        if (!empty($request->prompt)) {
            $llmService = new LLMQueryGenerator();

            if ($llmService->detectSuspiciousPrompt($request->prompt)) {
                return response()->json([
                    'warning' => 'Suspicious prompt detected. Further attempts might block your access.',
                    'suspicious' => true
                ], 422);
            }

            $query = $llmService->generateQuery($request->prompt, $request->table);
        } else {
            // Build query from options
            $query = $this->buildQueryFromOptions($request);
        }

        if (!$query) {
            return response()->json(['error' => 'Failed to generate query'], 422);
        }

        // Validate it's a SELECT query
        if (!$this->isSelectQuery($query)) {
            return response()->json(['error' => 'Only SELECT queries are allowed'], 422);
        }

        // Execute query
        try {
            $results = DB::select($query);
            return response()->json([
                'data' => $results,
                'query' => $query,
                'count' => count($results)
            ]);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Query execution failed: ' . $e->getMessage()], 422);
        }
    }

    private function getAllTables(): array
    {
        return array_map('current', DB::select('SHOW TABLES'));
    }

    private function buildQueryFromOptions(Request $request): string
    {
        $table = $request->table;

        // Select columns
        $columns = empty($request->columns) ? ['*'] : $request->columns;
        $select = implode(', ', array_map(function ($col) {
            return $col === '*' ? '*' : "`$col`";
        }, $columns));

        $query = "SELECT $select FROM `$table`";

        // Add WHERE conditions
        $whereConditions = [];
        if (!empty($request->filters)) {
            foreach ($request->filters as $filter) {
                if (!empty($filter['column']) && !empty($filter['operator'])) {
                    $column = $filter['column'];
                    $operator = $filter['operator'];

                    if (in_array($operator, ['IS NULL', 'IS NOT NULL'])) {
                        $whereConditions[] = "`$column` $operator";
                    } else {
                        if (!isset($filter['value'])) {
                            continue;
                        }
                        $value = DB::getPdo()->quote($filter['value']);

                        if (in_array($operator, ['LIKE', 'NOT LIKE'])) {
                            $value = DB::getPdo()->quote("%{$filter['value']}%");
                        }

                        $whereConditions[] = "`$column` $operator $value";
                    }
                }
            }
        }

        if (!empty($whereConditions)) {
            $query .= " WHERE " . implode(' AND ', $whereConditions);
        }

        // Add ORDER BY
        if (!empty($request->sort_by)) {
            $sortOrder = $request->sort_order ?? 'asc';
            $query .= " ORDER BY `{$request->sort_by}` $sortOrder";
        }

        // Add LIMIT
        if (!empty($request->limit)) {
            $limit = intval(min($request->limit, 500));
            $query .= " LIMIT $limit";
        }

        // default LIMIT
        if (empty($request->limit)) {
            $query .= " LIMIT 10";
        }

        return $query;
    }

    private function isSelectQuery(string $query): bool
    {
        $cleanQuery = strtolower(trim($query));
        return str_starts_with($cleanQuery, 'select');
    }
}