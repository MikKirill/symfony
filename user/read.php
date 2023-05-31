<?php

// необходимые HTTP-заголовки
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение к базе данных будет здесь
// подключение базы данных и файл, содержащий объекты
include_once "../objects/database.php";
include_once "../objects/user.php";

// получаем соединение с базой данных
$database = new Database();
$db = $database->getConnection();

// инициализируем объект
$product = new user($db);

// запрашиваем товары
$stmt = $product->read();
$num = $stmt->rowCount();

// проверка, найдено ли больше 0 записей
if ($num > 0) {


    // массив товаров
    $products_arr = array();
    $products_arr["user"] = array();


    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // извлекаем строку
        extract($row);
        $product_item = array(
            "id" => $id,
            "username" => $username,
            "city" => $city,
            "name" => $name


        );
        array_push($products_arr["user"], $product_item);
    }


    // устанавливаем код ответа - 200 OK
    http_response_code(200);

    // выводим данные о товаре в формате JSON
    echo json_encode($products_arr);
}

// "товары не найдены" будет здесь
else {
    // установим код ответа - 404 Не найдено
    http_response_code(404);

    // сообщаем пользователю, что товары не найдены
    echo json_encode(array("message" => "Пользователь не найден."), JSON_UNESCAPED_UNICODE);
}