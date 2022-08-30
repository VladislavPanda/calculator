<?php
// Файл функций-валидаторов введённой строки выражения

// Функция проверки - есть ли в строке буквенные символы (латинские или кирилличиские). Если да, выбрасывается ошибка
function validateAcceptableSymbols($statement, $operations, &$errors){
    $statement = str_split($statement);
    $statementLength = sizeof($statement);

    for($i = 0; $i < $statementLength; $i++){
        if($statement[$i] == '.') continue;

        if(!in_array($statement[$i], $operations) && !preg_match('~[0-9]+~', $statement[$i])){
            $errors[] = 'Ошибка! Обнаружены недопустимые символы';
            break;
        }
    }
}

// Функция проверки присутствия арифметических символов в строке выражения
function validateArithmeticSymbolsExistance($statement, $operations, &$errors){
    $flag = false; // Стартовое значение флага

    for($i = 0; $i < sizeof($operations); $i++) if(strpos($statement, $operations[$i]) !== false) $flag = true; // Если в строке найден арифметический символ, значение флага меняется на истину
    if($flag === false) $errors[] = 'Ошибка! В строке отсутствуют арифметические символы'; // Если нет арифметических символов - возращается ошибка
}

// Функция проверки корректности расположения арифметических символов
function validateSequentialOperators($statement, $operations, &$errors){
    $statement = str_split($statement);

    if(in_array($statement[0], $operations) || in_array(end($statement), $operations))
        $errors[] = 'Ошибка! Арифметические символы не могут располагаться в начале или конце строки';

    for($i = 0; $i < sizeof($statement); $i++){
        if(in_array($statement[$i], $operations) && in_array($statement[$i+1], $operations)){ // Если следующий символ после найденного арифметического также арифметический - выбрасываем ошибку 
            $errors[] = 'Ошибка! Обнаружен повтор арифметических символов';
            break;
        }
    }
}