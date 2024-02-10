<?php
/**
 * @var string $title
 * @var string $content
 */
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $title ?></title>
</head>
<body>
    <menu>
        <ul>
            <li>Главная</li>
            <li>Пользователи</li>
            <li>Авторизация</li>
        </ul>
    </menu>
    <div>
        <?= $content ?>
    </div>
</body>
</html>