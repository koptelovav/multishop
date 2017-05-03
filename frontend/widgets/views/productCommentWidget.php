<?php
Yii::app()->clientScript->registerScript('comment-form',"
    $('#show-review').click(function(){
        $('#comment-form').toggle();
        return false;
    });

    $('#comment-form').submit(function(){

    });
    $('.rateit').on('rated', function(){
       $('#ProductComment_rating').val($(this).rateit('value')*2);
   });

 /*  $('#comment-form').submit(function(){
        $.ajax({
            type: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            success: function(data){

            }
        });
        return false;
   });
*/
", CClientScript::POS_READY);
?>

<a href="#" id="show-review">
    <h2>Оставить отзыв</h2>
</a>

<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'comment-form',
    'action'=> Yii::app()->createUrl('productComment/create'),
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
));
?>

<?php echo $form->errorSummary($model); ?>

<?php echo $form->hiddenField($model, 'product_id'); ?>
<?php echo $form->hiddenField($model, 'shop_id'); ?>

<div class="form-group">
    <?php echo $form->labelEx($model, 'user_name'); ?>
        <?php echo $form->textField($model, 'user_name', array('class' => 'form-control', 'size' => 60, 'maxlength' => 128)); ?>
        <?php echo $form->error($model, 'user_name'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'user_email'); ?>
        <?php echo $form->textField($model, 'user_email', array('class' => 'form-control', 'size' => 60, 'maxlength' => 64)); ?>
        <?php echo $form->error($model, 'user_email'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'rating'); ?>
    <div class="rateit"></div>
    <?php echo $form->hiddenField($model, 'rating'); ?>
    <?php echo $form->error($model, 'rating'); ?>
</div>

<div class="form-group">
    <?php echo $form->labelEx($model, 'text'); ?>
        <?php echo $form->textArea($model, 'text', array('class' => 'form-control', 'rows' => 5)); ?>
        <?php echo $form->error($model, 'text'); ?>
</div>

<?php echo CHtml::ajaxSubmitButton('Отправить отзыв',CHtml::normalizeUrl(array('productComment/create','render'=>true)),
array(
'type'=>'post',
'success'=>'function(data) {
    $("#comment-form").find("input[type=text], textarea").val("");
    $("#comment-form").toggle();
    $.fn.yiiListView.update(\'product-comment-list-view\');
}'
),array('class'=>'btn btn-default')); ?>

<?php $this->endWidget(); ?>


<div id="comments">
    <?php $this->widget('zii.widgets.CListView', array(
        'id'=>'product-comment-list-view',
        'dataProvider'=>$dataProvider,
        'itemView'=>'_productCommentWidget',
        'ajaxUpdate' => true,
        'enableHistory'=>true,
        'template' => '{items}{pager}',
        'itemsCssClass'=>'row products',
        'pager' => array(
            'firstPageLabel'=>'<<',
            'prevPageLabel'=>'Назад',
            'nextPageLabel'=>'Вперед',
            'lastPageLabel'=>'>>',
            'maxButtonCount'=>'30',
            'header'=>false,
            'cssFile'=>false,
        ),
    )); ?>
</div>
