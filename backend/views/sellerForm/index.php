<style>
    table#sales {
        font-size: 12px;
    }
</style>

<?php
/* @var $this OrderStatusController */
/* @var $model OrderStatus */


$this->pageTitle = 'Бланк кассира от '.date('d.m.Y',strtotime($model->date)). ' | '.$model->user->name;

echo CHtml::script("

function setTotal(){
      var total = parseInt($('#product_price').attr('value')) * parseInt($('#product_count').attr('value'));
      var discount = parseInt($('#product_discount').attr('value'))
      if(discount)
        total = total - total*discount/100;
      $('#product_total').attr('value', total);
}
function addProduct(){

            var data = {
                'SellerFormSale[id]': $('#sale_id').attr('value'),
                'SellerFormSale[product_id]': $('#product_id').attr('value'),
                'SellerFormSale[product_title]': $('#product_title').attr('value'),
                'SellerFormSale[product_price]': $('#product_price').attr('value'),
                'SellerFormSale[product_count]': $('#product_count').attr('value'),
                'SellerFormSale[discount]': $('#product_discount').attr('value'),
                'SellerFormSale[gift_id]': $('#gift_id').attr('value'),
                'SellerFormSale[gift_title]': $('#gift_title').attr('value'),
                'SellerFormSale[payment_type]': $('#payment_type').attr('value'),
                'SellerFormSale[note]': $('#note').attr('value'),
            }
            $.ajax({
                type: 'POST',
                url: '".$this->createUrl('newSale')."',
                data: data,
                success: function(response){

                    if(response == 'ok'){
                        window.location.reload();
                    }else{
                        alert(response);
                    }
                }
            });


            /* $('#product_title').attr('value','');
             $('#product_price').attr('value','');
             $('#product_discount').attr('value','');
             $('#product_total').attr('value','');
             $('#gift_title').attr('value','');*/

             return false;
        }

     $(function(){

     $('#add-expense').click(function(){

     $.ajax({
                type: 'POST',
                url: '".$this->createUrl('newExpense')."',
                data: {
                    'SellerFormExpense[title]': $('#expense_title').attr('value'),
                    'SellerFormExpense[amount]': $('#expense_amount').attr('value')
                },
                success: function(response){

                    if(response == 'ok'){
                        window.location.reload();
                    }else{
                        alert(response);
                    }
                }
            });
     return false;
     });

     $('.edit-btn').click(function(){
     var record = $(this).parent().parent();
     console.log(record);
         $('#sale_id').attr('value',record.attr('id'));
         $('#product_title').attr('value',record.find('.product_title').text());
         $('#product_count').attr('value',record.find('.product_count').text());
         $('#product_price').attr('value',record.find('.product_price').text());
         $('#product_discount').attr('value',record.find('.product_discount').text());
         $('#gift_title').attr('value',record.find('.gift_title').text());
         setTotal();
        return false;
     });

     $('.delete-btn').click(function(){
      if(confirm('Удалить запись?')){
       var record = $(this).parent().parent();
      $.ajax({
                type: 'POST',
                url: '".$this->createUrl('deleteSale')."',
                data: {id: record.attr('id')},
                success: function(response){
                    if(response == 'ok'){
                        window.location.reload();
                    }else{
                        alert(response);
                    }
                }
            });
            return true;
           }
        return false;
     });

     $('#success-alert').fadeTo(2000, 500).slideUp(500, function(){
    $('#success-alert').alert('close');
});

     $('#product_count, #product_price, #product_discount').keyup(function(){setTotal()});

        $('#add-product').click(function(){
            addProduct();
            return false;
        });
     });
   ");

$total = 0;
?>
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div id="success-alert" class="alert alert-success alert-dismissible" role="alert"><?php echo Yii::app()->user->getFlash('success'); ?> </div>
<?php endif; ?>


<table class="table table-striped" id="sales">
    <thead>
    <tr>
        <th>Товар</th>
        <th>Цена</th>
        <th>Кол-во</th>
        <th>Скидка</th>
        <th>Итого</th>
        <?php if(Yii::app()->user->checkAccess('admin')):?>
            <td>&nbsp;</td>
        <?php endif ?>
        <th>Подарок</th>
        <th>Тип оплаты</th>
        <th>Примечание</th>
    </tr>
    </thead>
        <tr>
            <td>
                        <?php
                        $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                            'name' => 'product_title',
                            'source' => "js:function(request, response) {
      $.getJSON('" . $this->createUrl('suggest') . "', {
        term: request.term.split(/,\s*/).pop()
      }, response);
      }",
                            'options' => array(
                                'delay' => 300,
                                'minLength' => 2,
                                'showAnim' => 'fold',
                                'multiple' => true,
                                'select' => "js:function(event, ui) {
         this.value = ui.item.value ;
         $('#product_id').attr('value', ui.item.id);
         $('#product_price').attr('value', ui.item.price);
         $('#product_count').attr('value', 1);
         setTotal();

         return false;
       }",
                            ),
                            'htmlOptions' => array(
                                'placeholder' => 'Товар',
                                'size' => '30'
                            ),
                        ));
                        ?>

            </td>
            <td>
                <?php echo CHtml::hiddenField('sale_id', ''); ?>
                <?php echo CHtml::hiddenField('product_id', ''); ?>
                <?php echo CHtml::hiddenField('gift_id', ''); ?>
                <?php echo CHtml::textField('product_price', '', array('placeholder' => 'Цена', 'size'=>2)); ?>
            </td>
            <td>
                <?php echo CHtml::textField('product_count', '', array('placeholder' => 'Кол-во', 'size'=>2)); ?>
            </td>
            <td>
                <?php echo CHtml::textField('product_discount', 0, array('placeholder' => 'Скидка', 'size'=>2)); ?>
            </td>
            <td>
                <?php echo CHtml::textField('product_total', '', array('disabled'=>'disabled','placeholder' => 'Итого', 'size'=>2)); ?>
            </td>
            <?php if(Yii::app()->user->checkAccess('admin')):?>
            <td> &nbsp; </td>
            <?php endif ?>
            <td>
                <?php
                $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                    'name' => 'gift_title',
                    'source' => "js:function(request, response) {
      $.getJSON('" . $this->createUrl('suggest') . "', {
        term: request.term.split(/,\s*/).pop()
      }, response);
      }",
                    'options' => array(
                        'delay' => 300,
                        'minLength' => 2,
                        'showAnim' => 'fold',
                        'multiple' => false,
                        'select' => "js:function(event, ui) {
         this.value = ui.item.value ;
         $('#gift_id').attr('value' ,ui.item.id);



         return false;
       }",
                    ),
                    'htmlOptions' => array(
                        'placeholder' => 'Подарок',
                        'size' => '30'
                    ),
                ));
                ?>
            </td>
            <td>
                <?php echo CHtml::dropDownList('payment_type', '', SellerFormSale::$payment_type, array('placeholder' => '')); ?>
            </td>
            <td>
                <?php echo CHtml::textField('note', '', array('size'=>15)); ?>
            </td>
            <td>
                <?php echo CHtml::submitButton('V', array('class' => 'btn btn-success btn-xs сol-lg-offset-3', 'id' => 'add-product')); ?>
            </td>
        </tr>
    <tbody id="sales">
    <?php foreach($model->sales as $sale): ?>
        <tr id="<?= $sale->id ?>">
            <td class="product_title"><?= $sale->product_title ?></td>
            <td class="product_price"><?= $sale->product_price ?></td>
            <td class="product_count"><?= $sale->product_count ?></td>
            <td class="product_discount"><?= $sale->discount ?></td>
            <td class="total"><?= $sale->total ?></td>
        <?php if(Yii::app()->user->checkAccess('admin')):?>
            <td class="total" style="font-weight: bold"><?= $promo = $sale->payment_type == 1 ? $sale->product_price*0.69*$sale->product_count : ($sale->payment_type == 2 ? $sale->total : 0) ?></td>
            <?php $total+=$promo;?>
        <?php endif ?>
            <td class="gift_title"><?= $sale->gift_title ?></td>
            <td class="payment_type"><?= SellerFormSale::$payment_type[$sale->payment_type] ?></td>
            <td class="gift_title"><?= $sale->note ?></td>
<!--            <td>-->
<!--                <a href="#" class="edit-btn glyphicon glyphicon-pencil"></a>-->
<!--                <a href="#" class="delete-btn glyphicon glyphicon-remove"></a>-->
<!--            </td>-->
        </tr>
    <?php endforeach ?>
    </tbody>
</table>

<div class="row">
    <div class="col-lg-6">
        <h4>Расходы</h4>
        <table class="table table-striped">
            <tr>
                <th>Описание</th>
                <th>Сумма</th>
                <th></th>
            </tr>
            <tr>
                <td>
                    <?php echo CHtml::textField('expense_title', '', array('size'=>40)); ?>
                </td>
                <td>
                    <?php echo CHtml::textField('expense_amount', '', array('size'=>2)); ?>
                </td>
                <td>
                    <?php echo CHtml::submitButton('V', array('class' => 'btn btn-success btn-xs сol-lg-offset-3', 'id' => 'add-expense')); ?>
                </td>
            </tr>
            <?php foreach($model->expenses as $expense): ?>
                <tr>
                    <td class="expense_title"><?= $expense->title ?></td>
                    <td class="expense_amount"><?= $expense->amount ?></td>
                    <td></td>
                </tr>
            <?php endforeach ?>
        </table>
    </div>
    <div class="col-lg-6">
        <h4>Итоги</h4>
        <div class="row">
            <div class="col-lg-6">
                <div>
                    <b>На начало смены: </b> <?= SHtml::toPrice($model->start_sum) ?>
                </div>
                <div>
                    <b>На текущий момент: </b> <?= SHtml::toPrice($model->cash) ?>
                </div>
            </div>
            <div class="col-lg-6">
                <div>
                    <b>Продано на сумму: </b> <?= $total ?>
                </div>
            </div>
        </div>
    </div>
</div>


