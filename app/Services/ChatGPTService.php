<?php

namespace App\Services;

use App\Interfaces\ChatGPTServiceInterface;
use App\Models\User\Project;
use Illuminate\Support\Collection;
use OpenAI\Laravel\Facades\OpenAI;

class ChatGPTService implements ChatGPTServiceInterface
{
    public function nextSentence()
    {
        $result = OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => 'prompt',
        ]);
    }

    public function generatePrompts(Project $project, Collection $file_ids)
    {
        // TODO:
        // this has to be done all at once, since after the fact would require a complicated series of api calls to update files.
        // it should generate all the prompts here, stored in an array that matches the chapters. We then map the prompts to chapters and update the files.



    }
}
