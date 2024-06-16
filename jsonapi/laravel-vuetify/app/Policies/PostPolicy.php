<?php

namespace App\Policies;

use App\Models\User;

class PostPolicy
{
    public function viewAny(User | null $user): bool
    {
        return true;
    }

    public function create(User | null $user): bool
    {
        return true;
    }

    public function view(User | null $user): bool
    {
        return true;
    }

    public function delete(User | null $user): bool
    {
        return true;
    }

    public function viewComments(User | null $user): bool
    {
        return true;
    }
}
