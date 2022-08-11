<?php

namespace App\Services;

use App\Interfaces\DriveApiInterface;

class ProjectService
{
    private DriveApiInterface $googleApiDriveService;

    public function __construct(DriveApiInterface $googleDriveApiService)
    {
        $this->googleApiDriveService = $googleDriveApiService;
    }

    public function handleProject()
    {

    }

}
