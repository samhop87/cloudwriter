<?php

namespace App\Http\Controllers;

use App\Interfaces\DriveConnectionInterface;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

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
     * @return Redirector|Application|RedirectResponse
     */
    public function generateAuthRequest(): Redirector|Application|RedirectResponse
    {
        return redirect($this->googleDriveConnectionService->auth());
    }

    /**
     * Generates the bearer token using the code returned from Google when user is redirected back to site.
     * @return string
     */
    public function authorise(): string
    {
        if (request()->code) {
            $user = User::find(1); // This will be authorised user once login is set up
            $user->drive_token = $this->googleDriveConnectionService->generateBearerToken(request()->code);
            $user->save();
        }

        // TODO: what's the action here? Should this be a web route that redirects you to an authorised success page?
        return 'authorised'; // Meaning from now on, $user->drive_token is access object.
    }
}
