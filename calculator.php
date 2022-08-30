<?php

require_once 'operations.php'; // Подключение файла с массивом символов операций 
require_once 'validators.php'; // Подключение файлы методов валидации пришедшей строки

$statement = $_POST['statement'];

validateAcceptableSymbols($statement); // Функция проверки на допустимые символы
validateArithmeticSymbolsExistance($statement, $operations);

echo json_encode(['result' => $statement], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);