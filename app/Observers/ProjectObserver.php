<?php

namespace App\Observers;

use App\Jobs\CreateNewProjectFolders;
use App\Jobs\CreateProjectOnGoogle;
use App\Models\User\Project;

class ProjectObserver
{
    /**
     * Handle the Project "created" event.
     *
     * @param Project $project
     * @return void
     */
    public function created(Project $project)
    {
//        CreateProjectOnGoogle::dispatch($project);
    }

    /**
     * Handle the Project "updated" event.
     *
     * @param Project $project
     * @return void
     */
    public function updated(Project $project)
    {
        dd('updated');
        if ($project->isDirty('project_id')) {
            dd('project_id changed');
            CreateNewProjectFolders::dispatch($project);
        }
    }

    /**
     * Handle the Project "deleted" event.
     *
     * @param Project $project
     * @return void
     */
    public function deleted(Project $project)
    {
        //
    }

    /**
     * Handle the Project "restored" event.
     *
     * @param Project $project
     * @return void
     */
    public function restored(Project $project)
    {
        //
    }

    /**
     * Handle the Project "force deleted" event.
     *
     * @param Project $project
     * @return void
     */
    public function forceDeleted(Project $project)
    {
        //
    }
}
