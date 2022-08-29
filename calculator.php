<?php

$statement = $_POST['statement'];

echo json_encode(['result' => $statement]);