<?php

use App\Models\User\Project;
use App\Services\ChatGPTService;
use Illuminate\Foundation\Testing\WithFaker;
use Mockery\MockInterface;

uses(WithFaker::class);

it('creates an array of prompts with file_ids as keys', function () {
    $project = Project::factory()->createQuietly();
    $file_ids = collect([$this->faker->uuid, $this->faker->uuid, $this->faker->uuid]);

    $mock = $this->partialMock(ChatGPTService::class, function (MockInterface $mock) {
        $mock->shouldReceive('makeCall')
            ->andReturn(
                $this->faker->sentence,
            );
    });

    $childClass = \Mockery::mock(ChatGPTService::class)->makePartial();
    $childClass->shouldReceive('makeCall')
        ->andReturn($this->faker->sentence);

    $result = $mock->generatePrompts($project, $file_ids);

    dd($result);

});
