<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    if (!empty($_POST['username'])) {
        $username = trim($_POST['username']);

        setcookie('username', $username, time() + 7*24*60*60);

        header("Location: index.php");
        exit;
    }

    if (isset($_POST['delete_cookie'])) {
        setcookie('username', '', time() - 3600);
        header("Location: index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Cookies</title>
</head>
<body>

<h1>Робота з cookies</h1>

<?php if (isset($_COOKIE['username'])): ?>

    <p>Вітаю, <b><?= htmlspecialchars($_COOKIE['username']) ?></b></p>

    <form method="post">
        <input type="submit" name="delete_cookie" value="Видалити cookie">
    </form>

<?php else: ?>

    <form method="post">
        <label>Введіть своє ім’я:</label><br>
        <input type="text" name="username"><br><br>
        <input type="submit" value="Зберегти">
    </form>

<?php endif; ?>

</body>
</html>
