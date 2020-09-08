var BlankonDashboard = function () {

    var globalPluginsPath = url1818+'themes/default/assets/global/plugins/bower_components';
    return {

        // =========================================================================
        // CONSTRUCTOR APP
        // =========================================================================
        init: function () {
            BlankonDashboard.counterOverview();
            //BlankonDashboard.countNumber();
        },
        counterOverview: function () {
            if($('.counter').length){
                $('.counter').counterUp({
                    delay: 10,
                    time: 1000
                });
            }
        },
        /*
        countNumber: function () {
            $.fn.digits = function(){
                return this.each(function(){
                    $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
                })
            };
            function counter($selector){
                $({countNum: $('.counter-' + $selector).text()}).animate({countNum: $('.counter-' + $selector).data('counter')}, {
                    duration: 8000,
                    easing:'linear',
                    step: function() {
                        $('.counter-' + $selector).text(Math.floor(this.countNum)).digits();
                    },
                    complete: function() {
                        $('.counter-' + $selector).text(this.countNum).digits();
                    }
                });
            }
        },
        */
    };

}();

// Call main app init
BlankonDashboard.init();
