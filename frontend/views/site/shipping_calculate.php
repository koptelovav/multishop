<?php Yii::app()->clientScript->registerScriptFile(Yii::app()->request->baseUrl . '/js/edost_shipping.js'); ?>

<h2>Расчет доставки</h2>
<?php echo CHtml::beginForm('#','POST',array(
    'id' => 'calculate_form',
    'class'=>'form-horizontal'
)) ?>
<div class="form-group">
    <div class="col-lg-12">
        <?php echo CHtml::dropDownList('Orders_shipping_id', 0, CHtml::listData(Shipping::model()->findAll(), 'id', 'name'), array('class' => 'form-control', 'empty' => 'Выберите способ доставки')); ?>
    </div>
</div>
<div id="address-row" class="form-group" style="display: none">
    <div class="col-lg-offset-3 col-lg-9">
        Почтовые индексы России - <a href=" http://ruspostindex.ru/" target="_blank">http://ruspostindex.ru/</a>
    </div>

    <?php echo CHtml::label('Индекс', 'index', array('class' => 'col-lg-3 control-label')); ?>
    <div class="col-lg-9">
        <?php echo CHtml::textField('index', '', array('placeholder'=>'Введите ваш почтовый индекс','class' => 'form-control')); ?>
    </div>
    <div id="calculateAddress" class="col-lg-offset-3"></div>
    <?php echo CHtml::hiddenField('calculate_address', '', array('class' => 'form-control')); ?>
    <?php echo CHtml::hiddenField('city', '', array('class' => 'form-control')); ?>
    <?php echo CHtml::hiddenField('region', '', array('class' => 'form-control')); ?>
</div>

<?php echo CHtml::submitButton('Рассчитать', array('id'=>'calculateShipping'))?>

<?php echo CHtml::endForm() ?>