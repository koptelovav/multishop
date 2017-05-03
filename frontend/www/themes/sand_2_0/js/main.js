function passEventLower(e) {
    e.preventDefault();
    e.stopPropagation();
    var $el = $(document.elementFromPoint(e.pageX, e.pageY));
    var c = $el.css('cursor') || 'default';
    if (c == 'auto')
        c = 'default';
    $(e.target).css('cursor', c);
    $el.trigger(e.type);
}

$(document).on("submit", "#callback-form", function(event){
    var form = $(this);
    $.ajax({
        type: 'POST',
        url: form.attr('action'),
        data: form.serialize(),
        success: function(data){
            if(data == 'OK'){
                $('#callback-area').html('<h2>Ваша заявка принята!</h2> Скоро наш менеджер свяжется с вами.');
            }
        }
    });
    return false;
});


$(function(){
    $('.owl-carousel').owlCarousel({
        navText: [ 'следующее видео', 'предыдущее видео' ],
        rtl:true,
        loop:true,
        margin:10,
        nav:true,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:4
            }
        }
    });

    $('#nav-catalog ').affix({
        offset: {
            top: 71
        }
    });

    $('#sidebar').affix({
        offset: {
            top: 71
        }
    });

    $('#sidebar-header').affix({
        offset: {
            top: 71
        }
    });

    $('.sidebar-header, .nav.nav-stacked a').click(function(){
        if($('.sidebar-header').is(':visible')){
            $('.nav.nav-stacked').toggle();
        }
    });

    var $body   = $(document.body);
    var navHeight = $('.navbar').outerHeight(true) + 10;

    $body.scrollspy({
        target: '#leftCol',
        offset: navHeight
    });

    var $video = $('header video'),
        $header = $('header'),
        k=1280/720;

    $('.play').click(function(){
        $video.get(0).currentTime = 0;
        $video.get(0).muted = false;
        $video.get(0).play();
        $('body').addClass('played');
    });

    $video.click(function(){
        $video.get(0).pause();
    });

    if( $video.get(0)){
        $video.get(0).addEventListener('pause',myHandler,false);
        function myHandler(e) {
            $('body').removeClass('played');
        }
    }

    $(window).resize(function() {
        var  windowsWidth = $(window).width(),
             windowsHeight = $(window).height(),
             videoHeight = windowsHeight,
             videoWidth = windowsHeight*k;

        if(videoWidth < windowsWidth){
            videoHeight = windowsWidth / k;
            videoWidth = windowsWidth;
        }

        $video.css({
            width: videoWidth,
            height: videoHeight,
            'margin-left': -(videoWidth - windowsWidth) / 2
        });


        $header.css({
            'min-height': videoHeight - 75,
            width:windowsWidth
        });
    });

    $(window).trigger('resize');

    var links = [];
    $('.image-box a').each(function(i, item){
       links.push({
           element: $(item),
           x1: $(item).offset().left,
           y1: $(item).offset().top,
           x2: $(item).offset().left+$(item).width(),
           y2: $(item).offset().top+$(item).height()
       });
    });

    $('.img-wrapper').on('click', function(e) {
        console.log(e.pageX, e.pageY);
        $(links).each(function(i, obj){
            console.log([obj.x1, obj.x2], [obj.y1,obj.y2]);
            if(obj.x1 <= e.pageX && obj.x2 >= e.pageX)
                if(obj.y1 <= e.pageY && obj.y2 >= e.pageY)
                    obj.element.trigger('click');
        });
        return false;
    });

    $.scrollUp({
        scrollName: 'scrollUp', //  ID элемента
        topDistance: '300', // расстояние после которого появится кнопка (px)
        topSpeed: 300, // скорость переноса (миллисекунды)
        animation: 'fade', // вид анимации: fade, slide, none
        animationInSpeed: 200, // скорость разгона анимации (миллисекунды)
        animationOutSpeed: 200, // скорость торможения анимации (миллисекунды)
        scrollText: 'Наверх', // текст
        activeOverlay: false // задать CSS цвет активной точке scrollUp, например: '#00FFFF'
    });

    $('.switch').click(function(){
       $(this).find('div').each(function(){
           $(this).toggle();
       });
    });
});