<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function borrowBook(Request $request)
    {
        $cmd = new \App\BizCommands\borrowBook();
        $data = $request->all();
        return response()->json($cmd->execute($data, null));
    }

    public function returnBook(Request $request)
    {
        $cmd = new \App\BizCommands\returnBook();
        $data = $request->all();
        return response()->json($cmd->execute($data, null));
    }
}
