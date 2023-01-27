<?php

namespace App\Http\Controllers;

use App\Http\Requests\OpenAIExecuteRequest;
use App\Services\EntryService;
use App\Services\OpenAIService;
use Exception;
use Statamic\View\View;

class ChatamicController extends Controller
{
    private OpenAIService $openAIClient;

    private EntryService $entryService;

    public function __construct(OpenAIService $openAIClient, EntryService $entryService)
    {
        $this->openAIClient = $openAIClient;
        $this->entryService = $entryService;
    }

    public function execute(OpenAIExecuteRequest $request): View
    {
        $input = $request->get('prompt');

        try {
            $response = $this->openAIClient->getResponse($input);
            $reply = $response['choices'][0]['text'];
        } catch (Exception $e) {
            $reply = $e->getMessage();
        }

        $this->entryService->save($input, $reply);

        return (new View)
            ->template('home')
            ->layout('layout')
            ->with(['reply' => $reply, 'input' => $input]);
    }
}
