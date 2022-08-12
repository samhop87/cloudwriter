<?php

namespace App\Services;

use App\Interfaces\DriveApiInterface;
use App\Models\User\Project;

class ProjectService
{
    private DriveApiInterface $googleApiDriveService;

    public function __construct(DriveApiInterface $googleDriveApiService)
    {
        $this->googleApiDriveService = $googleDriveApiService;
    }

    public function handleProject()
    {

    }

    public function refreshProject($project_id)
    {
        $retrievedProject = Project::where('project_id', request()->project_id)->first();

        $project = collect([]);

        $project->push([
            'id' => $retrievedProject->project_id,
            'name' => $retrievedProject->project_name,
            'project' => $this->googleApiDriveService->retrieveProject($retrievedProject->project_id)
        ]);

        session(['current_project' => $project->first()]);
    }

}