<?php

if(!function_exists('success')) {
    function success($message, $data){
        return response()->json([
            'result' => 1,
            'message' => $message,
            'data' => $data
        ]);
    }
}

if(!function_exists('fail')) {
    function fail($message, $data){
        return response()->json([
            'result' => 0,
            'message' => $message,
            'data' => $data
        ]);
    }
}