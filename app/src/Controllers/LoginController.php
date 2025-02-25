<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Database\DbConnexion;
use App\Entities\User;

class LoginController extends AbstractController
{
    

    private function login(Request $request){
        $body = json_decode($request->getPayload(), true);
        $email = $body['email'];
        $password = $body['password'];

        $user = new User();
        $isUserValid = $user->check($email, $password);



        if ($isUserValid) {
            return new Response(json_encode(['success' => true]), 200, ['Content-Type' => 'application/json']);
        } else {
            return new Response(json_encode(['success' => false, 'message' => 'Invalid credentials']), 401, ['Content-Type' => 'application/json']);
        }
    }

    public function process(Request $request): Response{
        return $this->login($request);
    }
}
