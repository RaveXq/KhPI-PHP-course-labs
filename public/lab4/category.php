<?php

require_once 'product.php';

class Category {
    public $name;
    private $products = [];

    public function __construct($name) {
        $this->name = $name;
    }

    public function addProduct(Product $product) {
        $this->products[] = $product;
    }

    public function displayProducts() {
        echo "<h2>Категорія: {$this->name}</h2>";
        if (empty($this->products)) {
            echo "<p>В цій категорії ще немає товарів.</p>";
        } else {
            foreach ($this->products as $product) {
                $product->getInfo();
                echo "<hr>";
            }
        }
    }
}