<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectRequest;
use App\Interfaces\DriveApiInterface;
use App\Models\User\Project;
use Google\Service\Drive\DriveFile;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;

class ProjectController extends Controller
{
    private DriveApiInterface $googleDriveApiService;

    public function __construct(DriveApiInterface $googleDriveApiService)
    {
        $this->googleDriveApiService = $googleDriveApiService;
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
        $retrievedProject = Project::where('project_id', request()->project_id)->first();

        $project = collect([]);

        // TODO: this should all be done on the vue side;
        //  add the object immediately, greyed out until the id from google drive has been returned,
        //  at which point it is attached to the object and a user can click through.
        //  when they click to any other file, or the created file, the project is updated and the 'real' file is added
        //  to the tree.
//        if (empty(session('current_project')) || empty(session('current_project')[request()->project_name])) {
        $project->push([
            'id' => $retrievedProject->project_id,
            'name' => $retrievedProject->project_name,
            'project' => $this->googleDriveApiService->retrieveProject($retrievedProject->project_id)
        ]);

        session(['current_project' => $project->first()]);
//        }

        return redirect(route('project.edit'));
    }

    public function delete($id)
    {
        return $this->googleDriveApiService->deleteFile($id);
    }
}
