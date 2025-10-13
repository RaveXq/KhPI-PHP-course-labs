<?php

session_start();

if (isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true) {
    header("location: welcome.php");
    exit;
}

require_once "db.php";

$username = $password = "";
$username_err = $password_err = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Введіть ім'я користувача.";
    } else {
        $username = trim($_POST["username"]);
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Введіть пароль.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($password_err)) {
        $sql = "SELECT id, username, password FROM users WHERE username = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = $username;

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password_from_db);
                    if (mysqli_stmt_fetch($stmt)) {
                        if (password_verify($password, $hashed_password_from_db)) {
                            session_start();
                            
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
                            
                            header("location: welcome.php");
                        } else {
                            $password_err = "Невірний пароль.";
                        }
                    }
                } else {
                    $username_err = "Користувача з таким іменем не знайдено.";
                }
            } else {
                echo "Щось пішло не так. Спробуйте пізніше.";
            }
            mysqli_stmt_close($stmt);
        }
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Вхід</title>
</head>
<body>
    <div class="wrapper">
        <h2>Вхід</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Ім'я користувача</label>
                <input type="text" name="username">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Увійти">
            </div>
            <p>Немає акаунту? <a href="registration.php">Зареєструватися</a>.</p>
        </form>
    </div>
</body>
</html>
