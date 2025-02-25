<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Database\DbConnexion;
use App\Entities\UserEntity;

class PatchProfileController extends AbstractController
{
    public function process(Request $request): Response{
        return $this->register($request);
    }


    private function register(Request $request){
        $success = null;
        $body = json_decode($request->getPayload(), true);

        $id = $body['id'];
        $userData = [];

        if (isset($body['name'])) {
            $userData['name'] = $body['name'];
        }

        if (isset($body['email'])) {
            $userData['email'] = $body['email'];
        }

        if (isset($body['password'])) {
            $userData['password'] = $body['password'];
        }

        $user = new User();


        $success = $user->update($id, $userData);

        return new Response(json_encode($success), 201, ['Content-Type' => 'application/json']);
    }
}
