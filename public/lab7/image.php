<?php
// Клієнтське кешування (зображення)

date_default_timezone_set('Europe/Kiev');

// Час кешування 86400 секунди
$cache_duration_seconds = 86400;
$expires_gmt = gmdate('D, d M Y H:i:s', time() + $cache_duration_seconds) . ' GMT';

header("Cache-Control: public, max-age=" . $cache_duration_seconds);
header("Expires: " . $expires_gmt);

// Надсилаємо MIME-тип
header("Content-Type: image/png");

// Створення зображення
$image = imagecreatetruecolor(300, 100);
$bg_color = imagecolorallocate($image, 230, 240, 255);
$text_color = imagecolorallocate($image, 0, 86, 179);

imagefill($image, 0, 0, $bg_color);

// Пишемо час генерації, якщо кеш працює, час не буде оновлюватися
$time = date('H:i:s');
imagestring($image, 5, 20, 30, "Generated at:", $text_color);
imagestring($image, 5, 20, 50, $time, $text_color);

// Віддаємо зображення у браузер
imagepng($image);

// Звільняємо пам'ять
imagedestroy($image);
?>


