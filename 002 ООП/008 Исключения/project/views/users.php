<?php
/** @var \App\entities\UserEntity[] $users */
?>

<h1>Список пользователей</h1>

<?php foreach ($users as $user):?>
    <div class="">
        id: <?= $user->id ?><br>
        Логин: <?= $user->login ?><br>
        Дата рождения: <?= $user->bod ?><br>
        <a href="/?c=user&a=one&id=<?= $user->id ?>">Открыть</a><br>
        <hr>
    </div>
<?php endforeach; ?>
