<?php $this->pageTitle = 'Вход в личный кабинет';?>

<form class="form-signin" action="<?= $this->createUrl('login') ?>" method="POST">
    <input name="LoginForm[username]" type="text" class="form-control" placeholder="Логин" autofocus>
    <input name="LoginForm[password]" type="password" class="form-control" placeholder="Пароль">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
</form>