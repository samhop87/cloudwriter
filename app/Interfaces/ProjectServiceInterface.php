<?php

namespace App\Interfaces;


/**
 * Class ProjectService
 */
interface ProjectServiceInterface
{
    public function handleProject();

    public function refreshProject($project_id): mixed;
}
