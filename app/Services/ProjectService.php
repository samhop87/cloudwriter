<?php

namespace App\Services;

use App\Interfaces\DriveApiInterface;
use App\Interfaces\ProjectServiceInterface;
use App\Models\User\Project;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Session\SessionManager;
use Illuminate\Session\Store;

/**
 * Class ProjectService
 */
class ProjectService implements ProjectServiceInterface
{
    /**
     * @var DriveApiInterface
     */
    private DriveApiInterface $googleApiDriveService;

    public function __construct(DriveApiInterface $googleDriveApiService)
    {
        $this->googleApiDriveService = $googleDriveApiService;
    }

    public function handleProject()
    {
    }

    /**
     * @param $project_id
     * @return Application|SessionManager|Store|mixed
     */
    public function refreshProject($project_id): mixed
    {
        $retrievedProject = Project::where('project_id', $project_id)->first();

        $project = collect([]);

        $project->push([
            'id' => $retrievedProject->project_id,
            'name' => $retrievedProject->project_name,
            'project' => $this->googleApiDriveService->retrieveProject(folder_id: $retrievedProject->project_id),
        ]);

        $ordered = $project->first()['project']->sortBy('order')->values();

        return session(['current_project' => $ordered]);
    }
}
