<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Database\DbConnexion;
use App\Entities\PostsEntity;

class PostsController extends AbstractController
{
    public function process(Request $request): Response
    {
        return $this->getAllPosts();
    }

    private function getAllPosts()
    {
        $posts = new PostsEntity();
        $getPosts = $posts->getPosts();

        return new Response(json_encode($getPosts), 200, ['Content-Type' => 'application/json']);
    }
}
