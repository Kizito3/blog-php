<?php

function createToken($value1, $value2, $value3, $value4)
{
    $token = $value1 . $value2 . $value3 . $value4;
    return md5($token);
}