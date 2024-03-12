<?php
namespace App\Bizcommands;

use App\Common\CommonException;
use App\Common\Ret;
use App\Models\User;
use App\Models\Book;
use App\Models\Transaction;
use DB;

class returnBook extends \App\Common\Command
{
    public function getValidationRules()
    {
        return [
            "email" => "required|email",
            "password" => "required",
            "book_id" => "required"
        ];
    }

    public function doCommand($arr, $user)
    {
        $chkUser = User::where('email', $arr['email'])->first();
        if($chkUser){
            $hash_check = \Hash::check($arr["password"], $chkUser->password);
            if(!$hash_check){
                return Ret::create(502, "Error", null, "Invalid password.");
            }
            $chkBook = Book::where('library_id', $chkUser->library_id)->where('id', $arr['book_id'])->first();
            if(!$chkBook){
                return Ret::create(502, "Error", null, "Book not found on your library");
            }
            if($chkBook->status == "available"){
                return Ret::create(502, "Error", null, "The book is not yet borrowed");
            }
            $chkTrans = $chkBook->transactions->where('status', 'borrowed')->first();
            if($chkTrans){
                if($chkBook->status == "borrowed" && $chkTrans->user->id != $chkUser->id){
                    return Ret::create(502, "Error", $chkBook, "The book is borrowed by " . $chkBook->transaction->user->name);
                }
                if($chkBook->status == "borrowed" && $chkTrans->user->id == $chkUser->id){
                    DB::beginTransaction();
                    try{
                        $transaction = Transaction::find($chkTrans->id);
                        $transaction->status = 'returned';
                        $transaction->save();
                        DB::commit();
                        return Ret::create(200, "Success: " . $chkBook->name . " book has been returned by " . $chkUser->name);
                    }
                    catch(Exception $e){
                        DB::rollTransaction();
                        return Ret::create(502, "Error: " . $e->getMessage());
                    }
                }
            }
        }
        else{
            return Ret::create(502, "Error", null, "User not found");
        }
    }
}