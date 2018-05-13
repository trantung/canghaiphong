/**
 * Created by Dao Quang Dung on 15/10/16.
 */
$(document).ready(function(){
    $('.slider-box2').owlCarousel({
        loop:false,
        margin:36,
        nav:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplaySpeed:3000,
        smartSpeed: 600, // duration of change of 1 slide
        dots: false,
        responsive:{
            0:{
                items:1
            },
            600:{
                items:3
            },
            1000:{
                items:3
            }
        }
    });

    $('.slider-box3').owlCarousel({
        loop:false,
        margin:36,
        nav:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplaySpeed:3000,
        smartSpeed: 600, // duration of change of 1 slide
        dots: false,
        responsive:{
            0:{
                items:1
            }
        }
    });

    $('.slider-box4').owlCarousel({
        loop:true,
        margin:25,
        nav:true,
        autoplay:true,
        autoplayTimeout:3000,
        autoplaySpeed:3000,
        smartSpeed: 600, // duration of change of 1 slide
        dots: false,
        responsive:{
            0:{
                items:2,
                margin:5,
            },
            600:{
                items:4
            },
            1000:{
                items:4
            }
        }
    })

    $(".a-action-address").click(function () {
        $(this).parents(".wapper-action-content-item-info").find(".content-item-address").toggle("200");
        console.log($(this).data("click"));
        if($(this).data("click") == 0){
            $(this).html("<span style='color: red'>« Đóng</span>");
            $(this).data("click",1);
        }else{
            $(this).html("» Xem chi tiết");
            $(this).data("click",0);
        }
    });

    $('.sidebar-url-list').idealselect();

    $('.sidebar-url-list').on('change', function () {
        var url = $(this).val(); // get selected value
        if (url) { // require a URL
            window.open(url,'_blank');
        }
        return false;
    });

});