<?php
namespace App\Bizcommands;

use App\Common\CommonException;
use App\Common\Ret;
use App\Models\User;
use App\Models\Book;
use App\Models\Transaction;
use DB;

class borrowBook extends \App\Common\Command
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
            if($chkBook->status == "borrowed"){
                $chkTrans = $chkBook->transactions->where('status', 'borrowed')->first();
                $str = $chkTrans->user->name;
                if($chkTrans->user->id == $chkUser->id){
                    $str = "you";
                }
                return Ret::create(502, "Error", null, "Book already borrowed by " . $str);
            }
            DB::beginTransaction();
            try{
                $transaction = new Transaction();
                $transaction->user_id = $chkUser->id;
                $transaction->library_id = $chkUser->library_id;
                $transaction->book_id = $arr['book_id'];
                $transaction->status = 'borrowed';
                $transaction->save();
                DB::commit();
                return Ret::create(200, "Success: " . $chkBook->book_name . " has been borrowed");
            }
            catch(Exception $e){
                DB::rollTransaction();
                return Ret::create(502, "Error: " . $e->getMessage());
            }
        }
        else{
            return Ret::create(502, "Error", null, "User not found");
        }
    }
}