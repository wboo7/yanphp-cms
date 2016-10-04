define(function(){

        var yanResponsiveNav = function(option){
            return new yanResponsiveNav.prototype.init(option);
        };
        yanResponsiveNav.defaults = {
            container:'',
            toggle:'.yan-nav-toggle',
            search:false
        };
        yanResponsiveNav.prototype = {
            init:function(options){
                this.opt = $.extend(yanResponsiveNav.defaults,options);
                this.$container = $(this.opt.container);
                this.$yanNav = $('.yan-nav',this.$container);
                this.$yanNavToggle = $(this.opt.toggle,this.$container);
                if(!this.opt.search)
                {
                    $('.search-group',this.$container).hide();
                }
                this.bind();

            },
            bind:function(){
                var clickOrTouch = (('ontouchstart' in window)) ? 'touchstart' : 'click';
                var that = this;
                this.$yanNavToggle.on(clickOrTouch,function(){
                    $(this).toggleClass("toggle-animate");
                    if(that.$yanNav.hasClass("open-nav")) {
                        that.$yanNav.removeClass("open-nav").addClass("close-nav");
                    }else {
                        that.$yanNav.addClass("open-nav").removeClass("close-nav");
                    }
                });
            }
        };
        yanResponsiveNav.prototype.init.prototype = yanResponsiveNav.prototype;
        return yanResponsiveNav;


});