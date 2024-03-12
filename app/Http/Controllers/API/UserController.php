<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function registerUser(Request $request)
    {
        $cmd = new \App\BizCommands\RegisterUser();
        $data = $request->all();
        return response()->json($cmd->execute($data, null));
    }
}
