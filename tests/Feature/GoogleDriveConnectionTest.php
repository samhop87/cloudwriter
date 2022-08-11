<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Http;

beforeEach(function () {
    $this->person = $this->createUser();
});

test('redirects to oAuth screen', function () {
    $response = $this->get('/baseboard/generate-auth');
    $response->assertRedirect();
    $response->assertRedirectContains('https://accounts.google.com/o/oauth2/auth');
});

test('auth code returns access token', function () {
    $responseJson = fakeGoogleConnection();

    $response = $this->get(
        '/authorise?code=4%2F0AdQt8qgOM6NZIcMwAnTdzgvHj7L78sFFXK89I0cTOnjJ-FeVhsHIBd0sbQhAEStgvwFmtg&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive')
        ->assertOk();

    expect($this->person->drive_token)->toBe($responseJson);
});

