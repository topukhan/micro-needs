<?php

namespace App\Http\Controllers;

use App\Jobs\SimulateApiRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApiSimulatorController extends Controller
{
    public function index()
    {
        return view('queue.api_simulator');
    }

    public function dispatchRequests(Request $request)
    {
        $count = $request->integer('count', 10);
        $count = min($count, 50);

        // Clear previous values and initialize
        cache()->put('processed_requests', 0);
        cache()->put('rate_limited_requests', 0);
        cache()->put('request_logs', []);

        for ($i = 1; $i <= $count; $i++) {
            SimulateApiRequest::dispatch($i);
        }

        return response()->json([
            'success' => true,
            'message' => "Dispatched {$count} API request jobs!",
            'initial_pending' => $count,
        ]);
    }

    public function getQueueStatus()
    {
        $processed = (int) cache()->get('processed_requests', 0);
        $rateLimited = (int) cache()->get('rate_limited_requests', 0);
        $pending = DB::table('jobs')->count();
        $logs = cache()->get('request_logs', []);

        return response()->json([
            'processed' => $processed,
            'rate_limited' => $rateLimited,
            'pending' => $pending,
            'logs' => $logs,
        ]);
    }
}
