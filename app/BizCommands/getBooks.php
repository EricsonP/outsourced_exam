<?php
namespace App\Bizcommands;

use App\Common\CommonException;
use App\Common\Ret;
use App\Models\Book;

class getBooks extends \App\Common\Command
{
    public function doCommand($arr, $user)
    {
        $books = Book::where('library_id', $arr['library_id'])->get();
        return Ret::create(200, "Success", $books);
    }
}