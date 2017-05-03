$(function(){
    var Filter = function () {
        return {
            priceFilter: {},
            products: false,
            activeFilters: {},
            filterMinPrice: 0,
            filterMaxPrice: 0,
            catalog: {},
            filters: {},
            filterLabels: {},
            showedCatalog: {},
            urlData: {},

            filterClearBtn: '.filter-list--item--title-clear',
            filterLabelTextAreaSelector: '.filter-list--item--title-inside',
            filterItemSelector: '.filter-item',
            sliderSelector: '#filter-price-slider',
            productSelector: '.product--wrap',
            filterSelector: 'input[id*="filter_"]',
            filterMinPriceSelector: '#filter-min-price',
            filterMaxPriceSelector: '#filter-max-price',

            onChangeCallback: undefined,
            onChange: function (func) {
                Filter.onChangeCallback = func;
            },
            change: function () {
                if(Filter.onChangeCallback)
                    Filter.onChangeCallback.call();
            },

            onUpdateCatalogCallback: undefined,
            onUpdateCatalog: function (func) {
                Filter.onUpdateCatalogCallback = func;
            },
            updateCatalog: function () {
                if(Filter.onUpdateCatalogCallback)
                    Filter.onUpdateCatalogCallback.call();
            },

            init: function () {
                if($('#filter').length == 0)
                    return;

                Filter.initPriceSlider();
                Filter.initCatalog();
                Filter.initFilters();

                Filter.onChange(function () {
                    Filter.catalog.update();
                    Filter.showFilterMessage();
                    $('.filter-wrap').css({
                        height: $('#filter').outerHeight()
                    })
                });

                Filter.onUpdateCatalog(function () {
                });
            },

            initPriceSlider: function () {
                var $fMinPrice = $(Filter.filterMinPriceSelector),
                    $fMaxPrice = $(Filter.filterMaxPriceSelector),
                    label = $('.filter-list--item--title[data-name="price"]'),
                    labelVariants = label.data('label').split(',');

                Filter.priceFilter = {
                    label: label,
                    labelVariants: labelVariants,
                    slider: $(Filter.sliderSelector).slider(),
                    initMinPrice: $fMinPrice.val(),
                    initMaxPrice: $fMaxPrice.val(),
                    currentMinPrice: $fMinPrice.val(),
                    currentMaxPrice: $fMaxPrice.val(),

                    change: function (min, max) {
                        this.currentMinPrice = min;
                        this.currentMaxPrice = max;

                        this.label.find(Filter.filterLabelTextAreaSelector).text(
                            this.labelVariants[1].replace('min',this.currentMinPrice).replace('max',this.currentMaxPrice)
                        );
                        this.slider.slider('setValue', [min, max]);

                        this.label.addClass('active');

                        Filter.change();
                    },

                    clear: function () {
                        this.currentMinPrice = this.initMinPrice;
                        this.currentMaxPrice = this.initMaxPrice;

                        this.label.find(Filter.filterLabelTextAreaSelector).text(this.labelVariants[0]);
                        this.slider.slider('setValue', [this.currentMinPrice, this.currentMaxPrice]);
                        $fMinPrice.val(this.currentMinPrice);
                        $fMaxPrice.val(this.currentMaxPrice);

                        this.label.removeClass('active');

                        Filter.change();
                    }
                };

                label.find(Filter.filterClearBtn).on('click', function(){
                    Filter.priceFilter.clear();
                });

                Filter.priceFilter.slider.on('slide', function(ev){
                        $fMinPrice.val(ev.value[0]);
                        $fMaxPrice.val(ev.value[1]);
                    });

                $(Filter.filterMinPriceSelector+','+Filter.filterMaxPriceSelector).keyup(function(){

                    Filter.priceFilter.change($fMinPrice.val(),$fMaxPrice.val());
                });

                Filter.priceFilter.slider.on('slideStop', function(){
                        Filter.priceFilter.change($fMinPrice.val(),$fMaxPrice.val());
                    });
            },

            initCatalog: function () {
                Filter.catalog = {
                    products: {},
                    update: function () {
                        var self = this,
                            complies = false;

                        $.each(self.products, function (id, product) {
                            if(product.price < Filter.priceFilter.currentMinPrice || product.price > Filter.priceFilter.currentMaxPrice){
                                self.products[id].active = false;
                                return true;
                            }
                            $.each(Filter.filters, function (filterName, filterData) {
                                complies = 1;
                                $.each(filterData.data, function (filterId, filterItemData) {
                                    if(filterItemData.active && filterItemData.value != ''){
                                        complies = !(product.filter.indexOf(filterItemData.value) == -1);
                                        if (complies)
                                            return false;
                                    }
                                });
                                if (complies) {
                                    self.products[id].active = true;
                                } else {
                                    self.products[id].active = false;
                                    return false;
                                }
                            });
                        });

                        $.each(self.products, function (id){
                            if(self.products[id].active)
                                $(Filter.productSelector+'[data-id="'+id+'"]').removeClass('hidden');
                            else
                                $(Filter.productSelector+'[data-id="'+id+'"]').addClass('hidden');
                        });

                        Filter.updateCatalog();
                    }
                };

                $(Filter.productSelector).each(function (i, item) {
                    var $product = $(item);
                    Filter.catalog.products[$product.data('id')] = {
                        filter: $product.data('filter').split(','),
                        price: $product.data('price'),
                        active: true
                    }
                });
            },

            initFilters:function () {
                $(Filter.filterItemSelector).each(function (i, item) {
                    var $filter = $(item),
                        label;

                    if(Filter.filters[$filter.data('name')] == undefined){
                        label = $('.filter-list--item--title[data-name="'+$filter.data('name')+'"]');
                        label.find(Filter.filterClearBtn).on('click', function(){
                            Filter.filters[$filter.data('name')].clear();
                        });

                        Filter.filters[$filter.data('name')] = {
                            label: label,
                            labelVariants: label.data('plural').split(','),
                            data: {},
                            change: function (filterId, status) {
                                this.data[filterId].active = status;
                                this.changeLabel();
                                Filter.change();
                            },

                            createUrl: function () {

                            },
                            getItemSelectedCount: function () {
                                var count = 0;
                                $.each(this.data, function (i,itemData) {
                                        if(itemData.active)
                                            count++;
                                });

                                return count
                            },
                            getOneSelected: function () {
                                var result = undefined;
                                $.each(this.data, function (i,itemData) {
                                    if(itemData.active){
                                        result = itemData;
                                        return false
                                    }
                                });
                                return result;
                            },
                            getLabel: function () {
                                var count = this.getItemSelectedCount(),
                                    label;

                                if (count>0)
                                {
                                    var s1 = Math.abs(count) % 100;
                                    var s2 = count % 10;

                                    if (s1 > 10 && s1 < 20) label = this.labelVariants[2];
                                    else if (s2 > 1 && s2 < 5) label = this.labelVariants[1];
                                    else if (s2 == 1){
                                        label = this.labelVariants[0]+': '+ this.getOneSelected().text
                                    }
                                    else label = this.labelVariants[2];

                                    label = label.replace('n',count);
                                    this.label.addClass('active');
                                }else{
                                    label = this.labelVariants[0];
                                    this.label.removeClass('active');
                                }

                                return label.toString();
                            },

                            changeLabel: function () {
                                this.label.find(Filter.filterLabelTextAreaSelector).text(this.getLabel())
                            },

                            clear: function () {
                                $.each(this.data, function (i, itemData) {
                                    if (itemData.active) {
                                        $(itemData.id).prop('checked', false);
                                        itemData.active = false;
                                    }
                                });
                                this.changeLabel();
                                Filter.change();
                            }
                        }
                    }

                    Filter.filters[$filter.data('name')]['data'][$filter.attr('id')] = {
                        id: '#'+$filter.attr('id'),
                        value: $filter.attr('value'),
                        text: $('label[for="'+$filter.attr('id')+'"]').text(),
                        active: false,
                        enable: true
                    };

                    $filter.on('change', function(){
                        Filter.filters[$filter.data('name')].change($filter.attr('id'), $filter.is(':checked'));
                    });
                });
            },

            showFilterMessage: function () {
                var $result = $('#filter-result span');
                $result.text($(Filter.productSelector + ':visible').length);
                $result.parent().show();
            },
        };
    }();
    Filter.init();

    var $activeLine = $('.top-menu--active-line');
    $('.top-menu li a').mouseenter(function () {
        var self = $(this),
            width = self.find('span').width(),
            position = self.parent().position().left + parseInt(self.css('padding-left')),
            sectionNumber = self.data('section');

        $activeLine.css({
            width: width,
            left: position
        });

        $('header').addClass('top-menu--dropdown--show');

        $('.dropdown--section[data-section!="'+sectionNumber+'"]').hide();
        $('.dropdown--section[data-section="'+sectionNumber+'"]').show();
    });

    $('.top-menu li a').click(function () {
        return false;
    });

    function hideTopMenuDropdown() {
        $('header').removeClass('top-menu--dropdown--show');
        $('.dropdown--section').hide();
        $activeLine.css({
            width: 0
        });
    }

    $('.top-menu--overlay').hover(function () {
        hideTopMenuDropdown();
    });

    $('.top-menu--dropdown--close').click(function () {
        hideTopMenuDropdown();
    });

    var $filter = $('#filter');

    $filter.affix({
        offset: {
            top:  function () {
                return (this.top = $filter.offset().top)
            }
        }
    });

    var productAffixInfo = $('.product-affix--info');

  /*  $('.product-affix--info-wrap').css({
        height: productAffixInfo.outerHeight()
    })

    productAffixInfo.affix({
        offset: {
            top:  function () {
                return (this.top = productAffixInfo.offset().top -20)
            }
        }
    });*/

    // $('img').on('dragstart contextmenu', function(event) { event.preventDefault(); });

    $('.sticky-column').stick_in_parent({
        parent: '.container',
        spacer: false,
        offset_top: 20
    });
});