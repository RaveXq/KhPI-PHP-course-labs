<?php
$uploadDir = "uploads/";

if (is_dir($uploadDir)) {
    $files = array_diff(scandir($uploadDir), ['.', '..']);

    if (count($files) > 0) {
        echo "<h2>Список файлів у папці uploads:</h2><ul>";
        foreach ($files as $file) {
            echo "<li><a href='$uploadDir$file' download>$file</a></li>";
        }
        echo "</ul>";
    } else {
        echo "Папка uploads порожня.";
    }
} else {
    echo "Папка uploads не існує.";
}

echo '<br><a href="index.html">Повернутись</a>';
?>
