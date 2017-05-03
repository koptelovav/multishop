<?php
/* @var $this ProductsController */
/* @var $dataProvider CActiveDataProvider */
$this->pageTitle = 'Каталог';
?>
<div id="columns">
    <div class="category products">
        <?php foreach (Yii::app()->shop->shop->categories as $index=>$category): ?>
            <div class="col-xs-6 col-sm-6 col-md-2 product-wrap">
                <div class="product">
                    <div class="left-column">
                        <a href="<?php echo Yii::app()->createUrl('/category/view', array('cid' => $category->id))?>">
                            <img class="img-responsive" src="<?php echo Yii::app()->imageApi->createUrl(BambooImage::CATEGORY_ICON, Yii::app()->media->webroot.$category->icon) ?>"/>
                        </a>
                    </div>

                    <div class="right-column">
                        <a href="<?php echo Yii::app()->createUrl('/category/view', array('cid' => $category->id))?>">
                            <h4 class="text-center"><?php echo $category->short_title?></h4>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>