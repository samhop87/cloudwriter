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

    /**
     * @param string $project_id
     * @param bool $refresh
     * @return mixed
     */
    public function handleProject(string $project_id, bool $refresh = false): mixed
    {
        return $project_id === session('meta_data.project_id') && !$refresh
            ? session('current_project')
            : $this->refreshProject($project_id);
    }

    /**
     * @param string $project_id
     * @return Application|SessionManager|Store|mixed
     */
    public function refreshProject(string $project_id): mixed
    {
        $project = Project::where('project_id', $project_id)->first();

        return session([
            'current_project' => $this->googleApiDriveService
                ->retrieveProject(folder_id: $project->project_id)
                ->sortBy('order')
                ->values(),
            'meta_data' => [
                'project_id' => $project->project_id,
                'project_name' => $project->project_name,
            ]
        ]);
    }
}
