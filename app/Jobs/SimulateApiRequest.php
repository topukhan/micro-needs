<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log; // Make sure Log facade is imported

class SimulateApiRequest implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public int $requestId)
    {
        //
    }

    public function handle()
    {
        try {
            Log::info("Processing job for request #{$this->requestId}"); // Log job start

            // Simulate API processing time
            usleep(random_int(500000, 1500000));

            // Get existing logs array or create a new one
            $logs = cache()->get('request_logs', []);
            $logs[] = "Processed API request #{$this->requestId}";
            cache()->put('request_logs', $logs);

            // Increment processed count
            $processedBefore = (int)cache()->get('processed_requests', 0);
            Log::info("Request #{$this->requestId}: Processed count BEFORE increment: {$processedBefore}"); // Log before increment
            cache()->put('processed_requests', $processedBefore + 1);
            $processedAfter = (int)cache()->get('processed_requests', 0); // Re-fetch to confirm
            Log::info("Request #{$this->requestId}: Processed count AFTER increment: {$processedAfter}"); // Log after increment

            // Rate limiting logic (every 3rd request)
            if ($this->requestId % 3 === 0) {
                $rateLimited = (int)cache()->get('rate_limited_requests', 0);
                cache()->put('rate_limited_requests', $rateLimited + 1);

                $logs = cache()->get('request_logs', []);
                $logs[] = "Rate limit hit! Pausing for 3 seconds before request #{$this->requestId}";
                cache()->put('request_logs', $logs);

                sleep(3);

                $logs = cache()->get('request_logs', []);
                $logs[] = "Resumed after rate limit - processing request #{$this->requestId}";
                cache()->put('request_logs', $logs);
            }
        } catch (\Exception $e) {
            // Log any errors
            Log::error("Job error for request #{$this->requestId}: " . $e->getMessage(), ['exception' => $e]); // Log exceptions
        }
    }
}
