$(document).ready(function(){
    sliders();
    menu();
    team_page();
    popup();
    filter();
    events();
    tabs();
});

function events() {
    $('body').on('click', '.js_pager_card', function () {
        var link = $(this).find('a').attr('href');
        if (link !== undefined && link !== '') {
            document.location.href = link;
        }
    });

    $('body').on('click', '.js_but_to_top', function () {
        $('body,html').animate({scrollTop: 0}, 400);
    });

    window.addEventListener('scroll', function() {
        if ($('.js_but_to_top').length <= 0) return;

        if ($(window).scrollTop() >= 500) {
            if (!$('.js_but_to_top').hasClass('active')) {
                $('.js_but_to_top').addClass('active');
            }
        } else {
            if ($('.js_but_to_top').hasClass('active')) {
                $('.js_but_to_top').removeClass('active');
            }
        }

    });
}

function popup() {
    $('[data-fancybox="gallery"]').fancybox({
        // Options will go here
    });
}

function team_page() {
    $('.js_team_filter .js_part').on('click', function() {
        $('.js_team_filter .js_part').removeClass('active');
        $(this).addClass('active');

        var index = $(this).attr('data-index');
        $('.js_slide_for_top').removeClass('active');
        $('.js_slide_for_top[data-index='+index+']').addClass('active');
    });
}

function menu() {
    $('body').on('click', '.js_menu', function (){
        $('body').toggleClass('active_menu');
        let header_height = $('header').outerHeight();
        // let header_height=104;
        $('.mega_menu').css('top', header_height + 'px');
        $(this).find('.svg_burger').toggle();

        $(this).find('.svg_burger_close').toggle();
    });
    $('body').on('click', '.js_filter_burger', function (){
        $(this).toggleClass('active');
    });
    $(document).mouseup( function(e) {
        let div = $('.js_filter_burger');
        if (div === undefined) return;

        if ( !div.is(e.target)
            && div.has(e.target).length === 0 ) {
            $('.js_filter_burger').removeClass('active');
        }
    });
}

function sliders() {
    let scrollX = 0;
    $('.slider_init').slick({
        prevArrow: '<button type="button" class="slick-prev"></button>',
        nextArrow: '<button type="button" class="slick-next"></button>',
    });
    var slider_multiple = $('.slider_multiple');
    slider_multiple.owlCarousel({
        stagePadding: 50,
        center:true,
        autoWidth:false,
        onTranslate: slide_drag,
        responsive:{
            0:{
                dots:false,
                margin:10,
                items:1
            },
            600:{
                dots:false,
                margin:30,
                items:2
            },
            1000:{
                dots:true,
                margin:70,
                items:3
            },
            1300:{
                margin:40,
                items:4
            },
            1900:{
                items:5
            },
            2400:{
                items:6
            }
        }
    });
    slider_multiple.on('mousewheel', '.owl-stage', function (e) {
        scrollX++;
        if (scrollX > 5) {
            if (e.originalEvent.deltaX>0 && document.documentElement.clientWidth > 991 && e.originalEvent.deltaX!==-0) {
                slider_multiple.trigger('next.owl');
                e.preventDefault();
            } else if (e.originalEvent.deltaX!==-0) {
                slider_multiple.trigger('prev.owl');
                e.preventDefault();
            }
            scrollX = 0;
        }
    });
    let num = 0, find = true, last = 0;
    $(slider_multiple).find('.card').each(function (index, el) {
        last = index;
        if ($(el).hasClass('prev')) {
            num = index;
        } else {
            find = false;
            return false;
        }
    });
    if (!find)
        $(slider_multiple).owlCarousel('to', num + 1);
    else
        $(slider_multiple).owlCarousel('to', last);

    var slider_multiple_team = $('.slider_multiple_team');
    slider_multiple_team.owlCarousel({
        dots:true,
        nav:true,
        navContainer: $('.nav_by_slider_team'),
        stagePadding: 50,
        loop: true,
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
        scrollX++;
        if (scrollX > 5) {
            if (e.originalEvent.deltaX>0 && document.documentElement.clientWidth > 991 && e.originalEvent.deltaX!==0) {
                slider_multiple_team.trigger('next.owl');
                e.preventDefault();
            } else if (e.originalEvent.deltaX!==-0) {
                slider_multiple_team.trigger('prev.owl');
                e.preventDefault();
            }
            scrollX = 0;
        }
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
            dots:false,
            loop: true,
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
            scrollX++;
            if (scrollX > 5) {
                if (e.originalEvent.deltaX>0 && document.documentElement.clientWidth > 991 && e.originalEvent.deltaX!==0) {
                    slider_multiple_2.trigger('next.owl');
                    e.preventDefault();
                } else if (e.originalEvent.deltaX!==-0) {
                    slider_multiple_2.trigger('prev.owl');
                    e.preventDefault();
                }
                scrollX = 0;
            }
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
        //$(event.currentTarget).find('.center .active:nth-child(1)').css('width', '630px');
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
                $('body').find('.js_page_filtrable').html(html);
            },
            error: (jqXHR, textStatus, errorThrown) => {

            },
        });

    });


    window.addEventListener('scroll', function() {
        if ($('.filter_top.fixed').length <= 0) return;

        if ($('.filter_top.fixed').hasClass('active')) {
            if ($(window).scrollTop() < $('.filter_top.fixed').closest('.parent').offset().top) {
                $('.filter_top.fixed').removeClass('active');
            }
        } else {
            if ($(window).scrollTop() >= $('.filter_top.fixed').closest('.parent').offset().top) {
                $('.filter_top.fixed').addClass('active');
            }
        }

        $('.filter_top.fixed .filter_part').each(function (index, val) {
            let link = $(val).find('a');
            let id = link.attr('href');
            if ($(window).scrollTop() >= $(id).offset().top - 50 && $(window).scrollTop() <= $(id).offset().top + 50) {
                $('.filter_top.fixed .filter_part').removeClass('active');
                $(val).addClass('active');
            }
        });

    });
}

function tabs() {
    $('body').on('click', '.js_tab', function () {
        let index = $(this).attr('data-tab');
        $('.js_tab').removeClass('active');
        $(this).toggleClass('active');
        $('.js_tab_content').removeClass('active');
        $('.js_tab_content[data-tab-content="'+ index +'"]').addClass('active');
    });
}