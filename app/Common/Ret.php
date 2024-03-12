<?php
namespace App\Common;

class Ret
{
    public static function create($code, $message, $data = null, $errors = null)
    {
        $ret = new \stdClass();
        $ret->code = $code;
        $ret->message = $message;
        $ret->data = $data;
        $ret->errors = $errors;
        return $ret;
    }
}