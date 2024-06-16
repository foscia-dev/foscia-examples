<?php

namespace App\Policies;

class CommentPolicy
{
    public function create(User | null $user): bool
    {
        return true;
    }
}
