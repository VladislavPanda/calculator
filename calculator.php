<?php

require_once 'operations.php'; // Подключение файла с массивом символов операций 

$statement = $_POST['statement'];

/*echo '<pre>';
var_dump($statement);
echo '</pre>';*/

echo json_encode(['result' => $statement]);