<?php
namespace App\Bizcommands;

use App\Common\CommonException;
use App\Common\Ret;
use App\Models\User;
use DB;

class RegisterUser extends \App\Common\Command
{
    public function getValidationRules()
    {
        return [
            "name" => "required",
            "email"=> "required|email",
            "library_id" => "required|numeric",
            "password"=> [
                "required", 
                "string",
                \Illuminate\Validation\Rules\Password::min(10)
                ->mixedCase()
                ->numbers()
                ->symbols()
            ],
            "confirmpassword"=> "required"
        ];
    }

    public function doCommand($arr, $user)
    {
        if($arr["password"] != $arr["confirmpassword"]){
            return Ret::create(502, "Error", null, "Confirm Password must match Password");
        }
        DB::beginTransaction();
        try{
            $user = new User();
            $user->name = $arr['name'];
            $user->email = $arr['email'];
            $user->library_id = $arr['library_id'];
            $user->password = bcrypt($arr['password']);
            $user->save();
            DB::commit();
            return Ret::create(200, "Success: User has been registered");
        }
        catch(Exception $e){
            DB::rollTransaction();
            return Ret::create(502, "Error: " . $e->getMessage());
        }

    }
}