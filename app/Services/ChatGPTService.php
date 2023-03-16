<?php

namespace App\Services;

use App\Interfaces\ChatGPTServiceInterface;
use App\Interfaces\DriveApiInterface;
use App\Models\User\Project;
use Illuminate\Support\Collection;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Completions\CreateResponse;

class ChatGPTService implements ChatGPTServiceInterface
{
    public function makeCall(string $prompt): string
    {
        return OpenAI::completions()->create([
            'model' => 'text-davinci-003',
            'prompt' => $prompt,
            'max_tokens' => 2048,
        ])->choices[0]->text;
    }

    public function generatePrompts(Project $project, Collection $file_ids): Collection
    {
        $text = "You are a professional writer, writing a book in first person perspective. The theme of the book is
         high fantasy and alternate history. Write 2 - 3 paragraphs for the next chapter of the book.";
//
//
//{PUT CONTEXT OF PREVIOUS CHAPTER HERE.
//"""

        return $file_ids->flatMap(function ($file_id, $key) use ($project, $text, $file_ids) {
            if ($key > 0) {
                $text .= $file_ids[$key - 1];
            }

            return [
                $file_id => $this->makeCall($text),
            ];
        });
    }
}
