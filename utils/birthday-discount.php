<?php
function getIsBirthdayToday() {
    if (!getCurrentUser() || !getCurrentUserBirthDate()) {
        return;
    }

    $userBirthDate = date_format(new DateTime(), 'Y') . substr(getCurrentUserBirthDate(), 4);

    return date_format(new DateTime(), 'm-d') === date_format(new DateTime($userBirthDate), 'm-d');
}

function getRemainingDaysToBirthday() {
    if (!getCurrentUser() || !getCurrentUserBirthDate()) {
        return;
    }

    $userBirthDate = date_format(new DateTime(), 'Y') . substr(getCurrentUserBirthDate(), 4);
    $isBirthDayAlreadyHappend = date_diff(new DateTime(), new DateTime($userBirthDate))->invert;

    if ($isBirthDayAlreadyHappend) {
        $userBirthDate = date_format(new DateTime('next Year'), 'Y') . substr(getCurrentUserBirthDate(), 4);
    }

    $remainingDaysToBirthDay = date_diff(new DateTime(), new DateTime($userBirthDate))->format('%a');
    $remainingDaysToBirthDay++;

    return $remainingDaysToBirthDay;
}

function getBirthdayDiscountPrice($price) {
    return $_SESSION['isBirthday'] ? round($price * 0.95) : $price;
}
?>