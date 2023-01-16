<?php

namespace Tests\Feature;

use App\Services\GoogleDriveConnectionService;
use Google\Client;
use Mockery\MockInterface;
use Tests\OverallTestCase;

uses(OverallTestCase::class);

beforeEach(function () {
    $this->person = $this->createUser();
    $this->testCode = '4%2F0AdQt8qgOM6NZIcMwAnTdzgvHj7L78sFFXK89I0cTOnjJ-FeVhsHIBd0sbQhAEStgvwFmtg&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive';
});

test('redirects to oAuth screen', function () {
    $response = $this->get('/baseboard/generate-auth');
    $response->assertRedirect();
    $response->assertRedirectContains('https://accounts.google.com/o/oauth2/auth');
});

test('auth code returns access token', function () {
    $responseJson = fakeGoogleConnection();

    $this->get(
        '/authorise?code=')
        ->assertOk()
        ->assertSent();

    expect($this->person->drive_token)->toBe($responseJson);
});

it('generates an access token when provided with an auth code', function () {
    $this->mock(GoogleDriveConnectionService::class, function (MockInterface $mock) {
        $mock->shouldReceive('generateBearerToken')->withAnyArgs()->once();
    });

    $this->partialMock(Client::class, function (MockInterface $mock) {
        $mock->shouldReceive('setApplicationName')
            ->with('Google Integration');
        $mock->shouldReceive('fetchAccessTokenWithAuthCode')
            ->with($this->testCode)
            ->once()
            ->andReturn(fakeGoogleConnection());
    });

    $this->get("/authorise?code=$this->testCode")->assertOk();
});
