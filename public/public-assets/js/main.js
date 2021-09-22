(function($) {
    "use strict";
    
    // result page owl-carousel
    // 0 600 1000 1100 1200 1400 1600 1700
    $(".owl-carousel").owlCarousel({
        loop: true,
        center:true,
        rtl:false,
        autoWidth:false,
        autoplay:true,
        autoplayTimeout:2000,
        autoplayHoverPause:true,
        responsive:{
            0:{
                items:2,
                nav:false,
            },
            1200:{
                items:3,
                margin:40,
                nav:false,
            },
            1600:{
                items:4,
                margin:40,
                nav:false
            },
            1700:{
                items:4,
                margin:40,
                nav:false,
            },
            1800:{
                items:5,
                margin:40,
                nav:false
            },
        }
    });

    // hide question
    $("li label").on("click", function () { 
        $(this).parents(".content-wrap-single").addClass("hideMe");
        $(this).parents("div").next("div").removeClass("hideMe");
        $(this).parents("div").next("div").addClass("que-active");
    });



    // result page mouse wheel get category result
    $('.slider').on('wheel', function(e) {
        e.preventDefault();

        if (e.originalEvent.deltaY < 0) {
            $(this).slick('slickNext');
        } else {
            $(this).slick('slickPrev');
        }
    });

    $('.slider').on('afterChange', function(event, slick, currentSlide, nextSlide) {

        var parent = document.querySelector(".slick-slide.slick-current.slick-active.slick-center");
        var child = parent.querySelector(".data-single");
        document.getElementById("data-number").value = child.getAttribute("data-number");

    });

    // slick slider vertical sliding
    $(document).ready(function(){
        const slider = $(".slider");
        slider.slick({
            infinite: true,
            vertical: true,
            centerMode: true,
            dots: false,
            arrows: false,
            cssEase: 'ease',
            easing: 'linear',
            verticalSwiping: true,
            speed: 100,
            slidesToScroll: 3
        });
    });


    // theme style
    $(document).ready(function($) {
        $('.dark-btn').on("click", function(e) {
            updateThemStyle(1);
        });
        $('.light-btn').on("click", function(e) {
            updateThemStyle(2);
        });
    
        function updateThemStyle(val){
            $.ajax({
                url:window.location.origin+"/theme-setting/"+val,
                type: 'get',
                success: function(res) {
                    if(res==1) {
                        $("body").removeClass("light");
                        $("body").addClass( "dark" );
                    }
                    if(res==2) {
                        $("body").removeClass("dark");
                        $("body").addClass( "light" );
                    }
                }
            });
        } 
    });
    
})(jQuery);