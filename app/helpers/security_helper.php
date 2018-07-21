<?php

function encryptData($input) {
    $output = trim(base64_encode(base64_encode($input)), '==');
    $output = encrypt($input);
    return $output;
}

function decryptData($input) {
    $output = base64_decode(base64_decode($input));
    $output = decrypt($input);
    return $output;
}

function encrypt($sData, $sKey = '@2g') {
    $sResult = '';
    for ($i = 0; $i < strlen($sData); $i++) {
        $sChar = substr($sData, $i, 1);
        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
        $sChar = chr(ord($sChar) + ord($sKeyChar));
        $sResult .= $sChar;
    }
    return encode_base64($sResult);
}

function decrypt($sData, $sKey = '@2g') {
    $sResult = '';
    $sData = decode_base64($sData);
    for ($i = 0; $i < strlen($sData); $i++) {
        $sChar = substr($sData, $i, 1);
        $sKeyChar = substr($sKey, ($i % strlen($sKey)) - 1, 1);
        $sChar = chr(ord($sChar) - ord($sKeyChar));
        $sResult .= $sChar;
    }
    return $sResult;
}

function encode_base64($sData) {
    $sBase64 = trim(base64_encode($sData), '=');
    return strtr($sBase64, '+/', '-_');
}

function decode_base64($sData) {
    $sBase64 = strtr($sData, '-_', '+/');
    return base64_decode($sBase64);
}
