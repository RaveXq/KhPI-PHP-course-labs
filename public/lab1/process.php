<?php
// обробка даних з форми
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstName = trim($_POST["first_name"]);
    $lastName = trim($_POST["last_name"]);

    // перевірка на пусті значення
    if (empty($firstName) || empty($lastName)) {
        echo "Помилка: Поля не можуть бути пустими.";
    } else {
        // перевірка типу (повинні бути рядки)
        if (is_string($firstName) && is_string($lastName)) {
            echo "Вітаю, " . htmlspecialchars($firstName) . " " . htmlspecialchars($lastName) . "!";
        } else {
            echo "Невірний тип даних.";
        }
    }
} else {
    echo "Форма не була відправлена.";
}
?>
