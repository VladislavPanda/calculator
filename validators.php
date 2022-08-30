<?php

// Функция проверки - есть ли в строке буквенные символы (латинские или кирилличиские). Если да, выбрасывается ошибка
function validateAcceptableSymbols($statement){
    $latinSymbolsFlag = preg_match("/[a-z]/i", $statement); // Проверка на латинские буквенные символы
    $cyrrilicSymbolsFlag = preg_match("/[\p{Cyrillic}]/u", $statement); // Проверка на латинские буквенные символы
    
    if($latinSymbolsFlag == 1 || $cyrrilicSymbolsFlag == 1){ // Если найдены латинские или кириллические буквенные символы в строке выражения - возвращается ошибка 
        echo json_encode(['result' => 'Ошибка. В строке содержатся недопустимые символы (латицина или кириллица)'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }
}

// Функция проверки присутствия арифметических символов в строке выражения
function validateArithmeticSymbolsExistance($statement, $operations){
    $flag = false; // Стартовое значение флага

    for($i = 0; $i < sizeof($operations); $i++) if(strpos($statement, $operations[$i]) !== false) $flag = true; // Если в строке найден арифметический символ, выполнение продолжается (при прочих равных)
    if($flag === false){ // Если нет арифметических символов - вохвращается ошибка
        echo json_encode(['result' => 'Ошибка. В строке отсутствуют арифметические символы'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }
}