<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
//require_once __DIR__ . "/../views/html/start.html";
require_once __DIR__ . "/../views/$view.html";
//require_once __DIR__ . "/../views/html/end.html";

abstract class AbstractController{
    abstract public function process(Request $request): Response;


    protected function render(string $view, array $data = []): Response{
        $response = new Response();
        extract($data);
        ob_start();
        $response->setContent(ob_get_clean());
        $response->addHeader('Content-Type', 'text/html');
        return $response;
    }

    public function loggedIn(): bool {
        return isset($_SESSION['user_id']);
    }
}