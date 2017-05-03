<?php
$this->pageTitle = $model->title;
$this->breadcrumbs = [
    'Элементы магформерс' => Yii::app()->createUrl('piece/index'),
    $model->title
];
?>


<div id="piece" class="piece-view" itemscope itemtype="http://schema.org/Product">
    <div class="piece-view--title" itemprop="name"><?php echo $model->title ?></div>

    <div class="piece-view--inside row">
        <div class="col-xs-6 piece--left-column">
            <div class="piece-image general-piece-image">
                <a itemprop="image" class="fancybox" rel="gallery"
                   href="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_POPUP, Yii::app()->media->webroot . $model->preview_image) ?>">
                    <img class="img-responsive"
                         src="<?= Yii::app()->imageApi->createUrl(PHtml::IMAGE_VIEW, Yii::app()->media->webroot . $model->preview_image) ?>"/>
                </a>
            </div>
        </div>
        <div class="col-xs-6 piece--right-column">
            <div class="piece-view--title">Описание</div>
            <span class="piece-view--description" itemprop="description">
                     <?php echo $model->description; ?>
                 </span>
        </div>
    </div>
</div>

<div class="piece-view--title">Данный элемент содержится в следующих наборах:</div>

<div class="products row">
    <?php foreach ($model->products as $product): ?>
        <?php $this->renderPartial('//products/_view', ['data'=>$product])?>
    <?php endforeach ?>
</div>
