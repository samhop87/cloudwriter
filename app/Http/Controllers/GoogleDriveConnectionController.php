<?php

namespace App\Http\Controllers;

use App\Interfaces\DriveConnectionInterface;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Auth;

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

    public function authorise()
    {
        if (request()->code) {
            $user = User::find(1);
            $user->drive_token = $this->googleDriveConnectionService->generateBearerToken(request()->code);
            $user->save();
        }

        return 'authorised';
    }
}
