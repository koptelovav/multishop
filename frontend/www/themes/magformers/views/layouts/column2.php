<?php $this->beginContent('//layouts/main'); ?>
    <?php if(!empty($this->showHeader)): ?>
        <div class="block">
            <h1 class="block-header"><?php echo $this->pageTitle ?></h1>
            <?php if(!empty($this->breadcrumbs)): ?>
                <div class="breadcrumbs">
                    <?php $this->widget('zii.widgets.CBreadcrumbs', array(
                        'separator' => '<span class="delimiter"> / </span>',
                        'links'=>$this->breadcrumbs,
                    )); ?>
                </div>
            <?php endif ?>
        </div>
    <?php endif ?>
    <div class="row">
        <div class="column column-left">
            <div class="block">
                <div class="block-title">
                   Каталог
                </div>
            </div>
        </div>
        <div class="column column-right">
            <?php echo $content; ?>
        </div>
    </div>
<?php $this->endContent(); ?>