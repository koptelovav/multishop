<?php
$this->pageTitle = 'Купоны';

Yii::app()->clientScript->registerScript("activate", "
    $('#submit').click(function(){
        $.ajax({
            type: 'POST',
            url: $(this).attr('href'),
            data: {coupon: $('#coupon').val()},
            success: function(data){
                $('#result').attr('class','');

                if(data == 1){
                    $('#result').addClass('green').text('Купон успешно активирован');
                }else{
                    $('#result').addClass('red').text('Купон не верен');
                }
            }
        });
        return false;
    });
", CClientScript::POS_READY);
?>
<h1>Купоны</h1>
<p class="description" style="text-align:justify">
    Если у вас имеется купон, вы можете активировать его здесь!<br/>
    Ведите купон в поле ниже. <span class="red">Внимание, регистр учитывается!</span><br/>
    <?= CHtml::textField('coupon');?> <?= CHtml::link('Активировать', Yii::app()->createUrl('coupon/activate'),array('id'=>'submit'));?> <span id="result"><span><br/>
    Товары на которые действует скидка будут отмечены крассными ценниками!
</p>