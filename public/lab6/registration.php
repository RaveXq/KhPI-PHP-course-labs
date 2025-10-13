<?php

require_once "db.php";

$username_err = $email_err = $password_err = "";
$username = $email = $password = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty(trim($_POST["username"]))) {
        $username_err = "Будь ласка, введіть ім'я користувача.";
    } else {
        $sql = "SELECT id FROM users WHERE username = ?";
        
        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            $param_username = trim($_POST["username"]);
            
            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);
                
                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $username_err = "Це ім'я користувача вже зайняте.";
                } else {
                    $username = trim($_POST["username"]);
                }
            } else {
                echo "Щось пішло не так. Спробуйте пізніше.";
            }
            mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($_POST["email"]))) {
        $email_err = "Будь ласка, введіть email.";
    } else {
        $sql = "SELECT id FROM users WHERE email = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            $param_email = trim($_POST["email"]);

            if (mysqli_stmt_execute($stmt)) {
                mysqli_stmt_store_result($stmt);

                if (mysqli_stmt_num_rows($stmt) == 1) {
                    $email_err = "Цей email вже використовується.";
                } else {
                    $email = trim($_POST["email"]);
                }
            } else {
                echo "Щось пішло не так. Спробуйте пізніше.";
            }
             mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($_POST["password"]))) {
        $password_err = "Будь ласка, введіть пароль.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Пароль має містити щонайменше 6 символів.";
    } else {
        $password = trim($_POST["password"]);
    }

    if (empty($username_err) && empty($email_err) && empty($password_err)) {
        
        $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashed_password);
            
            if (mysqli_stmt_execute($stmt)) {
                header("location: login.php");
                exit();
            } else {
                echo "Щось пішло не так під час збереження.";
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
    <title>Реєстрація</title>
</head>
<body>
    <div class="wrapper">
        <h2>Реєстрація</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Ім'я користувача</label>
                <input type="text" name="username" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>">
                <span class="help-block"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Пароль</label>
                <input type="password" name="password">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn" value="Зареєструватися">
            </div>
            <p>Вже маєте акаунт? <a href="login.php">Увійти</a>.</p>
        </form>
    </div>
</body>
</html>

