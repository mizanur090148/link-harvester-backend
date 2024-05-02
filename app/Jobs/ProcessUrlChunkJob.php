<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessUrlChunkJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $urls;
    /**
     * Create a new job instance.
     */
    public function __construct($urls)
    {dd(999);
        $this->urls = $urls;
    }

    /**
     * Execute the job.
     */
    public function handle()
    {
        foreach ($this->urls as $url) {
            // Process URL and insert into database
        }
    }
}
