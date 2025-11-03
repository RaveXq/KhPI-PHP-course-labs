<?php
// Клієнтське кешування (CSS)

// Встановлюємо, що кешуватимемо на 1 день (86400 секунд)
$cache_duration_seconds = 86400; 
$expires_gmt = gmdate('D, d M Y H:i:s', time() + $cache_duration_seconds) . ' GMT';

// Надсилаємо заголовок Cache-Control
header("Cache-Control: public, max-age=" . $cache_duration_seconds);

// Надсилаємо заголовок Expires
header("Expires: " . $expires_gmt);

// Надсилаємо відповідний MIME-тип
header("Content-Type: text/css");
?>
/* CSS-файл */
body {
    font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
    background-color: #f4f7f6;
    color: #333;
    line-height: 1.6;
}
.container {
    max-width: 900px;
    margin: 20px auto;
    padding: 20px;
    background: #ffffff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.05);
}
h1, h2 {
    color: #0056b3;
    border-bottom: 2px solid #eef;
    padding-bottom: 5px;
}
.test-block {
    margin-top: 20px;
    padding: 15px;
    background: #fafafa;
    border: 1px solid #eee;
    border-radius: 5px;
}
img {
    border: 1px solid #ddd;
    border-radius: 4px;
    padding: 5px;
    background: white;
}
.report-frame {
    width: 100%;
    height: 200px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background: white;
}
.simple-frame {
    height: 100px;
}

