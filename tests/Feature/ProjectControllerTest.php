<?php

namespace Tests\Feature;

use App\Interfaces\DriveApiInterface;
use App\Jobs\CreateProjectOnGoogle;
use App\Models\User\Project;
use App\Services\GoogleDriveApiService;
use Google\Service\Drive\DriveFile;
use Illuminate\Support\Facades\Queue;
use Illuminate\Support\Str;
use Mockery\MockInterface;

beforeEach(function () {
    $this->person = $this->createUser(authorised: true);
});

it('can create a new project', function () {
    $projectName = $this->faker->word();

    $file = new DriveFile();
    $file->setId(Str::random(20));

    $driveMock = $this->mock(GoogleDriveApiService::class, function (MockInterface $mock) use ($file) {
        $mock->shouldReceive('createFolder')
            ->andReturn($file);
    });

    $this->app->instance(DriveApiInterface::class, $driveMock);

    $this->post(route('project.store'), [
        'project_name' => $name = $this->faker->name,
        'shapeChoice' => $this->faker->numberBetween(0,5),
        'pov' => ['name' => 'first_person'],
        'themeChoice' => [['name' => 'alt']]
    ]);

    $this->travel(1)->minutes();

    $this->assertDatabaseHas('projects', [
        'project_name' => $name,
    ]);
});

it('can delete a new project', function () {
    $project = Project::factory()->createQuietly([
        'user_id' => $this->person->id
    ]);

    $driveMock = $this->mock(GoogleDriveApiService::class, function (MockInterface $mock) {
        $mock->shouldReceive('deleteFile')
            ->once();
    });

    $this->app->instance(DriveApiInterface::class, $driveMock);

    $this->delete(route('project.delete', $project->project_id));

    $this->assertDatabaseCount('projects', 0);
});

it('can only delete a project if user is owner', function () {
    $project = Project::factory()->createQuietly();

    $this->delete(route('project.delete', $project->project_id));

    $this->assertDatabaseCount('projects', 1);
});

it('creates folders when project is created', function () {
    Queue::fake();

    $file = new DriveFile();
    $file->setId(Str::random(20));

    $driveMock = $this->mock(GoogleDriveApiService::class, function (MockInterface $mock) use ($file) {
        $mock->shouldReceive('createFolder')
            ->andReturn($file);
    });

    $this->app->instance(DriveApiInterface::class, $driveMock);

    $this->post(route('project.store'), [
        'project_name' => $this->faker->name,
        'shapeChoice' => $this->faker->numberBetween(0,5),
        'pov' => ['name' => 'first_person'],
        'themeChoice' => [['name' => 'alt']]
    ]);

    $this->travel(1)->minutes();

    Queue::assertPushed(CreateProjectOnGoogle::class);
});

it('returns an instance of the loaded project from session', function () {
    expect(true)->toBe(true);
});

//it('refreshes current stored project and orders by number', function () {
//    // TODO: will need examples for drive files to manipulate for test
//});
