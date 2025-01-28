<?php

namespace snype\Nplusone\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class NPlusOneLogCommand extends Command
{
    protected $signature = 'nplusone:log';
    protected $description = 'Display N+1 query logs';

    public function handle()
    {
        $logs = Log::channel('daily')->getLogs();
        $this->info("N+1 Query Logs:");
        foreach ($logs as $log) {
            $this->line($log);
        }
    }
}
