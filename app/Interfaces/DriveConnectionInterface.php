<?php

namespace App\Interfaces;

use App\Models\User;
use Google_Client;

interface DriveConnectionInterface
{
    public function setUp($redirect_uri = null): Google_Client;

    public function auth($redirect_uri = null): string;

    public function setupService($type, User $user);

    public function generateBearerToken($code);

    public function refreshToken(User $user);
}
