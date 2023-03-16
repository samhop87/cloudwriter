<?php

namespace App\Jobs;

use App\Interfaces\ChatGPTServiceInterface;
use App\Interfaces\DriveApiInterface;
use App\Models\User;
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
        $this->project = $project;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(DriveApiInterface $service, ChatGPTServiceInterface $chatGPTService)
    {
        $files = collect([]);

        $user = User::find($this->project->user_id);

        for($i = 1; $i <= 12; $i++) {
            $folder = $service->createFolder(
                name: 'Chapter ' . $i,
                folder_id: $this->project->project_id,
                order: $i,
                user: $user,
            );

            $file = $service->createFile(folder_id: $folder->getId(), title: "prompt for Chapter $i", user: $user);

            $files->push($file->getId());
        }

        // Contains file IDs as keys, and prompts as values.
        $filesArray = $chatGPTService->generatePrompts(project: $this->project, file_ids: $files);


        // TODO: broadcast success
    }
}
