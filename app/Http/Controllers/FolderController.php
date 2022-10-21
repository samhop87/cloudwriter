<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateFolderRequest;
use App\Interfaces\DriveApiInterface;
use App\Interfaces\ProjectServiceInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class FolderController extends Controller
{
    private DriveApiInterface $googleDriveApiService;

    private ProjectServiceInterface $projectService;

    /**
     * @param  DriveApiInterface  $googleDriveApiService
     * @param  ProjectServiceInterface  $projectService
     */
    public function __construct(DriveApiInterface $googleDriveApiService, ProjectServiceInterface $projectService)
    {
        $this->googleDriveApiService = $googleDriveApiService;
        $this->projectService = $projectService;
    }

    /**
     * @param  CreateFolderRequest  $request
     * @return Redirector|Application|RedirectResponse
     */
    public function create(CreateFolderRequest $request): Redirector|Application|RedirectResponse
    {
        $this->googleDriveApiService->createFolder(
            name: $request->title,
            folder_id: $request->parent_folder_id,
            order: $request->order,
        );

        $project_id = session('current_project')['id'];

        $this->projectService->refreshProject($project_id);

        // This functionality is temporary until all resourceful controllers are working;
        // it should be the case that this is an api endpoint which creates the file/folder;
        // The FE should add a pseudo card which does not reflect the project tree until the latter is updated.
        return redirect(route('project.edit'));
    }

    /**
     * @return Redirector|Application|RedirectResponse
     */
    public function delete(): Redirector|Application|RedirectResponse
    {
        $this->googleDriveApiService->deleteFile(request()->folder_id);

        $project_id = session('current_project')['id'];

        $this->projectService->refreshProject($project_id);

        return redirect(route('project.edit'));
    }
}
