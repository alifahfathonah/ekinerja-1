var BlankonSignType2 = function () {

    return {

        // =========================================================================
        // CONSTRUCTOR APP
        // =========================================================================
        init: function () {
            BlankonSignType2.signBackstretch();
        },

        // =========================================================================
        // BACKSTRETCH
        // =========================================================================
        signBackstretch: function () {
            // Duration is the amount of time in between slides,
            // and fade is value that determines how quickly the next image will fade in
            $.backstretch([
                BlankonSign.signBaseURL()+'/assets/img/1.jpg',
                BlankonSign.signBaseURL()+'/assets/img/2.jpg'
            ], {duration: 5000, fade: 750});
        }

    };

}();

// Call main app init
BlankonSignType2.init();