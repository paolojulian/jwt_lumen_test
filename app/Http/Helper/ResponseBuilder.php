<?php
namespace App\Http\Helper;

class ResponseBuilder
{
    public static function result($status=true, $info="", $data=[])
    {
        return [
            "status" => $status,
            "data" => $data,
            "info" => $info
        ];
    }
}