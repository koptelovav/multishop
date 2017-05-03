$(function(){
    var $priceSlider =  $('#filter-price-slider').slider(),
        $fMinPrice = $('#filter-min-price'),
        $fMaxPrice = $('#filter-max-price');

    $priceSlider
        .on('slide', function(ev){
            $fMinPrice.val(ev.value[0]);
            $fMaxPrice.val(ev.value[1]);
        });

    $('#filter-min-price, #filter-max-price').keyup(function(){
        $priceSlider
            .slider('setValue', [
                $fMinPrice.val(),
                $fMaxPrice.val()
            ]);
    });

    $priceSlider
        .on('slideStop', function(){
        $('#filter').trigger('submit');
    });

    $('[id*="filter_age"], [id*="filter_brand"], [id*="filter_gender"]').change(function(){
        $('#filter').trigger('submit');
    });

    $('#filter').submit(function(e){
        updateListView('category-list-view', $(this).serialize());
        return false;
    });

    function updateListView(id, data) {
        var settings = $.fn.yiiListView.settings[id];
        if(settings.enableHistory && settings.ajaxUpdate !== false && window.History.enabled) {

            if (settings.pageVar !== undefined) {
                data += '&' + settings.pageVar + '=1';
            }
            var url = $.fn.yiiListView.getUrl(id);
            var params = $.deparam.querystring($.param.querystring(url, data));

            delete params[settings.ajaxVar];
            delete params['page'];

            window.History.pushState(null, document.title, decodeURIComponent($.param.querystring(url.substr(0, url.indexOf('?')), params)));
        } else {
            $.fn.yiiListView.update(id, {data: data});
        }
    }


    $('.footer-block h4').click(function(){
        var footerBlock = $(this).parent();
        if(footerBlock.find('ul').is(':hidden')){
            footerBlock.addClass('collapsed');
        }
        else{
            footerBlock.removeClass('collapsed');
        }
    });

    /*****************MENU********************/
    var toggler = '.navbar-toggle';
    var pagewrapper = '#page-content';
    var navigationwrapper = '.navbar-header';
    var menuwidth = '100%';
    var slidewidth = '40%';
    var menuneg = '-100%';
    var slideneg = '-40%';
    $("#general-nav").on("click", toggler, function (e) {
        $('body').toggleClass('overlay');
        var selected = $(this).hasClass('slide-active');
        $('#slidemenu').stop().animate({
            left: selected ? menuneg : '0px'
        });
        $('#navbar-height-col').stop().animate({
            left: selected ? slideneg : '0px'
        });
        $(pagewrapper).stop().animate({
            left: selected ? '0px' : slidewidth
        });
        $(navigationwrapper).stop().animate({
            left: selected ? '0px' : slidewidth
        });
        $(this).toggleClass('slide-active', !selected);
        $('#slidemenu').toggleClass('slide-active');
        $('#page-content, .navbar, body, .navbar-header').toggleClass('slide-active');
    });
    var selected = '#slidemenu, #page-content, body, .navbar, .navbar-header';
    $(window).on("resize", function () {
        if ($(window).width() > 767 && $('.navbar-toggle').is(':hidden')) {
            $(selected).removeClass('slide-active');
        }
    });
});