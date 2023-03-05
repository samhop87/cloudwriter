<?php

namespace App\Services;

use App\Interfaces\ChatGPTServiceInterface;
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
}
