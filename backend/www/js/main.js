$.fn.charCounter = function(){
    var plugin = this;

    return this.each(function() {
        var input = $(this);
        var id = input.attr('id');
        var limit = input.data('limit') ? input.data('limit') : 160;
        input.parent().append('<div id="'+id+'_count"></div>');
        var count = $('#'+id+'_count');



        input.keyup(function() {
            var n = this.value.replace(/{.*?}/g, '').length;
            count.text( n + ' символ(ов) из ' + limit);
        }).triggerHandler('keyup');
    });
};

$(document).on('tap dblclick','#set-order-tag [class^="icon-"], #set-order-tag [class*=" icon-"]',function(){
    var $icon = $(this);
    $.ajax({
        type: 'POST',
        url: $icon.data('href'),
        success: function(data){
            if(data == 'add')
                $icon.addClass('active');
            else if(data == 'delete')
                $icon.removeClass('active');

            $icon.removeClass('wait');
        }
    });
});

$(document).on('click','.close',function(event){
    if(confirm('Вы действительно хотите удалить запись?')){
        var record = $(this);
        $.ajax({
            type: 'POST',
            url: record.data('href'),
            success: function(data){
                if(data == 'ok' && record.data('update'))
                    $.fn.yiiListView.update(record.data('update'));
            }
        });
        return true;
    }
    e.stopPropagation();
});

$(document).on('click','#add-card-product',function(){
    var link = $(this);
    var product = $('#product_id');

    $.ajax({
        url: link.attr('href'),
        data: {
            cid: product.data('card-id'),
            pid: product.val(),
            count: $('#product_count').val(),
            discount: $('#product_discount').val()
        },
        success: function(){
            $.fn.yiiGridView.update("card-product-grid");
        }
    });
    return false;
});


$(document).on('click','#add-order-product',function(){
    var link = $(this);

    var data= {
        order_id: $('#order_id').val(),
        product_id: $('#product_id').val(),
        product_price:  $('#product_price').val(),
        count: $('#product_count').val(),
        attributes: []
    };

    $('#attribute-container').find('.product_attribute').each(function(){
        var $item = $(this);
        switch ($item[0].tagName){
            case 'INPUT':
                if($item.prop('checked'))
                    data['attributes'].push($item.val());
                break;
            case 'SELECT':
                var option = $item.find('option:selected');
                if(option.length > 0 && option.val() !== '')
                    data['attributes'].push(option.val());
                break;
        }
    });

    $.ajax({
        url: link.attr('href'),
        data: data,
        success: function(){
            // $.fn.yiiGridView.update("card-product-grid");
            $.fn.yiiGridView.update('order-product-grid');
            $('#product_id').val("");
            $('#product_price').val("");
            $('#product_count').val("");
            $('#product_title').val("");
            $('#item-attributes').html("");

        }
    });
    return false;
});

$(document).on('click','#add-include-product',function(){
    var link = $(this);

    var data= {
        product_id: $('#product_id').val(),
        include_id: $('#include_id').val(),
        count: $('#product_count').val()
    };

    $.ajax({
        url: link.attr('href'),
        data: data,
        success: function(){
            $.fn.yiiGridView.update('product-include-grid');
            $('#include_id').val("");
            $('#product_count').val("");
            $('#product_title').val("");
        }
    });
    return false;
});

$(document).on('change','.order_product_id',function(){
    $data = $(this);
    $.ajax({
        url: '/orders/changeProduct',
        data: {
            product_id: $data.data('id'),
            count: $data.val()
        },
        success: function(){
            $.fn.yiiGridView.update('order-product-grid');
        }
    });
});

$(document).on('click','#greg',function(){
    var orderIds = [];
    $('td.checkbox-column').each(function(){
        var checkBox = $(this).find('input');
        if(checkBox.is(':checked'))
            orderIds.push(checkBox.attr('value'));
    });

    if(orderIds.length > 0) {
        var recursiveDecoded = decodeURIComponent($.param({
            ids: orderIds
        }));
        location.href = $(this).attr('href') + '?' + recursiveDecoded;
    }
    return false;
});



$(document).on('click','#add-product-include',function(){
    var link = $(this);
    var product = $('#product_id');

    $.ajax({
        url: link.attr('href'),
        data: {
            product_id: product.data('product-id'),
            include_id: product.val(),
            count: $('#product_count').val()
        },
        success: function(){
            $.fn.yiiGridView.update("product-include-grid");
        }
    });
    return false;
});

$(document).on('click','#add-product-related',function(){
    var link = $(this);
    var product = $('#product_related_id');

    $.ajax({
        url: link.attr('href'),
        data: {
            product_id: product.data('product-id'),
            related_id: product.val()
        },
        success: function(){
            $.fn.yiiGridView.update("product-related-grid");
        }
    });
    return false;
});


$(document).on('click','#add-product-composition',function(){
    var link = $(this);
    var product = $('#include_id');
    var label = $('#product_composition_label');
    var productId = $('#product_id');

    $.ajax({
        url: link.attr('href'),
        data: {
            product_id: productId.val(),
            include_id: product.val(),
            include_label: label.val()
        },
        success: function(){
            $.fn.yiiGridView.update("product-composition-grid");
            $('#product_title').val("");
            $('#include_id').val("");
            $('#product_composition_label').val("");
        }
    });
    return false;
});

$(document).on('submit','.product-include-form',function(){
   var form = $(this);
    $.ajax({
        type: 'POST',
        url: form.attr('action'),
        data: form.serialize(),
        success: function(){
            $.fn.yiiGridView.update("product-include-grid");
        }
    });
    return false;
});


$(document).on('change','.select-on-check',function(){
    var $checkBox = $(this);


    $.ajax({
        url: '/checker/setData',
        data: {
            name: $checkBox.attr('name'),
            val: $checkBox.val(),
            checked: $checkBox.attr('checked') ? 1 : 0
        },
        success: function(){

        }
    });
    return false;
});

$(document).on('change','.product_attribute',function(){
    var $item,
        markUp,
        price = $('#product_price'),
        newPrice = price.data('init');

    $('#attribute-container').find('.product_attribute').each(function(){
        $item = $(this);
        markUp = 0;

        switch ($item[0].tagName){
            case 'INPUT':
                if($item.prop('checked'))
                    markUp = $item.data('mark-up');
                break;
            case 'SELECT':
                markUp = $item.find('option:selected').data('mark-up');
                break;
        }
        newPrice += markUp;
    });

    price.val(newPrice);
});

$(document).on('keyup','.change_include_product_count',function(){
    var input = $(this);
    var data= {
        product_id: input.data('product-id'),
        include_id: input.data('include-id'),
        count: input.val()
    };

    $.ajax({
        type: 'POST',
        url: input.data('url'),
        data: data,
        success: function(){
            $.fn.yiiGridView.update('product-include-grid');
        }
    });
});

var changeSubmitForm = false;
$(document).on('change','.form-panel-submit',function() {
    changeSubmitForm = true;
    console.log('changeSubmitForm');
});

$(document).on('click','.nav-save',function(e){
    var $link = $(e.target);

    if(changeSubmitForm){
        var $form = $('.form-panel-submit');
        var data = $form.serialize();

        $.ajax({
            type: 'POST',
            url: $form.attr('action'),
            data: data,
            success: function(data){
                window.location.href = $link.attr('href');
            }
        });
    }else{
        window.location.href = $link.attr('href');
    }


    return false;
});

$(document).on('click','.get-composition',function(){
    var $item = $(this),
        $tr = $('.composition_product_'+$item.data('product-id'));

    $item.text() == '+' ? $item.text('-') : $item.text('+');

    if($tr.length > 0){
        $tr.toggle();
    }else{
        $.ajax({
            type: 'POST',
            url: '/products/getComposition?id='+$item.data('product-id'),
            success: function(data){
                $(data).find('tbody tr').insertAfter($item.parent().parent());
            }
        })
    }

});

$(function(){
    var buffer = '',
        timeoutId = '',
        activateBuffer = false;

    $(document).keydown(function(e){
        if (e.altKey && e.keyCode == 90){
            activateBuffer = true;
        }
    });



    $(document).keypress(function(e){
        if(activateBuffer) {
            if (e.keyCode > 47 && e.keyCode < 59) {
                buffer = +buffer + '' + (e.keyCode - 48);
                clearTimeout(timeoutId);
                timeoutId = setTimeout(function () {
                    window.open('http://admin.blackbamboo.ru/orders/view?id=' + buffer, '_blank');
                    buffer = '';
                    activateBuffer = false;
                }, 1500);
            }
        }
    });

    $('.char-count').charCounter();
    $('.table-clicked tr').dblclick(function(){
        if($(this).data('edit-url').length > 0){
            window.location.href = $(this).data('edit-url');
        }
    });

   $('.btn-delete').click(function(){
       if(confirm('Вы действительно хотите удалить выбранные элементы?')){
           var data = [];
           $('.select-on-check:checked').each(function(i, item){
               data.push($(item).attr('value'));
           });
       }

        return false;
    });

    $('#panel-save').click(function(){
        $('.form-panel-submit').submit();
    });

    var changeSubmitForm = false;
    $('.form-panel-submit').keypress(function(){
        changeSubmitForm = true;
    });

    $('#shop_selector').change(function(){
        $.ajax({
           type: 'POST',
           url: 'shop/setCurrentShop',
           data: {
               'current_shop': $(this).val()
           },
           success: function(){
               window.location.reload();
           }
        });
    });

    $('.order-meta').click(function(){
        var meta = $(this);
        $.ajax({
            type: 'POST',
            url: '/orderMeta/'+meta.data('action'),
            data: {
                'order_id': meta.data('order'),
                'name': meta.data('name'),
                'value': meta.data('value')
            },
            success: function(){
                if(meta.data('action') == 'add'){
                    meta.data('action','remove');
                    meta.attr('data-action','remove');
                }
                else if(meta.data('action') == 'remove'){
                    meta.data('action','add');
                    meta.attr('data-action','add');
                }
            }
        });
    });

    $('.send-track').click(function(){
        var meta = $(this);

        if(confirm('Отправить трэк покупателю?'))
            $.ajax({
                type: 'POST',
                url: '/orders/sendTrack/',
                data: {
                    'id': meta.data('order'),
                },
                success: function(){
                    meta.remove();
                }
            });
    });

    $('.send-status').click(function(){
        var meta = $(this);

        if(confirm('Отправить смс покупателю?'))
            $.ajax({
                type: 'POST',
                url: '/orders/sendStatus/',
                data: {
                    'id': meta.data('order'),
                },
                success: function(){
                    meta.remove();
                }
            });
    });

    $('.add-template-button').click(function(){
        var templateName = $(this).data('template'),
            $template = $('#'+templateName),
            $templateContainer = $('#'+templateName+'_container'),
            $html = $template.html();
        $html = $html.replace(/#index#/g,$template.data('current-index'));
        $template.data('current-index', parseInt($template.data('current-index')) +1);
        $templateContainer.append($html);
        return false;
    });
});

$(document).on('click','.price-list-checkbox',function(event){
    var $checkbox = $(this);
    var isChecked= $checkbox.attr('checked') ? 1 : 0;
    var $countInput = $checkbox.parent().parent().find('input[type="text"]');
    $.ajax({
        type: 'POST',
        url: '/products/setPriceListProduct',
        data: {
            id: $checkbox.val(),
            selected: isChecked
        }
    });

    $countInput.attr('disabled',!isChecked);
    if(isChecked){
        $countInput.attr('value',3);
    }else{
        $countInput.attr('value','');
    }
});

$(document).on('keyup','.price-list-count',function(event){
    var $input = $(this);
    $.ajax({
        type: 'POST',
        url: '/products/setPriceListCountProduct',
        data: {
            id: $input.data('id'),
            count: $input.val()
        }
    });
});

$(document).on('click','#product-grid td',function(event){
    event.stopPropagation();
});

/*$(document).on('dblclick','#images-browser img',function(event){
    var num =$(this).data('num');
    $('#images-browser').find('[data-num="'+num+'"]').remove();
});*/

$(document).on('click','.ask',function(event){
    if(confirm('Вы действительно хотите выполнить действие?')){
       return true;
    }

    return false;
});

$(document).on('click','.add-order-products',function(event){
    $('#myModal').modal();
    return false;
});

$(document).on('click','#file-form .product-image',function(){
    var img = $(this);
    var current_info = $('.hidden-info[data-num="'+img.data('num')+'"]');
    $('.hidden-info[data-num!="'+img.data('num')+'"]').hide();
    $('.product-image[data-num!="'+img.data('num')+'"]').css({'border-color':'#fff'});
    if(current_info.is(':visible')){
        current_info.hide();
        img.css({'border-color':'#fff'});
    }else{
        current_info.show();
        img.css({'border-color':'#000'});
    }
});

$(document).on('click','#file-form .delete-product-image',function(){
    $(this).parent().parent().parent().parent().remove();
    return false;
});
