<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Database\DbConnexion;
use App\Entities\User;

class RegisterController extends AbstractController
{
    public function process(Request $request): Response
    {
        return $this->register($request);
    }

    private function register(Request $request)
    {
        $success = null;

        $body = json_decode($request->getPayload(), true);

        $name = $body['name'];
        $password = $body['password'];
        $email = $body['email'];

        $user = new User();
        $user->setName($name);
        $user->setEmail($email);
        $user->setPassword($password);

        $success = $user->create();

        return new Response(json_encode($success), 201, ['Content-Type' => 'application/json']);
    }
}
