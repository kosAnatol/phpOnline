<?php
/** @var \App\entities\UserEntity $user */
?>

<h1>Информация о пользователе <?= $user->login ?></h1>

<div class="">
    Логин: <?= $user->login ?><br>
    Дата рождения: <?= $user->bod ?><br>
    <hr>
</div>
