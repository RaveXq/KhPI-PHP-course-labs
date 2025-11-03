<?php
// Серверне кешування через РНР-сесію
session_start();


$cache_time_seconds = 30; // Кешуємо на 30 секунд
$data = null;
$source = "Помилка";

function generateCurrencyData() {
    sleep(2); // Затримка 2 секунди
    return [
        'USD' => '40.' . rand(10, 40),
        'EUR' => '42.' . rand(50, 90)
    ];
}

if (isset($_SESSION['cached_currency']) && isset($_SESSION['cached_currency_time'])) {
    $age = time() - $_SESSION['cached_currency_time'];

    if ($age < $cache_time_seconds) {
        $data = $_SESSION['cached_currency'];
        $source = "З кешу сесії (залишилось " . ($cache_time_seconds - $age) . " сек)";
    } else {
        // Кеш застарів, генеруємо нові дані
        $data = generateCurrencyData();
        $_SESSION['cached_currency'] = $data;
        $_SESSION['cached_currency_time'] = time();
        $source = "Оновлено кеш (2 сек)";
    }
} else {
    // Кешу немає, генеруємо дані
    $data = generateCurrencyData();
    $_SESSION['cached_currency'] = $data;
    $_SESSION['cached_currency_time'] = time();
    $source = "Створено новий кеш (2 сек)";
}

// Виведення результату
?>
<div style="font-family: sans-serif; padding: 10px;">
    <p><strong>Поточні курси:</strong> <?php echo json_encode($data); ?></p>
    <small>Джерело: <?php echo htmlspecialchars($source); ?></small>
</div>

