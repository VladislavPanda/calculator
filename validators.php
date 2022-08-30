<?php

// Функция проверки - есть ли в строке буквенные символы (латинские или кирилличиские). Если да, выбрасывается ошибка
function validateAcceptableSymbols($statement, &$errors){
    $latinSymbolsFlag = preg_match("/[a-z]/i", $statement); // Проверка на латинские буквенные символы
    $cyrrilicSymbolsFlag = preg_match("/[\p{Cyrillic}]/u", $statement); // Проверка на кириллические буквенные символы

    if($latinSymbolsFlag == 1) $errors[] = 'Ошибка! В строке содержатся недопустимые символы (латиница)';
    if($cyrrilicSymbolsFlag == 1) $errors[] = 'Ошибка! В строке содержатся недопустимые символы (кириллица)';
}

// Функция проверки присутствия арифметических символов в строке выражения
function validateArithmeticSymbolsExistance($statement, $operations, &$errors){
    $flag = false; // Стартовое значение флага

    for($i = 0; $i < sizeof($operations); $i++) if(strpos($statement, $operations[$i]) !== false) $flag = true; // Если в строке найден арифметический символ, значение флага меняется на истину
    if($flag === false) $errors[] = 'Ошибка! В строке отсутствуют арифметические символы'; // Если нет арифметических символов - возращается ошибка
}

// Функция проверки строки выражения: следуют ли арифметические символы друг за другом
function validateSequentialOperators($statement, $operations, &$errors){
    $statement = str_split($statement);

    if(in_array($statement[0], $operations) || in_array(end($statement), $operations))
        $errors[] = 'Ошибка! Арифметические символы не могут располагаться в начале или конце строки';

    for($i = 0; $i < sizeof($statement); $i++){
        if(in_array($statement[$i], $operations) && in_array($statement[$i+1], $operations))
            $errors[] = 'Ошибка! Обнаружен повтор арифметических символов';
    }
}