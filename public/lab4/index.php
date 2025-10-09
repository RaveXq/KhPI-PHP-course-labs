<?php
header('Content-Type: text/html; charset=utf-8');

require_once 'product.php';
require_once 'discounted_product.php';
require_once 'category.php';
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Лабораторна робота 4</title>
</head>
<body>
    <div class="container">
        <h1>Інтернет-магазин</h1>

        <?php
        $product1 = new Product("RTX 5090ti", 55999, "Відеокарта.");
        $product2 = new Product("Ryzen 7 7700x", 12999, "Процесор");
        $product_invalid = new Product("Ninjutso Sora v2", -999, "Миша.");

        $discountedProduct = new DiscountedProduct("Beyerdynamics DT 770", 7999, "Навушники.", 20);

        $techCategory = new Category("Комп'ютерні комплектуючі");
        $otherCategory = new Category("Переферія");

        $techCategory->addProduct($product1);
        $techCategory->addProduct($discountedProduct);
        $otherCategory->addProduct($product2);
        $otherCategory->addProduct($product_invalid);

        $techCategory->displayProducts();
        $otherCategory->displayProducts();
        ?>
    </div>
</body>
</html>