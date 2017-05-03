<?php

$this->firstTitle = $this->pageTitle;
$this->secondTitle = 'Погрузитесь в разнообразие цветов и форм';
$this->bannerUrl = Yii::app()->media->baseUrl.'/images/products/mymagformers_2_0/category_background/piece.jpg';
?>

<div id="columns">
    <div id="category-list-view">
        <div class="category--title">Элементы конструктора Магформерс</div>
        <div class="row products">
            <?php foreach ($pieces as $piece):?>
                <?php $this->renderPartial('_view',array('data'=>$piece))?>
            <?php endforeach ?>
        </div>
    </div>
</div>
