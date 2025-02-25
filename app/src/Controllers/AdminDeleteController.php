<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Database\DbConnexion;
use App\Entities\User;

class AdminDeleteController extends AbstractController
{
    public function process(Request $request): Response
    {
        return $this->deleteUser($request);
    }

    private function deleteUser(Request $request)
    {
        $body = json_decode($request->getPayload(), true);
        $users = new User();
        $id = $body['id'];
        $delete = $users->delete($id);

        return new Response(json_encode($delete), 200, ['Content-Type' => 'application/json']);
    }
}
