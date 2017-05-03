<?php $this->beginContent('//layouts/main'); ?>
<div class="panel panel-default">
    <!-- Default panel contents -->
    <div class="panel-heading">
        <div class="pull-left"><?php echo $this->panelTitle ? $this->panelTitle : $this->pageTitle ?></div>
        <div class="control text-right pull-right">
            <?php
            foreach($this->getPanelButtons() as $button){
                echo $button.' ';
            }
            ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <?php echo $content; ?>
    </div>
</div>
<?php $this->endContent(); ?>