<?php

namespace App\Interfaces;

/**
 * Class ProjectService
 */
interface ProjectServiceInterface
{
    public function handleProject(string $project_id, bool $refresh = false);

    public function refreshProject(string $project_id): mixed;
}
