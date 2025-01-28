<?php

namespace snype\Nplusone;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class NPlusOneLoggerServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/nplusone.php', 'nplusone'
        );
    }

    public function boot()
    {
            // Publish the configuration file to the application's config directory
            $this->publishes([
                __DIR__ . '/../config/nplusone.php' => config_path('nplusone.php'),
            ], 'config');

        //listen to db queries
        if ($this->app->environment() !== 'production') {
            \DB::listen(function ($query) {
                // Check for N+1 query patterns here
                if ($this->isNPlusOneQuery($query)) {
                    // Capture the backtrace to see where the query was triggered
                    $backtrace = debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 3);
                    $caller = isset($backtrace[2]) ? $backtrace[2] : null;
                    $file = $caller['file'] ?? 'N/A';
                    $line = $caller['line'] ?? 'N/A';

                    // Log the N+1 query with the file and line number
                    Log::warning('N+1 Query Detected: ' . $query->sql, [
                        'bindings' => $query->bindings,
                        'time' => $query->time,
                        'file' => $file,
                        'line' => $line,
                    ]);
                }
            });
        }
    }

    private function isNPlusOneQuery($query)
    {
        // Implement logic to detect N+1 queries (you can refine this as needed)
        return str_contains($query->sql, 'select') && count($query->bindings) > 1;
    }
}
