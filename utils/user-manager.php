<?php
function getUsersList() {
    $usersListRaw = file_get_contents('users.json');
    return json_decode($usersListRaw, true);
}

function existsUser($login) {
    $usersList = getUsersList();
    return isset($usersList[$login]);
}

function checkPassword($login, $password) {
    $usersList = getUsersList();
    return sha1($password) === $usersList[$login]['password'];
}

function getCurrentUser() {
    session_start();
    return $_SESSION['login'] ?? null;
}

function getCurrentUserBirthDate() {
    $usersList = getUsersList();
    return isset($usersList[getCurrentUser()]['birthDate']) ?
    $usersList[getCurrentUser()]['birthDate'] :
    null;
}

function updateUser($login, $birthDate) {
    $usersList = getUsersList();
    $loggedUser = $usersList[$login];
    $loggedUser['birthDate'] = $birthDate ?? null;
    $usersList[$login] = $loggedUser;
    file_put_contents('users.json', json_encode($usersList));
}

function logout() {
    session_unset();
    setcookie(session_name(), '');
    setcookie('isPersonalDiscountWasShown', '');
    setcookie('isPersonalDiscountActive', '');
    header('Location: /');
}
?>