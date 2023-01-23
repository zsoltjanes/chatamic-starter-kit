<?php

namespace App\Services;

use App\Contracts\EntryContract;
use Statamic\Facades\Entry;

class EntryService implements EntryContract
{
    public function save(string $input, string $reply)
    {
        $title = str_slug(now() . '-' . $input);

        $entry = Entry::make()
            ->collection('conversations')
            ->data([
                'title' => $title,
                'input' => $input,
                'reply' => $reply,
            ]);

        $entry->save();
    }
}
