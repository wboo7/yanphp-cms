define(function(){
        $.fn.simpleSlide = function(options)
        {
            var defaults = {
                item:'slide-item',
                showDelay:0,
                hideDelay:0,
                curIndex:0

            };
            options = $.extend(defaults,options);

            return this.each(function(){
                var slideItem = $(this).find(options.item);
                var len = slideItem.length;
                var dots = $('<div class="slide-dots"></div>');
                for(var i =0;i<len;i++)
                {
                    $('<span></span>').appendTo(dots).click(function(){
                        var index = $(this).index();
                        $(this).addClass('simple-slide-active').siblings().removeClass('simple-slide-active');
                        slideItem.eq(index).show(options.showDelay).siblings(options.item).hide(options.hideDelay);
                    });
                }

                dots.appendTo($(this));
                dots.find('span').eq(options.curIndex).addClass('simple-slide-active').siblings().removeClass('simple-slide-active');
                slideItem.eq(options.curIndex).show().siblings(options.item).hide();


            });
        }

});