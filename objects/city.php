<?php

class city
{
    // подключение к базе данных и таблице "products"
    private $conn;
    private $table_name = "city";

    // свойства объекта
    public $id;
    public $name;



    // конструктор для соединения с базой данных
    public function __construct($db)
    {
        $this->conn = $db;
    }

    // здесь будет метод read()
    // метод для получения товаров
    public function read ()
    {
        // выбираем все записи
        $query = "SELECT 
         c.id,c.name AS city
    FROM city c ;
";


        // подготовка запроса
        $stmt = $this->conn->prepare($query);

        // выполняем запрос
        $stmt->execute();
        return $stmt;
    }
    // метод для создания товаров
    function create()
    {
        $query = "INSERT INTO " . $this->table_name . " SET name=:name";

        $stmt = $this->conn->prepare($query);


        $this->name = htmlspecialchars(strip_tags($this->name));



        $stmt->bindParam(":name", $this->name);


        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
    function  update(){

        $query = "UPDATE " . $this->table_name . " SET name=:name  WHERE id=:id;";

        $stmt = $this->conn->prepare($query);

        $this->name = htmlspecialchars(strip_tags($this->name));
        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":name", $this->name);
        $stmt->bindParam(":id", $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
    // метод для удаления товара
    function delete()
    {
        $query = "DELETE FROM " . $this->table_name ." WHERE id=:id;";

        $stmt = $this->conn->prepare($query);

        $this->id = htmlspecialchars(strip_tags($this->id));

        $stmt->bindParam(":id", $this->id);

        $stmt->execute();

        return $stmt;
    }

}