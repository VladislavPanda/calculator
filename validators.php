<?php

// Функция проверки - есть ли в строке буквенные символы (латинские или кирилличиские). Если да, выбрасывается ошибка
function validateAcceptableSymbols($statement){
    $latinSymbolsFlag = preg_match("/[a-z]/i", $statement); // Проверка на латинские буквенные символы
    $cyrrilicSymbolsFlag = preg_match("/[\p{Cyrillic}]/u", $statement); // Проверка на кириллические буквенные символы
    
    if($latinSymbolsFlag == 1 || $cyrrilicSymbolsFlag == 1){ // Если найдены латинские или кириллические буквенные символы в строке выражения - возвращается ошибка 
        echo json_encode(['result' => 'Ошибка! В строке содержатся недопустимые символы (латиница или кириллица)'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }
}

// Функция проверки присутствия арифметических символов в строке выражения
function validateArithmeticSymbolsExistance($statement, $operations){
    $flag = false; // Стартовое значение флага

    for($i = 0; $i < sizeof($operations); $i++) if(strpos($statement, $operations[$i]) !== false) $flag = true; // Если в строке найден арифметический символ, значение флага меняется на истину
    if($flag === false){ // Если нет арифметических символов - возращается ошибка
        echo json_encode(['result' => 'Ошибка! В строке отсутствуют арифметические символы'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
        exit;
    }
}

// Функция проверки строки выражения: следуют ли арифметические символы друг за другом
function validateSequentialOperators($statement, $operations){
    $statement = str_split($statement);

    for($i = 0; $i < sizeof($statement); $i++){
        if(in_array($statement[$i], $operations) && in_array($statement[$i+1], $operations)){
            echo json_encode(['result' => 'Ошибка! Обнаружен повтор арифметических символов'], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            exit;
        }
    }
}