<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Http\Resources\GenreResource;
use App\Interfaces\ChatGPTServiceInterface;
use App\Interfaces\DriveApiInterface;
use App\Interfaces\ProjectServiceInterface;
use App\Models\Genre;
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
    private ProjectServiceInterface $projectService;
    private ChatGPTServiceInterface $chatGPTService;

    public function __construct(
        DriveApiInterface $googleDriveApiService,
        ProjectServiceInterface $projectService,
        ChatGPTServiceInterface $chatGPTService,
    )
    {
        $this->googleDriveApiService = $googleDriveApiService;
        $this->projectService = $projectService;
        $this->chatGPTService = $chatGPTService;
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

    public function store(ProjectRequest $request)
    {
        $newProject = Project::create([
            'user_id' => auth()->id(),
            'project_name' => $request->project_name,
            'project_id' => 'test',
        ]);

        $project = $this->googleDriveApiService->createFolder(name: $request->project_name, order: 1);

        $newProject->update([
            'project_id' => $project->getId()
        ]);
        // TODO: this will be where the call to ChatGPT will be made
        // Depending on the options chosen, the story will be scaffolded and the user will be taken to the editor
//        $this->chatGPTService->nextSentence();

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
