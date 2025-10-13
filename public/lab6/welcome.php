<?php

session_start();

if (!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true) {
    header("location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Захищена сторінка</title>
</head>
<body>
    <h1>Вітаємо, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b>!</h1>
    <h2>Ви успішно увійшли в акаунт.</h2>
    <p>
        <a href="logout.php">Вийти з акаунту</a>
    </p>
</body>
</html>
