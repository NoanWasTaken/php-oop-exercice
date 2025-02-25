<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Database\DbConnexion;
use App\Entities\Blog;

class BlogsController extends AbstractController
{
    public function process(Request $request): Response
    {
        return $this->getAllBlogs();
    }

    private function getAllBlogs()
    {
        $blog = new Blog();
        $getBlogs = $blog->getBlogs();

        return new Response(json_encode($getPosts), 200, ['Content-Type' => 'application/json']);
    }
}
