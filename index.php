<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="utf-8">
    <title>Spa</title>
    <link rel="stylesheet" href="./css/index.css">
</head>

<body>
    <?php
    include 'utils/user-manager.php';
    include 'utils/personal-discount.php';
    include 'utils/birthday-discount.php';

    // Pavel pass 123
    // Victor pass 123456
    // Maria pass 122333
    // Polina pass 887766
    // Alexander pass 109876

    fopen('users.json', 'a');

    $discountExpiryTime = getPersonalDiscount();
    $isBirthday = getIsBirthdayToday();
    $_SESSION['isBirthday'] = $isBirthday;
    $remainingDaysToBirthDay = null;

    if (!$isBirthday) {
        $remainingDaysToBirthDay = getRemainingDaysToBirthday();
    }

    $isAnyActionExist = isset($_COOKIE['isPersonalDiscountActive']) || $isBirthday || $remainingDaysToBirthDay;
    ?>

    <header>
        <nav>
            <a href="/">Главная</a>
            <?php if (getCurrentUser()) { ?>
                <a href="/profile.php">Личный кабинет</a>
            <?php } ?>
            <a href="/login.php">Авторизация</a>
        </nav>
        <?php if (getCurrentUser()) { ?>
            <span>Добро пожаловать, <?= getCurrentUser() ?>!</span>
        <?php } ?>
    </header>
    <div>
        <h1 class="services">Каталог spa услуг</h1>
        <p>
            Массаж — обладает эффектом расслабления и успокоения.
            Техника массажа включает прикосновения внутренними частями ладоней и локтя.
            Лечебный эффект достигается за счет притока крови к внутренним органам,
            насыщения кислородом и воздействия на энергетически важные точки.
        </p>
    </div>
    <div class="content">

        <section>
            <article>
                <h2>Расслабляющий массаж</h2>
                <img src='images/masage.png'>
                <div class="price">
                    <?= getBirthdayDiscountPrice(3500) ?>₽
                </div>
                <span>
                    Расслабляющий массаж всего тела направлен на снятие напряжения и эмоциональной
                    усталости. Используются специальные мягкие, релаксирующие техники с ароматическими маслами.
                </span>
            </article>

            <article>
                <h2>Лимфодринажный массаж</h2>
                <img src='images/limfodrenazhnyy-massazh.png'>
                <div class="price">
                    <?= getBirthdayDiscountPrice(5800) ?>₽
                </div>
                <span>
                Процедура, направленная на стимуляцию работы лимфатической системы и облегчение 
                движения жидкости в организме. Ускорение лимфотока способствует освобождению клеток и тканей от токсинов.
                </span>
            </article>

            <article>
                <h2>Массаж камнями</h2>
                <img src='images/stoun-massazh.png'>
                <div class="price">
                    <?= getBirthdayDiscountPrice(4000) ?>₽
                </div>
                <span>
                    Cтимулирует биологически активные области организма, прогрев или охлаждение глубокого слоя кожи,
                    разминает мышцы, снимает боли в спине, мышцах и суставах; повышает иммунитет, улучшает дыхание, тонус сосудов.
                </span>
            </article>

            <article>
                <h2>Комплекс для лица</h2>
                <img src='images/Face-spa.png'>
                <div class="price">
                    <?= getBirthdayDiscountPrice(3300) ?>₽
                </div>
                <span>
                Программа состоит из массажа лица и маски с вулканической глиной, которая хорошо очищает, сужает поры, 
                нормализует жировой баланс кожи, разглаживает мелкие морщинки, а также повышает тургор кожи.
                </span>
            </article>

            <article>
                <h2>СПА для волос </h2>
                <img src='images/spa-heir.png'>
                <div class="price">
                    <?= getBirthdayDiscountPrice(2600) ?>₽
                </div>
                <span>
                Многоступенчатый уход, целью которого является восстановление и улучшение структуры волоса изнутри. 
                Благодаря своим ингредиентам уход выстраивает биологическую мембрану, повышает ее антиоксидантные свойства.
                </span>
            </article>

            <article>
                <h2>Минеральные ванны</h2>
                <img src='images/spa.png'>
                <div class="price">
                    <?= getBirthdayDiscountPrice(3500) ?>₽
                </div>
                <span>
                    Такие ванны способствуют укреплению стенок кровеносных сосудов, улучшают микроциркуляцию крови, 
                    снижают холестерин, ускоряет обмен веществ, снимают зуд, увлажняют, питают, разглаживают кожу.
                </span>
            </article>
        </section>

        <?php if ($isAnyActionExist) { ?>
            <aside>
                <h3>Акции</h3>
                <?php
                if (isset($_COOKIE['isPersonalDiscountActive'])) { ?>
                    <div class="personal-discount-timer">
                        <h4>Персональная скидка</h4>
                        <div>Позвоните на горячую линию для деталей</div>
                        <hr>
                        <div>
                            <?= $discountExpiryTime ?>
                            <br>
                            до конца акции
                        </div>
                    </div>
                <?php }
                if ($isBirthday || $remainingDaysToBirthDay) { ?>
                    <div class="birthday-discount">
                        <h4>Скидка именниника</h4>
                        <?php
                        if ($isBirthday) { ?>
                            <div>Поздравляем Вас с днем рождения, Вы получили скидку на все услуги 5%!</div>
                            <?php
                        }
                        if ($remainingDaysToBirthDay) { ?>
                            <div>
                                До дня рождения осталось: <?= $remainingDaysToBirthDay ?> дней
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </aside>
        <?php } ?>
    </div>
</body>