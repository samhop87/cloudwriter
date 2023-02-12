<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Interfaces\DriveApiInterface;
use App\Models\User\Project;
use App\Services\ProjectService;
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

    public function create(): Response
    {
        return Inertia::render('Wizard/CreationWizard');
//        return $this->googleDriveApiService->createFolder(name: $request->name);
    }

    public function store(ProjectRequest $request)
    {
        $project = $this->googleDriveApiService->createFolder(name: $request->project_name, order: 1);

        Project::create([
            'user_id' => auth()->id(),
            'project_id' => $project->getId(),
            'project_name' => $request->project_name,
        ]);

        return Inertia::render('Wizard/StageOne', [
            'shapes' => config('cloudwriter.story_shapes')
        ]);
    }

    public function show(): Redirector|Application|RedirectResponse
    {
        // TODO: the session needs checking; is this first time or a refresh?
        $this->projectService->refreshProject(project_id: request()->project_id);

        return redirect(route('project.edit'));
    }

    public function delete($projectId): Redirector|Application|RedirectResponse
    {
        $this->authorize('delete', Project::where('project_id', $projectId)->first());

        $this->googleDriveApiService->deleteFile(id: $projectId);

        Project::where('project_id', $projectId)->delete();

        return redirect()->route('baseboard.index')->with('message', 'Project Deleted Successfully');
    }
}
