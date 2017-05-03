$(function () {
    var PICKUP_SHIPPING = 1;
    var EMS_POST_SHIPPING = 2;
    var POST_SHIPPING = 3;
    var SPB_SHIPPING = 4;


    var showAdrressToCalc = {
        1: false,
        2: true,
        3: true,
        4: false
    };
    var showAddress = {
        1: false,
        2: true,
        3: true,
        4: true
    };

    function getEmsRegions(callback){
        if($('#area-select option').length < 2){
            $.ajax({
                type: 'POST',
                url: EMSRestURL,
                data: {
                    method: 'ems.get.locations',
                    type: 'russia',
                    plain: 'true'
                },
                success: function (data) {
                    data = $.parseJSON(data);
                    $.each(data.rsp.locations, function (key, value) {

                        if (value.type == 'cities')
                            $('#area-select').append('<option data-type="' + value.type + '" value="' + value.value + '">' + value.name.charAt(0).toUpperCase() + value.name.substr(1).toLowerCase() + '</option>')
                        else
                            $('#area-select').append('<option data-type="' + value.type + '" value="' + value.value + '">' + value.name.charAt(0).toUpperCase() + value.name.substr(1).toLowerCase() + '</option>')
                    });

                    if(callback){
                        callback();
                    }
                }
            });
        }
    }

    $(document).on('change','#area-select',function(){
        var option = $('#area-select option[value="' + $(this).val() + '"]');
        if (option.val() !== '') {
            $('#Customers_area').attr('value', option.text());
            calculateShipping($('#Orders_shipping_id').val());
        }
        if (option.data('type') == 'regions')
            $('#city').show();
        else
            $('#city').hide();
    });


    $(document).on('change','#Orders_shipping_id',function(){
        calculateShipping($('#Orders_shipping_id').val());
    }).trigger('change');

    function calculateShipping(shippingId){
        var select = $('#Orders_payment_id');
        var value = shippingId;
        var option = $('#area-select option:selected');
        $.ajax({
            type: 'POST',
            url: paymentUrl,
            data: {
                id: shippingId,
                to: option.val(),
                name: option.text()
            },
            success: function (data) {
                data = $.parseJSON(data);
                if (data.payment) {
                    select.find('option').remove();
                    select.append($('<option></option>'));

                    $.each(data.payment, function (val, text) {
                        select.append(
                            $('<option></option>').val(val).html(text)
                        );
                    });

                    $('#payment-row').show();

                    if (showAdrressToCalc[value])
                        getEmsRegions(function(){
                            $('#address-row').show();
                        });
                    else{
                        $('#address-row').hide();
                    }
                } else {
                    $('#payment-row').hide();
                }

                if (data.shipping) {
                    $('#shipping .price').text(data.shipping.price);
                    $('#shipping .title').text(data.shipping.name);
                    $('#shipping').show();
                } else {
                    $('#shipping').hide();
                }

                if (data.total) {
                    $('#total .price').text(data.total);
                }
            }
        });
    }
});