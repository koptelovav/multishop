<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs = SHtml::getCategoryBreadcrumbs($category);
?>

<?php if ($this->beginCache('catalog_'.$category->id.'_'.Yii::app()->globalSettings->cache_version, array('duration' => 3600))): ?>

<div class="section-catalog row">
    <div id="leftCol" class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
        <?php $this->renderPartial('_sidebar'); ?>
    </div>
    <div class="col-sm-9 col-md-9 col-lg-9">
        <h2 class="category-title"><?= $category->title ?></h2>

        <?php /*if($category->id == 60): ?>
            <div class="row">
                <div class="col-lg-12">
                    <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/action/kinetic_color_sale.jpg" alt="Акция на цветной кинтический песок" >
                </div>
            </div>
        <?php endif; */?>
        <div itemtype="http://schema.org/ItemList" itemscope>
        <?php $this->widget('zii.widgets.CListView', array(
            'id'=>'category-list-view',
            'dataProvider'=>$dataProvider,
            'itemView'=>'//products/_view',
            'ajaxUpdate' => true,
            'enableHistory'=>true,
            'enableSorting'=>true,
//        'summaryText' => 'Показано c {start} по {end} из {count} (Страница {page})',
            'template' => '{sorter}{items}{pager}',
            'itemsCssClass'=>'row products',
            'pager' => array(
                'firstPageLabel'=>'<<',
                'prevPageLabel'=>'Назад',
                'nextPageLabel'=>'Вперед',
                'lastPageLabel'=>'>>',
                'maxButtonCount'=>'10',
                'header'=>false,
                'cssFile'=>false,
            ),

        )); ?>
        </div>

        <?php if($category->id == 60): ?>
            <div class="h1 text-center">Специальные предложения</div>

            <div class="row">
                <div class="col-md-4 item-action">
                    <a href="/set-kinetic-sand/original-set-kinetic-sand">
                        <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/category_info/kinetic_sand_original.jpg" alt="Оригинальые наборы с кинетическим песком">
                    </a>
                </div>
                <div class="col-md-4 item-action">
                    <a href="/set-kinetic-sand/set-optima-kinetic-sand">
                        <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/category_info/kinetic_sand_oprima.jpg" alt="Наборы оптима. Все в комплекте">
                    </a>
                </div>
                <div class="col-md-4 item-action">
                    <a href="/accessories-kinetic-sand">
                        <img class="img-responsive" src="<?= Yii::app()->theme->baseUrl ?>/img/category_info/kinetic_sand_accessories.jpg" alt="Аксессуары для песка. Большой ассортимент">
                    </a>
                </div>
            </div>
        <?php endif; ?>

        <?php if(!empty($category->description)): ?>
            <div class="h1 text-center">Полезная информация</div>
            <div class="category-description">
                <?= $category->description ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php $this->endCache(); endif; ?>