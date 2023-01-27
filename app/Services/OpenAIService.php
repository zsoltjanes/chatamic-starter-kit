<?php

namespace App\Services;

use App\Contracts\OpenAIContract;
use OpenAI\Laravel\Facades\OpenAI;
use OpenAI\Responses\Completions\CreateResponse;
use Statamic\Facades\GlobalSet;

class OpenAIService implements OpenAIContract
{
    public function getResponse($input): CreateResponse
    {
        // Get the default OpenAI settings from globals
        $openAiSettings = GlobalSet::findByHandle('openai_settings')->in('default')->data();

        return OpenAI::completions()->create([
            'model' => $openAiSettings->get('model'),
            'temperature' => (float) $openAiSettings->get('temperature'),
            'top_p' => (float) $openAiSettings->get('top_p'),
            'frequency_penalty' => (float) $openAiSettings->get('frequency_penalty'),
            'presence_penalty' => (float) $openAiSettings->get('presence_penalty'),
            'max_tokens' => (int) $openAiSettings->get('max_tokens'),
            'prompt' => $input,
        ]);
    }
}
