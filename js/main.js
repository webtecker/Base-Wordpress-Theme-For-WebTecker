/*-----------------------------------------------------------------------------------*/
/* Back to Top Button
/*-----------------------------------------------------------------------------------*/

jQuery(function ($) {

    $("#back-to-top").hide();
    
    $(function () {
        $(window).scroll(function () {
            if ($(this).scrollTop() > 100) {
                $('#back-to-top').fadeIn();
            } else {
                $('#back-to-top').fadeOut();
            }
        });

        $('#back-to-top a').click(function () {
            $('body,html').animate({
                scrollTop: 0
            }, 800);
            return false;
        });
    });

});
