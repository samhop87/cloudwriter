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

//    Illuminate\Support\Collection {#1900 // tests/Unit/ChatGPTServiceTest.php:29
//        #items: array:3 [
//        "069b6f7f-208d-36d0-aae7-a7923868aafc" => """
//      \n
//      \n
//      The sky above me was a deep, velvety black and the stars were winking in the distance. I could feel the danger that lingered in the air and my stomach clenched in anticipation. I had been told tales since a child of the wonders that lay beyond this point, of a world I had never seen, never considered. Now, I was here. \n
//      \n
//      My feet sounded loud and quick on the ground as I hurried towards my destiny. I had read of places of adventure and change, of mythical creatures and forgotten realms, and I knew that I was about to enter a world that was beyond anything I could have imagined. \n
//      \n
//      The faintest hint of light grew in the distance and I knew that I was reaching the end of my journey. I quickened my pace, my heart pounding, and as I stepped through the threshold my heart soared as I took in the wonders of the magical land before me.
//      """
//    "fb3ed927-3082-36d7-ab15-81159e95317b" => """
//      \n
//      I sat there, a rocky ledge overlooking the landscape beneath me. The air was crisp and my eyes faltered as they gazed upon an ancient city of grandeur, a place of forgotten greatness. A once-thriving metropolis filled with some of the most brilliant minds the world has ever known. \n
//      \n
//      Sadly, that was all gone now, replaced by rubble and tragedy. I thought back to how it used to be—the laughter that filled the streets, the majestic towers piercing the sky, and the ever-smiling faces of its inhabitants—before the war had waged on and taken it all away. \n
//      \n
//      Still, I had faith that this city, my home, would once again seek greatness and prosperity. Though the war had taken its toll, I could feel a certain energy in the air and a stirring within my heart that told me things could still get better. Maybe one day, this city would rise from the ashes and be greater than ever before.
//      """
//    "3b4c0b9f-0741-3fed-bf3f-b396b4fa5bca" => """
//      \n
//      \n
//      The blacksmith clanged away in the corner, filling the air with the sound of a thousand ringing bells. I had stopped here on my way to the Citadel of the Sun, the Capital of the kingdom of Zairiri. My quest was to find the old and forgotten sword of Zairirin, which was said to be hidden somewhere in the vastness of the castle walls.\n
//      \n
//      The blacksmith looked to be an old man, his wrinkled face and grizzled beard peppered with white, his calloused hands stained with grime from a life of hard work. He looked up from his work and smiled as I passed by, a look of sheer admiration on his face.\n
//      \n
//      I returned his smile and began to make my way through the bustling streets of the city. It felt strange to be back here, my childhood home, yet it also felt comforting in a way. I reflected on all the memories this city held, and how much I had changed since I left. Taking a deep breath, I moved on, my destination the castle of Zairirin.
//      """
//  ]
//  #escapeWhenCastingToString: false
//}
    expect($result)->toBeInstanceOf(\Illuminate\Support\Collection::class)
        ->and($result->count())->toEqual($file_ids->count())
        ->and($result->keys())->toEqual($file_ids);
});
