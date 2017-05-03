<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle='Ошибка';
?>

<div class="row">
    <div class="col-lg-12">
        <?php if($code == '404'): ?>
            <div class="title big-title">404</div>
            <div class="title big-title">Странно, но такой странички у нас нет!</div>
        <?php else: ?>
            <div class="title big-title">Ой! Ошибочка вышла =(</div>
            <div class="title big-title">Скорее всего мы уже работаем над этим!</div>
        <?php endif; ?>
    </div>
</div>