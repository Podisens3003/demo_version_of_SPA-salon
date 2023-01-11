<?php
include 'utils/user-manager.php';

if ($_POST) {
    $birthDate = $_POST['birth-date'] ?? null;

    if (isset($_POST['submit'])) {
        updateUser(getCurrentUser(), $birthDate);
    }
    if (isset($_POST['logout'])) {
        logout();
    }
}
?>

<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Spa</title>
    <link rel="stylesheet" href="./css/profile.css">
</head>

<body>
    <header>
        <nav>
            <a href="/">Главная</a>
            <a href="/profile.php">Личный кабинет</a>
            <a href="/login.php">Авторизация</a>
        </nav>
    </header>

    <h2>Личный кабинет клиента</h2>
    <section>
        <div>
            <img src='images/kushetka-easteregg.png'>
            <span class="gradient"><?= getCurrentUser() ?></span>
        </div>
        <form action="profile.php" method="post">
            <span>Дата рождения</span>
            <input name="birth-date" type="date" placeholder="День рождения" value=<?= getCurrentUserBirthDate() ?? null ?>>
            <input name="submit" type="submit" value="Сохранить">
            <input class="logout-btn " name="logout" type="submit" value="Выйти из сессии">
        </form>
    </section>

</body>

</html>