<?php

namespace App\Contracts;

use OpenAI\Responses\Completions\CreateResponse;

interface OpenAIContract
{
    public function getResponse($input): CreateResponse;
}
