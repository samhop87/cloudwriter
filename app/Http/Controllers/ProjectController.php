<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Interfaces\DriveApiInterface;
use App\Models\User\Project;
use Google\Service\Drive\DriveFile;
use Illuminate\Support\Collection;

class ProjectController extends Controller
{
    private DriveApiInterface $googleDriveApiService;

    public function __construct(DriveApiInterface $googleDriveApiService)
    {
        $this->googleDriveApiService = $googleDriveApiService;
    }

    public function create(ProjectRequest $request): DriveFile
    {
        return $this->googleDriveApiService->createFolder($request->name);
    }

    public function show(Project $project): ?Collection
    {
        return $this->googleDriveApiService->retrieveProject($project->id);
    }

    public function delete($id)
    {
        return $this->googleDriveApiService->deleteFile($id);
    }
}
