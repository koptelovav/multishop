<div class="form-group">
    <?php echo $form->labelEx($model, 'short_title', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->textField($model, 'short_title', array('size' => 60, 'maxlength' => 64)); ?>
        <?php echo $form->error($model, 'short_title'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'title', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->textField($model, 'title', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'title'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'slug', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->textField($model, 'slug', array('size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'slug'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'meta_description', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->textArea($model, 'meta_description', array('class' => 'char-count', 'rows' => 6, 'cols' => 60)); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'meta_keywords', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo $form->textArea($model, 'meta_keywords', array('class' => 'char-count', 'rows' => 6, 'cols' => 60)); ?>
        <?php echo $form->error($model, 'meta_keywords'); ?>
    </div>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'description', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php
        $this->widget('backend.extensions.tinymce.TinyMce', array(
            'model' => $model,
            'attribute' => 'description',
            // Optional config
            'compressorRoute' => 'products/compressor',
            //'spellcheckerUrl' => array('tinyMce/spellchecker'),
            // or use yandex spell: http://api.yandex.ru/speller/doc/dg/tasks/how-to-spellcheck-tinymce.xml
            'spellcheckerUrl' => 'http://speller.yandex.net/services/tinyspell',
            'fileManager' => array(
                'class' => 'backend.extensions.elFinder.TinyMceElFinder',
                'connectorRoute' => 'products/connector',
            ),
            'htmlOptions' => array(
                'rows' => 6,
                'cols' => 60,
            ),
        ));
        ?>
        <?php echo $form->error($model, 'description'); ?>
    </div>
</div>