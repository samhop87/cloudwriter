<?php

namespace App\Services;

use App\Interfaces\DriveConnectionInterface;
use App\Models\User;
use Google\Exception;
use Google_Client;
use Google_Service_Docs;
use Google_Service_Drive;

class GoogleDriveConnectionService implements DriveConnectionInterface
{
    /**
     * @param  null  $redirect_uri
     * @return Google_Client
     *
     * @throws Exception
     */
    public function setUp($redirect_uri = null): Google_Client
    {
        // Initialise the client.
        $client = new Google_Client();
        // Set the application name, this is included in the User-Agent HTTP header.
        $client->setApplicationName('Google integration');
        // Set the authentication credentials we downloaded from Google.
        $client->setAuthConfig(app_path('client_secret_drive.json'));
        // Setting offline here means we can pull data from the venue's calendar when they are not actively using the site.
        $client->setAccessType('offline');
        // This will include any other scopes (Google APIs) previously granted by the venue
        $client->setIncludeGrantedScopes(true);
        // Set this to force to consent form to display.
        $client->setApprovalPrompt('force');
        // Add the Google Drive scope to the request.
//        $client->addScope([Google_Service_Drive::DRIVE, Google_Service_Docs::DOCUMENTS]);
        $client->addScope(Google_Service_Drive::DRIVE);
        // Set redirect URI
        if ($redirect_uri) {
            $client->setRedirectUri($redirect_uri);
        }

        return $client;
    }

    /**
     * @param  null  $redirect_uri
     * @return string
     *
     * @throws Exception
     */
    public function auth($redirect_uri = null): string
    {
        // FOR TESTING PURPOSES
        // Valet share, then copy the http address into client secret, below and on the google dev console.
        //
        $client = $this->setUp(config('services.google.redirect_uri'));

        return $client->createAuthUrl();
    }

    /**
     * @param  User  $user
     * @return Google_Service_Drive|void
     *
     * @throws Exception
     */
    public function setupService(User $user)
    {
        // Make sure token is valid
        if ($user->drive_token) {
            $this->refreshToken($user);

            // Set up google client
            $client = $this->setUp();

            $client->setAccessToken($user->drive_token);

            return new Google_Service_Drive($client);
        } else {
            exit('Drive has not been authorised yet.');
        }
    }

    /**
     * @param $code
     * @return array|false|string
     *
     * @throws Exception
     */
    public function generateBearerToken($code): bool|array|string
    {
        if (app()->environment('testing')) {
            return fakeGoogleConnection();
        }

        $client = $this->setUp();

        // Make the token request
        $accessToken = $client->fetchAccessTokenWithAuthCode($code);

        return json_encode($accessToken);
    }

    /**
     * @param  User  $user
     * @return mixed|void
     *
     * @throws Exception
     */
    public function refreshToken(User $user)
    {
        // TODO: this method doesn't work, possibly because not accepted by Google yet
        $client = $this->setUp();

        // Refresh the token if it's expired.
        if ($user->drive_token && isset(json_decode($user->drive_token)->error)) {
            exit('Google authorisation invalid, you need to reauthorise.');
        }

        $client->setAccessToken($user->drive_token);
        if ($client->isAccessTokenExpired()) {
            $accessToken = $client->fetchAccessTokenWithRefreshToken($client->getRefreshToken());
            $user->drive_token = json_encode($accessToken);
            $user->saveQuietly();
        }

        return $user->drive_token;
    }
}
