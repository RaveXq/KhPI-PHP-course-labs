<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: not_post.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Сервер</title>
</head>
<body>

<h1>Інформація про сервер:</h1>

<ul>
    <li><strong>IP-адреса клієнта:</strong> <?= htmlspecialchars($_SERVER['REMOTE_ADDR']) ?></li>
    <li><strong>Браузер:</strong> <?= htmlspecialchars($_SERVER['HTTP_USER_AGENT']) ?></li>
    <li><strong>Скрипт:</strong> <?= htmlspecialchars($_SERVER['PHP_SELF']) ?></li>
    <li><strong>Метод запиту:</strong> <?= htmlspecialchars($_SERVER['REQUEST_METHOD']) ?></li>
    <li><strong>Шлях до файлу:</strong> <?= htmlspecialchars($_SERVER['SCRIPT_FILENAME']) ?></li>
</ul>

<p><a href="index.php">Назад</a></p>

</body>
</html>