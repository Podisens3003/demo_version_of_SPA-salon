<?php
function getPersonalDiscount() {
    setcookie('isPersonalDiscountWasShown', true, time() + (60 * 60 * 24 * 30));

    if (!isset($_COOKIE['isPersonalDiscountWasShown'])) {
        $personalDiscountExpiry = time() + (60 * 60 * 24);
        setcookie('isPersonalDiscountActive', $personalDiscountExpiry, $personalDiscountExpiry);
    }

    if (isset($_COOKIE['isPersonalDiscountActive'])) {
        $cookieExpiryTime = date_timestamp_set(new DateTime(), $_COOKIE['isPersonalDiscountActive']);
        return date_diff(new DateTime(), $cookieExpiryTime)->format('%H:%I:%S');
    }
}
?>