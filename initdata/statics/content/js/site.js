$(function(){
    if($('.nav1473135388')[0])
    {
        require(['css!plugin/yanResponsiveNav/yanResponsiveNav','plugin/yanResponsiveNav/yanResponsiveNav'],function(undefined,yanResponsiveNav){
            yanResponsiveNav({
                container:'.demo-nav',
                search:true
            });

        });
    }
});

$(function(){
    if($('.slide1469750651')[0])
    {
        require(['css!plugin/responsiveSlides/responsiveslides','plugin/responsiveSlides/responsiveslides'],function(){
            $(function(){
                $(".rslides").responsiveSlides({
                    manualControls: '#slider-pager',
                    speed: 300,
                    maxwidth: 1920
                });
            })
        });
    }
});







$(function(){
    if($('.show1470286236')[0])
    {
        require(['plugin/simpleSlide/simple-slide'],function(){
            $('.show1470286236 .simple-slide').simpleSlide({
                item:'.slide-item',
                showDelay:300
            });
        });
    }

});
