<?php
/** @var \App\models\User[] $users */
?>

<h1>Список пользователей</h1>

<?php foreach ($users as $user):?>
    <div class="">
        id: <?= $user->id ?><br>
        Логин: <?= $user->login ?><br>
        Дата рождения: <?= $user->bod ?><br>
        <hr>
    </div>
<?php endforeach; ?>
