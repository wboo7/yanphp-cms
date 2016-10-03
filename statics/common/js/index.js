$(document).ready(function () {
    var w = document.body.clientWidth;
    var h = 300;
    $(".slider").Kslider({
        widthVal: '100%',
        heightVal: h,
        delays: 8000,
        autoPlay: 1,
        effect: 'fade'
    });
    $('#btnList').css({'width': '100px', 'left': '1%', 'bottom': '15px'});

    /* index-aninate */
    var $index_animate = $('.index-animate');
    var _showFun=[
        function(){$index_animate.find('div').delay(500).animate({opacity:0});
            _takeOne();
        },
        function(){
            $('.animate-nav').animate({opacity:1},2000,'swing',_takeOne)
        },
        function(){
            $('.animate-banner').animate({opacity:1},2000,'swing',_takeOne)
        },
        function(){
            $('.animate-page').animate({opacity:1},2000,'swing',_takeOne)

        },
        function(){
            $('.animate-other').animate({opacity:1},2000,'swing',_takeOne)

        },
        function(){
            $('.animate-footer').animate({opacity:1},2000,'swing')

        },



    ];
    $index_animate.queue('showList',_showFun);
    var _takeOne = function(){
        $index_animate.dequeue('showList');
    };
    _takeOne();
});