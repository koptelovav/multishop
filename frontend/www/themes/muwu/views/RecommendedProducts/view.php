<div id="blocks">
    <div class="container">
        <div class="row">
            <div class="title col-lg-12">А еще у нас есть:</div>
        </div>
        <div class="row">
            <?php foreach($recommend as $data):?>
                <div class="block inner col-12 col-sm-6 col-lg-3">
                    <div class="inner">
                        <div class="bordered">
                            <div class="title">
                                <a href="<?= Yii::app()->createUrl('products/view', array('id'=>$data->id, 'title'=>$data->short_title)); ?>"><?= CHtml::encode($data->short_title); ?></a>
                            </div>
                            <a href="<?=  Yii::app()->createUrl('products/view', array('id'=>$data->id, 'title'=>$data->short_title)); ?>">
                                <img class="img-responsive" src="<?= Yii::app()->image->createUrl( 'bbthumbnail', Yii::app()->media->webroot.$data->image); ?>" alt="<?= CHtml::encode($data->short_title); ?>"/>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>