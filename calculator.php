<?php

require_once 'operations.php'; // Подключение файла с массивом символов операций 
require_once 'validators.php'; // Подключение файла методов валидации пришедшей строки

$statement = $_POST['statement']; // Приём на сервер строки арифметического выражения с клиента
$errors = []; // Массив ошибок

validateAcceptableSymbols($statement, $errors); // Функция проверки на допустимые символы
validateArithmeticSymbolsExistance($statement, $operations, $errors); // Функция проверки на наличие в строке выражения арифметических символов и их следования одного за другим
validateSequentialOperators($statement, $operations, $errors); // Функция проверки строки выражения: следуют ли арифметические символы друг за другом

print_r($errors);

// $errors = array_unique($errors);
echo json_encode(['result' => $statement], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES); // Возврат результата вычисления