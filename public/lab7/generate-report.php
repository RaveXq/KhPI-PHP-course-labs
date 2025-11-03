<?php
// Серверне кешування у файл 

date_default_timezone_set('Europe/Kiev');

// Шлях до кешу і час кешування (600 секунд)
$cache_file = 'cache/report.html';
$cache_time_seconds = 600; 

// Перевірка кешу
if (file_exists($cache_file) && (time() - filemtime($cache_file)) < $cache_time_seconds) {
    // Кеш свіжий, читаємо його і віддаємо
    readfile($cache_file);
    exit;
}

// Генерація HTML-звіту (якщо кеш не спрацював)
ob_start();
sleep(3); // Затримка

$source = "Згенеровано щойно (3 сек)";
$time = date('H:i:s');
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>HTML-звіт</title>
    <style>
        body { font-family: sans-serif; font-size: 14px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ccc; padding: 5px; }
        th { background: #f0f0f0; }
        .header { background: #e0e0e0; padding: 10px; }
    </style>
</head>
<body>
    <div class="header">
        <strong>Великий HTML-звіт</strong><br>
        Джерело: <?php echo $source; ?><br>
        Час генерації: <?php echo $time; ?>
    </div>
    <table>
        <tr><th>ID</th><th>Ім'я</th><th>Сума</th><th>Дата</th></tr>
        <?php for ($i = 1; $i <= 1000; $i++): ?>
            <tr>
                <td><?php echo $i; ?></td>
                <td>Користувач <?php echo rand(100, 999); ?></td>
                <td><?php echo rand(100, 5000); ?> грн</td>
                <td><?php echo date('Y-m-d', time() - rand(0, 86400*30)); ?></td>
            </tr>
        <?php endfor; ?>
    </table>
</body>
</html>
<?php

// Отримуємо вміст буфера у змінну
$generated_content = ob_get_clean();

// Зберігаємо згенерований контент у файл кешу
file_put_contents($cache_file, $generated_content);

// Віддаємо згенерований контент користувачу
echo $generated_content;
?>


