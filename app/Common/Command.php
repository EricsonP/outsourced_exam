<?php

namespace App\Common;
use Illuminate\Support\Facades\Validator;

abstract class Command
{
    public function getValidationRules()
    {
        return [];
    }

    public function execute($arr, $user)
    {
        $this->arr = $arr;
        try{
            $rules = $this->getValidationRules();
            $validator = Validator::make($arr, $rules);
            if($validator->fails()){
                return Ret::create(501, "Validation Errors", null, $validator->errors());
            }
            $ret = $this->doCommand($arr, $user);   
            return $ret;
        }catch (\Exception $e){
            return Ret::create(502, "Error", null, $e->getMessage());
        }
    }

}