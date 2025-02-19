<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Database\DbConnexion;
use App\Entities\UserEntity;

class AdminDeleteUserController extends AbstractController
{
    public function process(Request $request): Response
    {
        return $this->deleteUsers($request);
    }

    private function deleteUsers(Request $request)
    {
        $payload = json_decode($request->getPayload(), true);
        $users = new UserEntity();
        $id = $payload['id'];
        $delete = $users->delete($id);

        return new Response(json_encode($delete), 200, ['Content-Type' => 'application/json']);
    }
}
