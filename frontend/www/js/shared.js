var cart = {
    cartPageId: 'cart-form',
    isCartPage: false,
    selector : '[data-object="cart"]',
    modificator: '[data-modificator]',
    preloader: 'preloader',
    jQPageSelector : null,
    jQSelector : null,
    productCount: null,
    canOrder: false,
    init: function(){
        var self = this;

        this.jQPageSelector = $('#'+this.cartPageId);
        if(this.jQPageSelector.length > 0)
            this.isCartPage = true;

        this.jQSelector = $(this.selector);

        //init events
        $(document).on('click', this.modificator, function(){
            self.modify($(this));
            return false;
        });

        this.ajaxUpdate()
    },

    setPreloder: function($item){
        $item.addClass(this.preloader);
    },

    setBigPreloder: function(){
        $('body').css('overflow','hidden');
        $('#big-preloader').show();
    },

    removeBigPreloder: function(){
        $('body').css('overflow','visible');
        $('#big-preloader').hide();
    },

    removePreloder: function($item){
        $item.removeClass(this.preloader);
    },

    on_buy_product: function(){
        this.ajaxUpdate();
        flash('Товар добавлен в корзину!');
    },

    on_recalculation: function(html){
        this.ajaxUpdate();
        this.updateOfHTML(html);
    },
    modify: function($modificator){
        var self = this;
        var data = {
            id: $modificator.data('id'),
            attributes: []
        }
        ;
        if($modificator.data('preloader') == 'enable')
            self.setPreloder($modificator);


        $('#attribute-container_'+$modificator.data('id')).find('.product_attribute').each(function(){
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
            type: 'POST',
            url: $modificator.data('href') ? $modificator.data('href') : $modificator.attr('href'),
            data: data,
            success: function (html) {
                self['on_'+$modificator.data('event')](html);

                if($modificator.data('preloader') == 'enable')
                    self.removePreloder($modificator);
            }
        });
    },
    setProductCount: function(count){
        this.productCount = count;
        this.jQSelector.html(count);

    },
    updateOfHTML: function(html){
        $('#cart-form').html($(html).find('#cart-form').html());
    },

    getProductCount: function(){
        var self = this;
        self.setPreloder(this.jQSelector);

        $.ajax({
            type: 'POST',
            url: productCountUrl,
            success: function (count) {
                self.setProductCount(count);
                self.removePreloder(self.jQSelector);
            }
        });
    },
    ajaxUpdate: function(scroll){
        var self = this;
        cart.canOrder = false;

        if(this.isCartPage){
            self.setBigPreloder();
            var clientFormData = this.jQPageSelector.find('form').serialize();
            $.ajax({
                type: 'POST',
                url: SendOrderDataUrl,
                data: clientFormData,
                success: function (JSONString) {
                    try{
                        $('#cart-form').html($(JSONString).find('#cart-form').html());
                       /* if(scroll){
                            $('html, body').animate({
                                scrollTop: $("#orders-form").find("h4:visible:last").offset().top
                            }, 300);
                        }*/
                    }catch (e){
                        var data = $.parseJSON(JSONString);
                        if(data['errors'])
                            addErrors(data['errors']);
                    }

                    self.removeBigPreloder();
//                    yaCounter22206275.hit(document.URL);
                },
                fail: function(){
                    self.removeBigPreloder();
                }
            });
        }

        self.getProductCount();
    }
};

$(document).on('change','input[name="CartForm[shippingType]"], input[name="CartForm[shipping]"], input[name="CartForm[payment]"]',function(){
    cart.ajaxUpdate(true);
});
$(document).on('click','.cart-sub',function(){
    $(this).next().val(~~$(this).next().val()-1);
    cart.ajaxUpdate();
    return false;
});
$(document).on('click','.cart-add',function(){
    $(this).prev().val(~~$(this).prev().val()+1);
    cart.ajaxUpdate();
    return false;
});
$(document).on('blur','.product-count',function(){
    cart.ajaxUpdate();
    return false;
});

$(document).on('click','#check_promo',function(){
    cart.ajaxUpdate();
    return false;
});

$(document).on('click','#shipping-calculate-form',function(){
    var form = $(this);
    $.ajax({
        type: 'POST',
        url: '/site/calculateShipping',
        data: {zip: $('#zip').val()},
        success: function(data){
            $('#shipping_calculate_result').html(data);
        }
    });
    return false;
});
$(document).on('click','#shipping_calculate',function(){
    var index = $('#CartForm_zip').val();
    if (parseInt(index) == index && index.length == 6) {
        cart.ajaxUpdate(true);
    } else flash("Введите корректный индекс");
    return false;
});

$(document).on('submit','#orders-form',function(){
    if(cart.canOrder){
        return true;
    }else{
        var alertBox =  $('#alert-cart');
        cart.setBigPreloder();
        alertBox.html('');
        alertBox.hide();

        $form = $(this);
        $.ajax({
            type: 'POST',
            url: ValidateOrderDataUrl,
            data: $form.serialize(),
            success: function (JSONString) {
                var data = $.parseJSON(JSONString);
                if(data['success']){
                    window.location.href = $form.attr('action');
                }else{
                    addErrors(data['errors']);
                    cart.removeBigPreloder();
                }
            },
            fail: function(){
                cart.removeBigPreloder();
            }
        });
        return false;
    }

});

function addErrors(errors){
    var alertBox =  $('#alert-cart');

    for(var error in errors){
        if($('#CartForm_'+error).is(':visible')){
            alertBox.append('<div>'+errors[error]+'</div>');
        }
    }

    alertBox.show();
    $('html, body').animate({
        scrollTop: (alertBox.offset().top - 60 )
    }, 300);
}

function flash(text){
    var flash =  $('#flash');
    flash.find('.inner').text(text);
    flash.show();

    if(flash.data('fade-out'))
        setTimeout(function () {
            flash.fadeOut();
        }, flash.data('fade-out'));
}

$(document).on('click', '.flash--close',function(){
    $('#flash').fadeOut();
    return false;
});

$(document).on('click', '.callback-button',function(){
    var nzData = $(this).attr('href');
    $.fancybox({
        href : nzData,
        type : 'ajax',
        width: 530,
        height: 200,
        autoSize: false
    });
    return false;
});

$(document).on('change', '[name="CartForm[pvz]"]',function(){
        cart.ajaxUpdate(true);
});



$(function(){
   /* $('.product_attribute').on('change',function(){
        var $item,
            markUp,
            price = $('.update-price[data-id="'+$(this).data('product-id')+'"]'),
            newPrice = price.data('value');

        $('#attribute-container_'+$(this).data('product-id')).find('.product_attribute').each(function(){

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

        price.html(newPrice);
    });*/

    $('a[rel=\"gallery\"]').fancybox({
        openEffect	: 'none',
        closeEffect	: 'none',
    });

    $('.funcybox-video').fancybox({
        openEffect	: 'none',
        closeEffect	: 'none',
        type: 'iframe',
    });
    cart.init();

    $('.shipping-city-list a').click(function(){
        var $a =  $(this),
            $ul = $a.parent();

        $ul.find('ul').toggle();
        $ul.find('.cdek-shipping').toggle();
        if($ul.find('.cdek-shipping').length == 0)
        $.ajax({
            type: 'POST',
            url: '/shipping/calculateCdek',
            data: {city: $a.text()},
            success: function(data){
                $ul.append(data)
            }
        });
        return false;
    });

    $("#readMoreReadLess").readMoreReadLess({
        itemInSummary: 1
    });
});