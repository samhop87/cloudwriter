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

    public function show(): ?Collection
    {
        $id = request()->project_id;

        // TODO: this should return a page.
        return $this->googleDriveApiService->retrieveProject($id);
    }

    public function delete($id)
    {
        return $this->googleDriveApiService->deleteFile($id);
    }
}
