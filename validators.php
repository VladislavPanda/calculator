<?php

// Функция проверки - есть ли в строке буквенные символы (латинские или кирилличиские). Если да, выбрасывается ошибка
function validateAcceptableSymbols($statement){
    $latinSymbolsFlag = preg_match("/[a-z]/i", $statement); // Проверка на латинские буквенные символы
    $cyrrilicSymbolsFlag = preg_match("/[\p{Cyrillic}]/u", $statement); // Проверка на латинские буквенные символы
    
    if($latinSymbolsFlag == 1 || $cyrrilicSymbolsFlag == 1){
        echo json_encode(['result' => 'Ошибка. В строке содержатся недопустимые символы (латицина или кириллица)'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }
}