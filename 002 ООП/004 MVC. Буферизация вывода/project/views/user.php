<?php
/** @var \App\models\User $user */
?>

<h1>Информация о пользователе <?= $user->login ?></h1>

<div class="">
    Логин: <?= $user->login ?><br>
    Дата рождения: <?= $user->bod ?><br>
    <hr>
</div>
