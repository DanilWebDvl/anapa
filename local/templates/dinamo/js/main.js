$(document).ready(function(){
    sliders();
    menu();
    team_page();
    popup();
    filter();
});

function popup() {
    $('[data-fancybox="gallery"]').fancybox({
        // Options will go here
    });
}

function team_page() {
    $('.js_team_filter .js_part').on('click', function() {
        $('.js_team_filter .js_part').removeClass('active');
        $(this).addClass('active');

        let index = $(this).attr('data-index');
        $('.js_slide_for_top').removeClass('active');
        $('.js_slide_for_top[data-index='+index+']').addClass('active');
    });
}

function menu() {
    $('body').on('click', '.js_menu', function (){
        $('body').toggleClass('active_menu');
        let header_height = $('header').outerHeight();
        $('.mega_menu').css('top', header_height + 'px');
        $(this).find('.svg_burger').toggle();
        $(this).find('.svg_burger_close').toggle();
    });
    $('body').on('click', '.js_filter_burger', function (){
        $(this).toggleClass('active');
    });
}

function sliders() {
    $('.slider_init').slick({
        prevArrow: '<button type="button" class="slick-prev"></button>',
        nextArrow: '<button type="button" class="slick-next"></button>',
    });
    var slider_multiple = $('.slider_multiple');
    slider_multiple.owlCarousel({
        stagePadding: 50,
        loop:true,
        center:true,
        dots:true,
        autoWidth:true,
        onTranslate: slide_drag,
        responsive:{
            0:{
                margin:10,
                items:1
            },
            600:{
                margin:30,
                items:2
            },
            1000:{
                margin:70,
                items:3
            },
            1300:{
                margin:50,
                items:4
            }
        }
    });
    slider_multiple.on('mousewheel', '.owl-stage', function (e) {
        console.log(e.originalEvent.deltaY && document.documentElement.clientWidth > 991);
        if (e.originalEvent.deltaY>0) {
            slider_multiple.trigger('next.owl');
        } else {
            slider_multiple.trigger('prev.owl');
        }
        e.preventDefault();
    });
    var slider_multiple_team = $('.slider_multiple_team');
    slider_multiple_team.owlCarousel({
        dots:true,
        nav:true,
        navContainer: $('.nav_by_slider_team'),
        stagePadding: 50,
        loop:true,
        center:true,
        autoWidth:true,
        responsive:{
            0:{
                margin:10,
                items:1
            },
            600:{
                margin:30,
                items:2
            },
            1000:{
                margin:70,
                items:3
            },
            1300:{
                margin:50,
                items:4
            }
        }
    });
    slider_multiple_team.on('mousewheel', '.owl-stage', function (e) {
        if (e.originalEvent.deltaY>0 && document.documentElement.clientWidth > 991) {
            slider_multiple_team.trigger('next.owl');
        } else {
            slider_multiple_team.trigger('prev.owl');
        }
        e.preventDefault();
    });
    if ( document.documentElement.clientWidth <= 991 ){
        $('.single_slider_media').removeClass('owl-carousel');
    }
    if ( document.documentElement.clientWidth > 991 ){
        $('.single_slider_media').owlCarousel({
            nav:true,
            items:1,
            dots: false,
            navContainer: $('.nav_by_slider_media'),
        });
    }
    $('.single_slider').owlCarousel({
        nav:true,
        items:1,
        dots: false,
        navContainer: $('.nav_by_slider_single'),
    });
    $('.single_slider_2').owlCarousel({
        nav:true,
        items:1,
        dots: false,
        navContainer: $('.nav_by_slider_single_2'),
    });
    if ( document.documentElement.clientWidth <= 767 ){
        $('.slider_multiple_2').removeClass('owl-carousel');
    }
    if ( document.documentElement.clientWidth > 767 ){
        var slider_multiple_2 = $('.slider_multiple_2');
        slider_multiple_2.owlCarousel({
            margin: 30,
            nav:true,
            navContainer: $('.nav_by_slider_2'),
            loop: true,
            dots:false,
            center:true,
            onTranslated: slide_drag_2,
            initialized: slide_drag_2,
            autoWidth:true,
            responsive:{
                600:{
                    items:2

                },
                1000:{
                    items:3
                }
            }
        });
        slider_multiple_2.on('mousewheel', '.owl-stage', function (e) {
            if (e.originalEvent.deltaY>0 && document.documentElement.clientWidth > 991) {
                slider_multiple_2.trigger('next.owl');
            } else {
                slider_multiple_2.trigger('prev.owl');
            }
            e.preventDefault();
        });
    }
}

function slide_drag(event) {
    $(event.currentTarget).find('.owl-dots .owl-dot').removeClass('prevActive');
    $(event.currentTarget).find('.owl-dots .owl-dot').each(function (index, item) {
        if (!$(item).hasClass('active')) {
            $(item).addClass('prevActive');
        } else {
            return false;
        }
    });
}

function slide_drag_2(event) {
    $(event.currentTarget).find('.news').removeAttr('style');
    if ( document.documentElement.clientWidth > 991 ){
        $(event.currentTarget).find('.center .news').css('width', '630px');
    }
}

function filter() {
    $('body').on('change', '.filter_burger .checkbox input', function () {

        let arYear = [], arMonth = [], data = {};
        $('.filter_burger .checkbox input').each(function (index, node) {

            if ($(node).attr('name') === 'year' && $(node).is(":checked")) {
                arYear.push($(node).attr('value'));
            }
            if ($(node).attr('name') === 'month' && $(node).is(":checked")) {
                arMonth.push($(node).attr('value'));
            }

        });

        if (arYear.length > 0) {
            data.year = arYear.join()
        }

        if (arMonth.length > 0) {
            data.month = arMonth.join()
        }

        $.ajax({
            url: document.location.href,
            method: 'GET',
            data: data,
            success: (result) => {
                html = $(result).find('.js_page_filtrable').html();
                console.log(html);
                $('body').find('.js_page_filtrable').html(html);
            },
            error: (jqXHR, textStatus, errorThrown) => {

            },
        });

    });
}