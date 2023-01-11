<?php
include 'utils/user-manager.php';

session_start();
$isAuthFailed = null;

if (!$_REQUEST) {
    if (getCurrentUser()) {
        header('Location: /');
    }
}

if ($_POST) {
    $username = $_POST['login'] ?? null;
    $password = $_POST['password'] ?? null;

    if (
        $username &&
        $password &&
        existsUser($username) &&
        checkPassword($username, $password)
    ) {
        $_SESSION['login'] = $username;
        header('Location: /profile.php');
    } else {
        $isAuthFailed = true;
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Spa</title>
    <link rel="stylesheet" href="./css/login.css">
</head>

<body>
    <header>
        <nav>
            <a href="/">Главная</a>
            <a href="/login.php">Авторизация</a>
        </nav>
    </header>
    <section>
        <h2>Авторизация</h2>
        <form action="login.php" method="post">
            <input name="login" type="text" placeholder="Логин">
            <input name="password" type="password" placeholder="Пароль">
            <span>
                <?php if ($isAuthFailed) { ?>
                    Пользователь не существует
                    <br>
                    или не верный пароль
                <?php } ?>
            </span>
            <input name="submit" type="submit" value="Войти">
        </form>
    </section>
</body>

</html>