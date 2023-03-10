<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\GenreResource;
use App\Interfaces\DriveApiInterface;
use App\Interfaces\ProjectServiceInterface;
use App\Models\Genre;
use App\Models\ProjectDetail;
use App\Models\User\Project;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    private DriveApiInterface $googleDriveApiService;
    private ProjectServiceInterface $projectService;

    public function __construct(
        DriveApiInterface       $googleDriveApiService,
        ProjectServiceInterface $projectService,
    )
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
        return Inertia::render('Wizard/CreationWizard', [
            'shapes' => config('cloudwriter.story_shapes'),
            'genres' => GenreResource::collection(Genre::whereNull('parent_id')->with('subGenres')->get()),
        ]);
    }

    public function store(ProjectRequest $request): Response
    {
        $project = Project::create([
            'user_id' => auth()->id(),
            'project_name' => $request->project_name,
        ]);

        ProjectDetail::create([
            'project_id' => $project->project_id,
            'genre_id' => $request->themeChoice[0]['id'], // for testing purposes, but this will need to change
            'shape_id' => $request->shapeChoice,
            'pov' => $request->pov['name'],
        ]);

        // What do I return here?
        return Inertia::render('Wizard/StageOne', [

        ]);
    }

    public function show(): Redirector|Application|RedirectResponse
    {
        $this->projectService->handleProject(project_id: request()->project_id);

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
