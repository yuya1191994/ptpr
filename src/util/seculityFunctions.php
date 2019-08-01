<?php

// XSS対策
function out_html($str) {
    echo htmlspecialchars($str, ENT_QUOTES, 'UTF-8');
}

// XSS対策　クエリ実行前バリデート
function str_validate($str) {
    if(preg_match('/[&<>\"\']/', $str)){
        $errMsg = "使用できない文字列が含まれています => 「 $str 」";
        return $errMsg;
    }
}