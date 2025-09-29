<?php
session_start();

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 300)) {
    session_unset();
    session_destroy();
    setcookie('prev_cart', '', time() - 3600, '/'); 
    header("Location: index.php?timeout=1");
    exit;
}
$_SESSION['last_activity'] = time();

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_POST['product']) && $_POST['product'] !== '') {
    $product = trim($_POST['product']);
    $_SESSION['cart'][] = $product;

    $previous = [];
    if (isset($_COOKIE['prev_cart'])) {
        $previous = json_decode($_COOKIE['prev_cart'], true) ?: [];
    }

    $merged = array_unique(array_merge($previous, $_SESSION['cart']));

    setcookie('prev_cart', json_encode($merged), time() + (86400 * 7), '/'); 

    header("Location: index.php?added=1");
    exit;
}

if (isset($_POST['clear_cart'])) {
    $_SESSION['cart'] = [];
    header("Location: index.php?cleared=1");
    exit;
}

if (isset($_POST['clear_cookie'])) {
    setcookie('prev_cart', '', time() - 3600, '/');
    header("Location: index.php?cookie_cleared=1");
    exit;
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Корзина покупок</title>

</head>
<body>

<h1>Корзина покупок</h1>

<?php if (isset($_GET['added'])): ?>
    <div class="msg">Товар успішно додано.</div>
<?php elseif (isset($_GET['cleared'])): ?>
    <div class="msg warning">Корзину очищено.</div>
<?php elseif (isset($_GET['cookie_cleared'])): ?>
    <div class="msg warning">Cookie з попередніми покупками очищено.</div>
<?php elseif (isset($_GET['timeout'])): ?>
    <div class="msg warning">Сесію завершено через неактивність.</div>
<?php endif; ?>


<form method="post" action="">
    <label for="product">Назва товару:</label>
    <input type="text" name="product" id="product" required>
    <input type="submit" value="Додати">
</form>


<h2>Поточна корзина (сесія)</h2>
<?php if (!empty($_SESSION['cart'])): ?>
    <ul>
        <?php foreach ($_SESSION['cart'] as $item): ?>
            <li><?= htmlspecialchars($item) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Корзина порожня.</p>
<?php endif; ?>


<h2>Попередні покупки (cookie)</h2>
<?php
$prev = isset($_COOKIE['prev_cart']) ? json_decode($_COOKIE['prev_cart'], true) : [];
if (!empty($prev)):
?>
    <ul>
        <?php foreach ($prev as $item): ?>
            <li><?= htmlspecialchars($item) ?></li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p>Немає попередніх покупок.</p>
<?php endif; ?>


<form method="post" action="">
    <input type="submit" name="clear_cart" value="Очистити корзину">
    <input type="submit" name="clear_cookie" value="Очистити cookie">
</form>

</body>
</html>
