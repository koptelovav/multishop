<div class="row">
    <?php foreach(Attachment::$types as $type=>$name):?>
        <div class="col-lg-3">
            <h4><?php echo $name; ?></h4>
            <div class="scroll-box">
                <?php echo CHtml::checkBoxList('Products[attachments]', CHtml::listData($model->attachments, 'id', 'id'), CHtml::listData(Attachment::getAllAttachmentsByType($type), 'id', 'title'), array()); ?>
            </div>
        </div>
    <?php endforeach ?>
</div>