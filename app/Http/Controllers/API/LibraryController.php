<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    public function getBooks(Request $request, $library_id)
    {
        $cmd = new \App\BizCommands\getBooks();
        $data = $request->all();
        $data['library_id'] = $library_id;
        return response()->json($cmd->execute($data, null));
    }
}
