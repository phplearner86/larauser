<?php  

function message($message, $type='success')
{
    $response['message'] = $message;
    $response['type'] = $type;

    return $response;
}