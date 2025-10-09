<?php

require_once 'product.php';

class DiscountedProduct extends Product {
    private $discount;

    public function __construct($name, $price, $description, $discount) {
        parent::__construct($name, $price, $description);
        $this->discount = $discount;
    }

    public function getDiscountedPrice() {
        $finalPrice = $this->price - ($this->price * $this->discount / 100);
        return round($finalPrice, 2);
    }

    public function getInfo() {
        $originalPrice = $this->getPrice();
        $discountedPrice = $this->getDiscountedPrice();

        echo "<h3>Назва: {$this->name} (Акція!)</h3>";
        echo "<p>Стара ціна: <del>{$originalPrice} грн</del></p>";
        echo "<p><b>Нова ціна: {$discountedPrice} грн (Знижка {$this->discount}%)</b></p>";
        echo "<p>Опис: {$this->description}</p>";
    }
}