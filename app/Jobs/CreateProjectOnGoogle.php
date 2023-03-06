<?php

namespace App\Jobs;

use App\Interfaces\DriveApiInterface;
use App\Interfaces\DriveConnectionInterface;
use App\Models\User;
use App\Models\User\Project;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateProjectOnGoogle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private Project $project;
    private User $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Project $project, User $user)
    {
        $this->project = $project;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $project = app(DriveApiInterface::class)->createFolder(
                name: $this->project->project_name,
                order: 1,
                user: $this->user,
            );

        $this->project->update([
            'project_id' => $project->getId()
        ]);
    }
}
