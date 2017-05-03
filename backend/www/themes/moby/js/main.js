var tmp;

function openMenu(item){
    item.find('.order-menu').toggle();
    $('#overlay').toggle();
    $('body').toggleClass('overlay');

}

$(document).on('click','#orders-grid tbody tr',function(event){
    openMenu($(this))
});

$(document).on('click','#overlay',function(event){
    $('.order-menu').hide();
    $('#overlay').hide();
    $('body').toggleClass('overlay');
});

$(document).on('click','#set-order-tag [class^="icon-"], #set-order-tag [class*=" icon-"]',function(){
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
