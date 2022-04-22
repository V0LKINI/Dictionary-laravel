
$(document).ready(function () {
    ChangeTheme();
    onClickBurger();

});

function onClickBurger() {
    $('#topMenu__burger').click(function(){
        $('#navbarSupportedContent').toggleClass('navbar-open');
    });
}

(function($) { "use strict";

    $(function() {
        var header = $(".start-style");
        $(window).scroll(function() {
            var scroll = $(window).scrollTop();

            if (scroll >= 10) {
                header.removeClass('start-style').addClass("scroll-on");
            } else {
                header.removeClass("scroll-on").addClass('start-style');
            }
        });
    });

    //Animation

    $(document).ready(function() {
        $('body.hero-anime').removeClass('hero-anime');
    });

    //Menu On Hover

    $('body').on('mouseenter mouseleave','.nav-item',function(e){
        if ($(window).width() > 750) {
            var _d=$(e.target).closest('.nav-item');_d.addClass('show');
            setTimeout(function(){
                _d[_d.is(':hover')?'addClass':'removeClass']('show');
            },1);
        }
    });
})(jQuery);


//Switch light/dark
function ChangeTheme(){

    var isDark;

    $("#switch").on('click', function () {
        if ($("body").hasClass("dark")) {
            isDark = 0;
            $("body").removeClass("dark");
            $("#switch").removeClass("switched");
        }
        else {
            isDark = 1;
            $("body").addClass("dark");
            $("#switch").addClass("switched");
        }

        console.log(isDark);

        $.ajax({
            url: '/changetheme',
            type: "POST",
            dataType: "json",
            data: {'isDark': isDark},
            headers: {
                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
            },
        });
    });

}

$('.footer__btn').click(function(){
    $('html, body').animate({scrollTop: 0}, 0);
    return false;
});

