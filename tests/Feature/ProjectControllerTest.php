<?php

namespace Tests\Feature;

use Google\Auth\OAuth2;
use Google\Client;
use Google\Http\REST;
use Google\Service\Drive\Resource\Files;
use Google\Service\Resource;
use Google_Service_Drive;
use GuzzleHttp\Psr7\Query;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\Mock;
use Mockery\MockInterface;
use Tests\OverallTestCase;

uses(OverallTestCase::class);
uses(WithFaker::class);

beforeEach(function () {
    $this->person = $this->createUser(authorised: true);
    $this->testCode = '4%2F0AdQt8qgOM6NZIcMwAnTdzgvHj7L78sFFXK89I0cTOnjJ-FeVhsHIBd0sbQhAEStgvwFmtg&scope=https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fdrive';
});

it('can create a new project', function () {
    $projectName = $this->faker->word();

    $this->mock(OAuth2::class, function (MockInterface $mock) {
        $mock->shouldReceive('fetchAuthToken')
            ->once()
            ->shouldReceive('getTokenCredentialUri')->once()
            ->shouldReceive('generateCredentialsRequest')
            ->once()
            ->andReturn(new Request(
                'POST',
                Utils::uriFor('https://oauth2.googleapis.com/token'),
                [
                    'Cache-Control' => 'no-store',
                    'Content-Type' => 'application/x-www-form-urlencoded',
                ],
                Query::build([
                    "grant_type" => "refresh_token",
                    "refresh_token" => "53f92e19-5c9a-37d8-ac34-f248eb09bfed",
                    "client_id" => "208001095396-s0kvlf4vsijlvui1oopcjrloa81mvt5f.apps.googleusercontent.com",
                    "client_secret" => "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",
                ])
            ));
    });

    $this->mock(Files::class, function (MockInterface $mock) {
        $mock->shouldReceive('create')->once();
    });

    $this->mock(Resource::class, function (MockInterface $mock) {
        $mock->shouldReceive('call')->once();
    });

    $this->mock(REST::class, function (MockInterface $mock) {
        $mock->shouldReceive('execute')->once();
    });

    $this->mock(Client::class, function (MockInterface $mock) {
        $mock->shouldReceive(
            'setApplicationName',
            'setAuthConfig',
            'setAccessType',
            'setIncludeGrantedScopes',
            'setApprovalPrompt',
            'getRefreshToken',
        )->shouldReceive('shouldDefer')->once()->andReturn(false)
            ->shouldReceive('execute')
            ->once()
//            ->andReturn(REST::execute(
//                $http,
//                $request,
//                $expectedClass,
//                $this->config['retry'],
//                $this->config['retry_map']
//            ))
            ->shouldReceive('addScope')
            ->with(Google_Service_Drive::DRIVE)
            ->once()
            ->shouldReceive('setRedirectUri')
            ->with(config('services.google.redirect_uri'))
            ->once()
            ->shouldReceive('fetchAccessTokenWithAuthCode')
            ->with($this->testCode)
            ->once()
            ->andReturn(['access_token' => 'test_token', 'created' => time()])
            ->shouldReceive('fetchAccessTokenWithRefreshToken')
            ->andReturn(['access_token' => 'test_token']);
    });

    $this->post(route('project.store'), ['project_name' => $projectName]);

    $this->travel(1)->minutes();

    $this->assertDatabaseHas('projects', [
        'project_name' => $projectName,
    ]);
});
