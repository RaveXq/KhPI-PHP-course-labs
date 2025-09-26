<?php
$logFile = "log.txt";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === "Записати") {
        $text = trim($_POST['userdata']);

        if (!empty($text)) {
            file_put_contents($logFile, $text . PHP_EOL, FILE_APPEND);
            echo "Текст збережений у log.txt<br><br>";
        } else {
            echo "Поле не може бути порожнім.<br><br>";
        }
    }

    if ($action === "Переглянути вміст файлу") {
        if (file_exists($logFile)) {
            echo "<h3>Вміст log.txt:</h3>";
            $content = file_get_contents($logFile);
            echo nl2br(htmlspecialchars($content));
        } else {
            echo "Файл log.txt ще не створено.";
        }
    }
}

echo '<br><br><a href="index.html">Повернутись</a>';
?>
