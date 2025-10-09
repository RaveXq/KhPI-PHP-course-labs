<?php

class Product {
    public $name;
    public $description;
    protected $price;

    public function __construct($name, $price, $description) {
        $this->name = $name;
        $this->description = $description;

        if ($price < 0) {
            $this->price = 0;
            echo "<b>Помилка:</b> Ціна товару '{$this->name}' не може бути від'ємною, встановлено значення 0. <br>";
        } else {
            $this->price = $price;
        }
    }

    public function getInfo() {
        echo "<h3>Назва: {$this->name}</h3>";
        echo "<p>Ціна: {$this->price} грн</p>";
        echo "<p>Опис: {$this->description}</p>";
    }

    public function getPrice() {
        return $this->price;
    }
}