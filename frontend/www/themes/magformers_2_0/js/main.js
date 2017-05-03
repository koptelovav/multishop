$(function(){
    var Filter = function () {
        return {
            slider: false,
            products: false,
            activeFilters: {},
            filterMinPrice: 0,
            filterMaxPrice: 0,
            catalog: {},
            showedCatalog: {},

            sliderSelector: '#filter-price-slider',
            productSelector: '.product-wrap',
            categorySelector: '.category',
            filterSelector: 'input[id*="filter_"]',
            filterMinPriceSelector: '#filter-min-price',
            filterMaxPriceSelector: '#filter-max-price',


            init: function () {
                if($('#filter').length == 0)
                    return;

                Filter.initSlider();
                Filter.initCatalog();
                $(Filter.filterSelector).on('change', function(){
                    Filter.changeFilter($(this));
                    Filter.updateCatalog();
                    Filter.showFilterMessage($(this));
                });

                Filter.setPriceFilterValue();
                Filter.setStoredData();
            },

            initSlider: function () {
                var $fMinPrice = $(Filter.filterMinPriceSelector),
                    $fMaxPrice = $(Filter.filterMaxPriceSelector);

                Filter.slider =  $(Filter.sliderSelector).slider();
                Filter.slider
                    .on('slide', function(ev){
                        $fMinPrice.val(ev.value[0]);
                        $fMaxPrice.val(ev.value[1]);
                    });

                $(Filter.filterMinPriceSelector+','+Filter.filterMaxPriceSelector).keyup(function(){
                    Filter.slider
                        .slider('setValue', [
                            $fMinPrice.val(),
                            $fMaxPrice.val()
                        ]);
                });

                Filter.slider
                    .on('slideStop', function(){
                        Filter.changePriceFilter($(Filter.filterMaxPriceSelector));
                    });
            },

            initCatalog: function () {
                $(Filter.productSelector).each(function (i, item) {
                    var $product = $(item);
                    Filter.catalog[$product.data('id')] = {
                        filter: $product.data('filter').split(','),
                        price: $product.data('price'),
                        show: 1
                    }
                });
            },

            setStoredData: function () {
                var update = false;
                if(localStorage.getItem('activeFilters')) {
                    Filter.activeFilters = JSON.parse(localStorage.getItem('activeFilters'));

                    $.each(Filter.activeFilters, function (i, data) {
                        $.each(data, function (i, value) {
                            $('[id^="filter_"][value="'+value+'"]').attr('checked','checked');
                        });
                    });

                    update = true;
                }

                if(localStorage.getItem('filterPrice')) {

                    var price = JSON.parse(localStorage.getItem('filterPrice'));

                    Filter.filterMinPrice = price.min;
                    Filter.filterMaxPrice = price.max;

                    $(Filter.filterMinPriceSelector).attr('value',Filter.filterMinPrice);
                    $(Filter.filterMaxPriceSelector).attr('value',Filter.filterMaxPrice);

                    Filter.slider
                        .slider('setValue', [
                            price.min,
                            price.max
                        ]);

                    update = true;
                }

                if(update)
                    Filter.updateCatalog();
            },

            changeFilter: function ($filter) {
                if($filter.is(':checked')){
                    if(Filter.activeFilters[$filter.data('name')] == undefined)
                        Filter.activeFilters[$filter.data('name')] = [];
                    Filter.activeFilters[$filter.data('name')].push($filter.attr('value'));
                }
                else{
                    Filter.activeFilters[$filter.data('name')].splice(Filter.activeFilters[$filter.data('name')].indexOf($filter.attr('value')), 1);
                    if(Filter.activeFilters[$filter.data('name')].length == 0)
                        delete Filter.activeFilters[$filter.data('name')];
                }

                localStorage.setItem('activeFilters', JSON.stringify(Filter.activeFilters));
            },

            updateCatalog: function () {
                var complies = false;
                Filter.showedCatalog = $.extend(true, {}, Filter.catalog);

                $.each(Filter.showedCatalog, function (id, product) {
                    if(product.price < Filter.filterMinPrice || product.price > Filter.filterMaxPrice){
                        Filter.showedCatalog[id]['show'] = 0;
                        return true;
                    }
                    if (!$.isEmptyObject(Filter.activeFilters)){
                        $.each(Filter.activeFilters, function (filterName, filterData) {
                            $.each(filterData, function (i, value) {
                                complies = !(product.filter.indexOf(value) == -1);
                                if (complies)
                                    return false;
                            });
                            if (!complies) {
                                Filter.showedCatalog[id]['show'] = 0;
                                return false;
                            } else {
                                Filter.showedCatalog[id]['show'] = 1;
                            }
                        });
                    }
                });

                $.each(Filter.showedCatalog, function (id){
                    if(Filter.showedCatalog[id]['show'] || Filter.showedCatalog[id]['show'] == undefined)
                        $(Filter.productSelector+'[data-id="'+id+'"]').removeClass('hidden');
                    else
                        $(Filter.productSelector+'[data-id="'+id+'"]').addClass('hidden');
                });

                $('.category').show();
                $('.category .items:not(:has(*:visible))').parent().parent().hide();
            },

            setPriceFilterValue: function () {
                Filter.filterMinPrice = $(Filter.filterMinPriceSelector).val();
                Filter.filterMaxPrice = $(Filter.filterMaxPriceSelector).val();
            },

            changePriceFilter: function (element) {
                Filter.setPriceFilterValue();
                Filter.updateCatalog();
                Filter.showFilterMessage(element);
                localStorage.setItem('filterPrice', JSON.stringify({min: Filter.filterMinPrice, max:  Filter.filterMaxPrice}));
            },

            showFilterMessage: function (element) {
                $('#filter-message span').text($(Filter.productSelector+':visible').length);
                var offset = element.position();
                $('#filter-message').fadeIn(500).css({
                    top: offset.top + 'px',
                    left: offset.left+150 + 'px'
                }).delay(2000).fadeOut(500);
            }
        };
    }();

    Filter.init();

    $('#filter-button').click(function () {
        $('#filter').slideDown(300);
        $(this).remove();
        $('html, body').animate({scrollTop: 0},200);
        return false;
    });

    $('.footer-block h4').click(function(){
        var footerBlock = $(this).parent();
        if(footerBlock.find('ul').is(':hidden')){
            footerBlock.addClass('collapsed');
        }
        else{
            footerBlock.removeClass('collapsed');
        }
    });

    var $gallery = $('a[rel="gallery"]');
    var current_index = 0;
    var max_index = $('a[rel="gallery"]').length - 1;
    var $image = $(".swipe-block img.view");
    $image.attr('src',$($gallery[current_index]).data('mobile'));

    $(".swipe-block")
        .on("swipeleft", function(){
            if(current_index < max_index)
                current_index++;
            else
                current_index = 0;

            $image.attr('src',$($gallery[current_index]).data('mobile'));
            $('.swipe-image').hide();
    })
        .on("swiperight", function(){
            if(current_index > 0)
                current_index--;
            else
                current_index = max_index;

            $image.attr('src',$($gallery[current_index]).data('mobile'));
            $('.swipe-image').hide();
    });

    /*****************MENU********************/
    var toggler = '.navbar-toggle';
    var pagewrapper = '#page-content';
    var navigationwrapper = '.navbar-header';
    var menuwidth = '100%';
    var slidewidth = '70%';
    var menuneg = '-100%';
    var slideneg = '-70%';
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