<?php

require_once 'operations.php'; // Подключение файла с массивом символов операций 
require_once 'validators.php'; // Подключение файла методов валидации пришедшей строки

$statement = $_POST['statement']; // Приём на сервер строки арифметического выражения с клиента
$statement = preg_replace("/\s+/", "", $statement); // Убрать все пробелы из строки
$errors = []; // Массив ошибок

validateAcceptableSymbols($statement, $operations, $errors); // Функция проверки на допустимые символы
validateArithmeticSymbolsExistance($statement, $operations, $errors); // Функция проверки на наличие в строке выражения арифметических символов и их следования одного за другим
validateSequentialOperators($statement, $operations, $errors); // Функция проверки корректности расположения арифметических символов
validateDotPositions($statement, $operations, $errors); // Функция проверки корректности расположения символа '.'
if(!preg_match('~[0-9]+~', $statement)) $errors[] = 'Ошибка! В строке отсутствуют цифры'; // Проверка присутствия в строке выражения чисел

print_r($errors);

// $errors = array_unique($errors);
echo json_encode(['result' => $statement], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES); // Возврат результата вычисления