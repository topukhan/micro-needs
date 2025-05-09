<?php

namespace App\Http\Controllers\Redis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redis;

class RedisWizardController extends Controller
{
    public function index()
    {
        return view('redis.create');
    }

    public function generateCommand(Request $request)
    {
        $request->validate(['input' => 'required|string']);
        
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json'
            ])->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key='.env('GEMINI_API_KEY'), [
                'contents' => [
                    'parts' => [
                        ['text' => "Convert this to exact Redis command only, no explanations no code only plain text:\n\n".$request->input]
                    ]
                ]
            ]);


            if ($response->failed()) {
                $msg = 'Failed to generate command';
                return response()->json([
                    'success' => false,
                    'message' => $msg
                ], 500);
            }
            $command = $response->json()['candidates'][0]['content']['parts'][0]['text'] ?? '';

            return response()->json([
                'success' => true,
                'command' => trim($command),
                'input' => $request->input
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gemini API error: '.$e->getMessage()
            ], 500);
        }
    }

    public function executeCommand(Request $request)
    {
        $request->validate(['command' => 'required|string']);
        
        try {
            // Split command into parts
            $parts = explode(' ', $request->command);
            $redisCommand = strtoupper(array_shift($parts));
            
            $redis = new \Predis\Client([
                'host' => env('REDIS_HOST'),
                'port' => env('REDIS_PORT'),
                'database' => env('REDIS_DB'),
            ]);

            $result = $redis->executeRaw(array_merge([$redisCommand], $parts));

            return response()->json([
                'success' => true,
                'result' => $result,
                'command' => $request->command
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Redis error: '.$e->getMessage()
            ], 500);
        }
    }
}