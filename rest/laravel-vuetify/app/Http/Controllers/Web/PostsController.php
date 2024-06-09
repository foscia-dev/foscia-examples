<?php

namespace App\Http\Controllers\Web;

use Inertia\Inertia;
use Inertia\Response;

class PostsController
{
    public function index(): Response
    {
        return Inertia::render('Posts/Index');
    }

    public function show(string $post): Response
    {
        return Inertia::render('Posts/Show', [
            'postId' => $post,
        ]);
    }
}
