<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFolderRequest;
use App\Interfaces\DriveApiInterface;
use App\Services\ProjectService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class FolderController extends Controller
{
    /**
     * @var DriveApiInterface
     */
    private DriveApiInterface $googleDriveApiService;

    private ProjectService $projectService;

    /**
     * @param  DriveApiInterface  $googleDriveApiService
     * @param  ProjectService  $projectService
     */
    public function __construct(DriveApiInterface $googleDriveApiService, ProjectService $projectService)
    {
        $this->googleDriveApiService = $googleDriveApiService;
        $this->projectService = $projectService;
    }

    public function create(CreateFolderRequest $request): Redirector|Application|RedirectResponse
    {
        $this->googleDriveApiService->createFolder(name: $request->title, folder_id: $request->parent_folder_id);

        $project_id = session('current_project')->get('project_id');

        $this->projectService->refreshProject($project_id);

        // This functionality is temporary until all resourceful controllers are working;
        // it should be the case that this is an api endpoint which creates the file/folder;
        // The FE should add a pseudo card which does not reflect the project tree until the latter is updated.
        return redirect(route('project.edit'));
    }

    public function delete($folder_id): Redirector|Application|RedirectResponse
    {
        $this->googleDriveApiService->deleteFile($folder_id);

        $project_id = session('current_project')->get('project_id');

        $this->projectService->refreshProject($project_id);

        return redirect(route('project.edit'));
    }
}
