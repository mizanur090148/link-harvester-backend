<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\ProcessUrlChunkJob;

class ProcessUrlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $urls;
    /**
     * Create a new job instance.
     */
    public function __construct($urls)
    {dd($this->urls);
        $this->urls = $urls;
    }

    public function handle()
    {
        $batch = Bus::batch([])->dispatch();

        // Chunk the URLs into smaller arrays
        $chunks = array_chunk($this->urls, 2); // Chunk size of 100 URLs

        foreach ($chunks as $chunk) {
            $batch->add(new ProcessUrlChunkJob($chunk));
        }

        return $batch;
    }
}
