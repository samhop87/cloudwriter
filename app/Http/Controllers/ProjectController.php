<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Interfaces\DriveApiInterface;
use App\Services\ProjectService;
use Google\Service\Drive\DriveFile;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    private DriveApiInterface $googleDriveApiService;

    private ProjectService $projectService;

    public function __construct(DriveApiInterface $googleDriveApiService, ProjectService $projectService)
    {
        $this->googleDriveApiService = $googleDriveApiService;
        $this->projectService = $projectService;
    }

    public function index(): Response
    {
        return Inertia::render('OpenProject', [
            'project' => session('current_project'),
        ]);
    }

    public function create(ProjectRequest $request): DriveFile
    {
        return $this->googleDriveApiService->createFolder($request->name);
    }

    public function show(): Redirector|Application|RedirectResponse
    {
        // TODO: the session needs checking; is this first time or a refresh?
        $this->projectService->refreshProject(request()->project_id);

        return redirect(route('project.edit'));
    }

    public function delete($id)
    {
        return $this->googleDriveApiService->deleteFile($id);
    }
}
