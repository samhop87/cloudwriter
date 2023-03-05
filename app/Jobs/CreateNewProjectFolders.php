<?php

namespace App\Jobs;

use App\Interfaces\DriveConnectionInterface;
use App\Models\User\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateNewProjectFolders implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Project $project;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Project $project)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        for($i = 2; $i <= 12; $i++) {
            app(DriveConnectionInterface::class)->createFolder(name: 'Chapter ' . $i, folder_id: $this->project->project_id, order: $i);
        }
    }
}
