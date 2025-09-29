<?php
session_start();

$validLogin = 'admin';
$validPass  = 'admin';

if (isset($_SESSION['last_activity'])) {
    $inactive = time() - $_SESSION['last_activity'];
    if ($inactive > 300) {
        session_unset();
        session_destroy();
        header("Location: index.php?expired=1");
        exit;
    }
}
$_SESSION['last_activity'] = time();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = trim($_POST['login'] ?? '');
    $pass  = trim($_POST['password'] ?? '');

    if ($login === $validLogin && $pass === $validPass) {
        $_SESSION['user'] = $login;
        header("Location: index.php");
        exit;
    } else {
        $error = 'Невірний логін або пароль';
    }
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Сесії</title>
</head>
<body>

<h1>Робота з сесіями</h1>

<?php if (isset($_SESSION['user'])): ?>

    <p>Вітаю, <b><?= htmlspecialchars($_SESSION['user']) ?></b></p>
    <p>Ви зараз у системі.</p>

    <a href="logout.php">Вийти</a>

<?php else: ?>

    <?php if (!empty($_GET['expired'])): ?>
        <p style="color: red;">Сесію завершено через неактивність</p>
    <?php endif; ?>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="post">
        <label>Логін:</label><br>
        <input type="text" name="login"><br><br>

        <label>Пароль:</label><br>
        <input type="password" name="password"><br><br>

        <input type="submit" value="Увійти">
    </form>

<?php endif; ?>

</body>
</html>
