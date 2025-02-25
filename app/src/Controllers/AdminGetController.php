<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;
use App\Database\DbConnexion;
use App\Entities\User;

class AdminGetController extends AbstractController
{
    public function process(Request $request): Response
    {
        return $this->getUsers();
    }

    private function getUsers()
    {
        $users = new User();
        $getUsers = $users->getAllUsers();

        return new Response(json_encode($getUsers), 200, ['Content-Type' => 'application/json']);
    }
}
