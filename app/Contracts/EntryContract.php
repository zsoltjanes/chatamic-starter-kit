<?php

namespace App\Contracts;

interface EntryContract
{
    public function save(string $input, string $reply);
}
