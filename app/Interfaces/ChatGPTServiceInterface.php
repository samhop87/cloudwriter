<?php

namespace App\Interfaces;

use App\Models\User\Project;
use Illuminate\Support\Collection;

interface ChatGPTServiceInterface
{
    public function makeCall(string $prompt): string;

    public function generatePrompts(Project $project, Collection $file_ids);
}
