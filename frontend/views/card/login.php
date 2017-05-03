<?php
$this->pageTitle = 'Вход в личный кабинет'
?>

<div class="col-lg-4 col-lg-offset-4">
    <form class="form-signin" action="<?= $this->createUrl('login') ?>" method="POST">
        <input name="LoginForm[username]" type="text" class="form-control" placeholder="E-mail или телефон" autofocus>
        <input name="LoginForm[password]" type="password" class="form-control" placeholder="Пароль">
        <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    </form>
    <a href="<?php echo $this->createUrl('activation')?>">Активация новой карты</a>
</div>