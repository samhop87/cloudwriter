<?php

namespace App\Http\Controllers;

use App\Interfaces\DriveConnectionInterface;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class GoogleDriveConnectionController extends Controller
{
    private DriveConnectionInterface $googleDriveConnectionService;

    public function __construct(DriveConnectionInterface $googleDriveConnectionService)
    {
        $this->googleDriveConnectionService = $googleDriveConnectionService;
    }

    public function generateAuthRequest(): Redirector|Application|RedirectResponse
    {
        return redirect($this->googleDriveConnectionService->auth());
    }
}
