<?php

namespace App\Services;

use App\Interfaces\ChatGPTServiceInterface;
use App\Models\User\Project;
use Illuminate\Support\Collection;
use OpenAI\Laravel\Facades\OpenAI;

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
        $collectedPrompts = collect([]);

        return $file_ids->flatMap(
            function ($file_id, $key) use ($project, $file_ids, $collectedPrompts) {
                $text = "Acting as a professional writer, writing a book in first person perspective. The theme of the book is
         high fantasy and alternate history. Write 2 - 3 paragraphs to act as a prompt for the next chapter of the book.";

                if ($key > 0) {
                    // TODO: there's probably a better way of doing this
                    if ($key >= 1) {
                        $text .= 'The previous chapters\' prompts were as follows. Each prompt is separated by a semi-colon:';
                    }
                    $text .= ' ' . $collectedPrompts->implode('; ');
                }

                $generatedPrompt = $this->makeCall($text);
                $collectedPrompts->push($generatedPrompt);

                return [
                    $file_id => $this->makeCall($text),
                ];
            });
    }
}
