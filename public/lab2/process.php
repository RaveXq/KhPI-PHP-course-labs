<?php
$uploadDir = "uploads/";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['userfile'])) {
        $file = $_FILES['userfile'];
        $fileName = basename($file['name']);
        $fileTmp = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if (is_uploaded_file($fileTmp)) {
            $allowed = ['jpg', 'jpeg', 'png'];
            if (!in_array($fileType, $allowed)) {
                die("Дозволені лише зображення (jpg, jpeg, png).");
            }

            if ($fileSize > 2 * 1024 * 1024) {
                die("Файл завеликий (максимум 2 МБ).");
            }

            $targetFile = $uploadDir . $fileName;
            if (file_exists($targetFile)) {
                $fileName = pathinfo($fileName, PATHINFO_FILENAME) . "_" . time() . "." . $fileType;
                $targetFile = $uploadDir . $fileName;
            }

            if (move_uploaded_file($fileTmp, $targetFile)) {
                echo "Файл успішно завантажений!<br>";
                echo "Ім’я: " . htmlspecialchars($fileName) . "<br>";
                echo "Тип: " . $fileType . "<br>";
                echo "Розмір: " . round($fileSize / 1024, 2) . " КБ<br>";
                echo '<a href="' . $targetFile . '" download>Завантажити файл</a><br>';
                echo '<br><a href="index.html">Повернутись</a>';
            } else {
                echo "Помилка при збереженні файлу.";
            }
        } else {
            echo "Файл не завантажено.";
        }
    } else {
        echo "Файл не вибрано.";
    }
}
?>
