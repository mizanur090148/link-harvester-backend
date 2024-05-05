<?php

namespace App\Jobs;

use App\Repositories\Interfaces\DomainRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Throwable;

class ProcessUrlJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $urls;
    protected DomainRepositoryInterface $repository;
    /**
     * Create a new job instance.
     */
    public function __construct($urls, DomainRepositoryInterface $repository)
    {
        $this->repository = $repository;
        $this->urls = $urls;
    }

    /**
     * @throws Throwable
     */
    public function handle(): void
    {
        foreach ($this->urls as $url) {
            $this->repository->store($url);
        }
    }
}
