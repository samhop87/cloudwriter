<?php

namespace App\Http\Controllers;

use App\Interfaces\DriveConnectionInterface;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;
use Inertia\Inertia;
use Inertia\Response;

/**
 * class GoogleDriveConnectionController
 *
 * Responsible for establishing oAuth credentials for user
 */
class GoogleDriveConnectionController extends Controller
{
    private DriveConnectionInterface $googleDriveConnectionService;

    public function __construct(DriveConnectionInterface $googleDriveConnectionService)
    {
        $this->googleDriveConnectionService = $googleDriveConnectionService;
    }

    /**
     * Redirects user to the Google oAuth page
     *
     * @return Redirector|Application|RedirectResponse
     */
    public function generateAuthRequest(): Redirector|Application|RedirectResponse
    {
        return redirect($this->googleDriveConnectionService->auth());
    }

    /**
     * Generates the bearer token using the code returned from Google when user is redirected back to site.
     */
    public function authorise(): Response
    {
        if (request()->code) {
            $user = auth()->user(); // This will be authorised user once login is set up
            $user->drive_token = $this->googleDriveConnectionService->generateBearerToken(request()->code);
            $user->save();
        }

        return Inertia::render('Authorised', [
            'laravelVersion' => \Illuminate\Foundation\Application::VERSION,
            'phpVersion' => PHP_VERSION,
        ]);
    }
}
