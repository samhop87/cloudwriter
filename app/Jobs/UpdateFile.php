<?php

namespace App\Jobs;

use App\Interfaces\DriveApiInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateFile implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private string $file_id;
    private string $prompt;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $file_id, string $prompt)
    {
        $this->file_id = $file_id;
        $this->prompt = $prompt;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DriveApiInterface $service)
    {
        $service->updateFile(file_id: $this->file_id, file_text: $this->prompt);
    }
}
