<?php
// app/Services/LLMQueryGenerator.php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class LLMQueryGenerator
{
    public function generateQuery(string $prompt, string $table): ?string
    {
        $apiKey = config('services.gemini.key');
        if (!$apiKey) {
            throw new \Exception('Gemini API key not configured');
        }

        $context = "You are a SQL query generator. Generate ONLY SELECT queries for table: $table. 
                   Return ONLY the SQL query without any explanation, formatting, or backticks.
                   Important: No UPDATE, DELETE, INSERT, DROP, or ALTER queries.
                   Prompt: $prompt";

        try {
            $response = Http::timeout(30)->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $context]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.1,
                    'maxOutputTokens' => 100,
                ]
            ]);

            $data = $response->json();
            
            if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                $generatedQuery = trim($data['candidates'][0]['content']['parts'][0]['text']);
                
                // Clean up the response - remove backticks and SQL keywords if present
                $generatedQuery = str_replace(['```sql', '```'], '', $generatedQuery);
                $generatedQuery = trim($generatedQuery);
                
                return $generatedQuery;
            }

            return null;
        } catch (\Exception $e) {
            throw new \Exception('Failed to generate query: ' . $e->getMessage());
        }
    }

    public function detectSuspiciousPrompt(string $prompt): bool
    {
        $suspiciousKeywords = ['update', 'delete', 'insert', 'drop', 'alter', 'modify', 'truncate', 'create', 'replace', 'set'];
        $promptLower = strtolower($prompt);
        
        foreach ($suspiciousKeywords as $keyword) {
            if (str_contains($promptLower, $keyword)) {
                return true;
            }
        }
        
        return false;
    }

    public static function generatePromptAndGetResponse(string $prompt): ?string
    {
        $apiKey = config('services.gemini.key');
        if (!$apiKey) {
            throw new \Exception('Gemini API key not configured');
        }

        $context = "You are a common prompt receiver who receives prompts from users. and responds to them. but ensure no harm response pass to user, but if 
        user ask for specified format and says less verbose then you should follow strictly the format. Prompt: $prompt, finally you must pass response as user defines
        in format like: ```sql, ```json, ```xml or direct plain text";

        try {
            $response = Http::timeout(30)->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => $context]
                        ]
                    ]
                ],
                'generationConfig' => [
                    'temperature' => 0.1,
                    'maxOutputTokens' => 500,
                ]
            ]);

            $data = $response->json();
            
            if (isset($data['candidates'][0]['content']['parts'][0]['text'])) {
                $generatedQuery = trim($data['candidates'][0]['content']['parts'][0]['text']);
                
                
                return $generatedQuery;
            }

            return null;
        } catch (\Exception $e) {
            throw new \Exception('Failed to generate response: ' . $e->getMessage());
        }
    }
}