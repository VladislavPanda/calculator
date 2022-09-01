<?php
// Файл функций-валидаторов введённой строки выражения

// Функция проверки на допустимые символы (цифры, точка, арифметические символы)
function validateAcceptableSymbols($statement, $operations, &$errors){
    $statement = str_split($statement);
    $statementLength = count($statement);

    for($i = 0; $i < $statementLength; ++$i){
        if($statement[$i] == '.') continue;

        // Проверка на символы - арифметические и цифры
        if(!in_array($statement[$i], $operations) && !preg_match('~[0-9]+~', $statement[$i])){
            $errors[] = 'Ошибка! Обнаружены недопустимые символы';
            break;
        }
    }
}

// Функция проверки присутствия арифметических символов в строке выражения
function validateArithmeticSymbolsExistance($statement, $operations, &$errors){
    $flag = false; // Стартовое значение флага

    foreach($operations as $operation){
        if(str_contains($statement, $operation)){ // Если в строке найден арифметический символ, ошибки нет 
            $flag = true;
            break;
        }
    }

    if($flag === false) $errors[] = 'Ошибка! В строке отсутствуют арифметические символы';
}

// Функция проверки корректности расположения арифметических символов
function validateSequentialOperators($statement, $operations, &$errors){
    $statement = str_split($statement);
    $statementLength = count($statement);

    if(in_array($statement[0], $operations) || in_array(end($statement), $operations))
        $errors[] = 'Ошибка! Арифметические символы не могут располагаться в начале или конце строки';

    for($i = 0; $i < $statementLength; $i++){
        if(in_array($statement[$i], $operations) && in_array($statement[$i+1], $operations)){ // Если следующий символ после найденного арифметического также арифметический - выбрасываем ошибку 
            $errors[] = 'Ошибка! Обнаружен повтор арифметических символов';
            break;
        }
    }
}

// Функция проверки корректности расположения символа '.'
function validateDotPositions($statement, $operations, &$errors){
    // Проверка - точки не могут располагаться в начале или конце строки
    if(substr($statement, 0, 1) == '.' || substr($statement, -1) == '.') 
        $errors[] = "Ошибка! Символ '.' не может располагаться в начале или конце строки";

    // Проверка - есть ли между двумя точками в строке арифметический символ
    $statement = str_split($statement);
    $dotPositions = array_keys($statement, '.'); // Находим все позиции символа '.'
    $lastElement = end($dotPositions);

    $flag = true;
    foreach($dotPositions as $key => $value){ // Цикл перебора позиций символа '.' в строке
        // Если не последний элемент - находим длину интервала между текущей и следующей точкой
        if($value != $lastElement) $intervalSize = $dotPositions[$key+1] - $value;
        else break;
        
        // Выбираем срез массива выражения от текущей точки до следующей
        $interval = array_slice($statement, $value, $intervalSize);  
        if(empty(array_intersect($operations, $interval))){ // Если в интервале нет арифметических символов - ошибка
            $flag = false;
            break;
        }
    }

    if($flag === false) $errors[] = 'Ошибка! Неверная запись дробных чисел';

    // Проверка на следование точки и арифметического символа друг за другом
    foreach($statement as $key => $value){
        if(in_array($value, $operations)){
            if($statement[$key+1] == '.' || $statement[$key-1] == '.'){
                $errors[] = 'Ошибка! Обнаружено следование точки за арифметическим символом';
                break;
            } 
        }
    }
}