<?php $this->pageTitle = 'Каталог - ' . $this->pageTitle ?>
<?php// if ($this->beginCache('catalog_'.Yii::app()->globalSettings->cache_version, array('duration' => 3600))) { ?>

    <div class="section-catalog row">
        <div id="leftCol" class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
            <?php $this->renderPartial('//category/_sidebar'); ?>
        </div>
        <div class="col-sm-9 col-md-9 col-lg-9">
            <?php $this->renderPartial('_catalog') ?>
        </div>
    </div>

    <?php //$this->endCache();} ?>
