(function ($) {
    "use strict";

    $.cookie('panel_cookie');

    /* ===================================
     START Newsletter Popup
     ====================================== */
    if ($.cookie('panel_cookie') === null) {
        setTimeout(function () {
            $('#newsletter').show();
            $('#newsletter').on("click", function () {
                $.cookie('panel_cookie', 'closed', {expires: 1, path: '/'});
            });
            $('.newsletter_popup_content').on("click", function (e) {
                e.stopPropagation();
            });
            $('.new_close').on("click", function () {
                $('#newsletter').hide();
                $.cookie('panel_cookie', 'closed', {expires: 1, path: '/'});
            });
            $('.news_form').on("click", function (e) {
                e.preventDefault();
            });
        }, 1000);
    }
    /* ===================================
     END Newsletter Popup
     ====================================== */
    /* ===================================
     START Window Height 
     ====================================== */
    var window_height = $(window).height();
    var headeheight = $('header').outerHeight();
    var footeheight = $('footer').height();
    var sub_total = headeheight + footeheight;
    var total_height = window_height - sub_total;
    $('.main_section').css('min-height', total_height);
    /* ===================================
     END Window Height
     ====================================== */
    /* ===================================
     START Back to top
     ====================================== */
    if ($('#back-to-top').length) {
        var scrollTrigger = 100, // px
                backToTop = function () {
                    var scrollTop = $(window).scrollTop();
                    if (scrollTop > scrollTrigger) {
                        $('#back-to-top').addClass('show');
                    } else {
                        $('#back-to-top').removeClass('show');
                    }
                };
        backToTop();
        $(window).on("scroll", function () {
            backToTop();
        });
        $('#back-to-top').on("click", function (e) {
            e.preventDefault();
            $('html,body').animate({
                scrollTop: 0
            }, 700);
        });
    }
    /* ===================================
     END Back to top
     ====================================== */
    /* ===================================
     START Mega Menu
     ====================================== */
    if ($(window).width() >= 1024) {
        $(".navbar-nav .dropdown").on('mouseover', function (e) {
            $(this).children('.menu_arrow').addClass('open');
            $(this).find('.dropdown-menu').stop(true, true).slideDown(300);
            e.stopPropagation();
        });
        $(".navbar-nav .dropdown-menu").on('mouseleave', function (e) {
            $(this).hide();
            $(this).parent('.dropdown').children('.menu_arrow').removeClass('open');
            e.stopPropagation();
        });        
        $(document).on('mouseover', function () {
            $(".navbar-nav .dropdown-menu").hide();
            $('.menu_arrow').removeClass('open');
        }); 
        
        $('.categories_menu_arrow').on("click", function () {
           $(this).children('.menu_arrow').toggleClass('open');
              $(this).next().slideToggle();
       });
          
        $(".categories_menu li").hover(function(){
            $(this).children("ul").toggle('slide', 'left', 1000);
            }, function(){
            $(this).children("ul").hide();
        });
        
    } else {
        $(".menu_arrow").on("click", function () {
            $(this).siblings("ul").slideToggle();
            $(this).toggleClass('open');
            $(this).parent(".navbar-nav li ").siblings().children("ul").hide();
            $(this).parents('.navbar-nav li').siblings().children('span').removeClass('open');

            $(this).siblings('ul').children('li').children('ul').hide();
            $(this).siblings('ul').children('li').children('span').removeClass('open');
        });
    }
    $('header .navbar .navbar-nav .nav-item .dropdown-menu li ul li').hover(function () {
        var img_src = $(this).data('img');
        var data_title = $(this).data('title');
        $(".drop_img").attr("src", img_src);
        $(".drop_title").text(data_title);
    });
    $('header button[data-toggle="collapse"]').on("click", function () {
        $(".navbar-collapse").addClass("show");
        $('body').toggleClass('mobile-nav-shown');
        $(this).toggleClass('open');
    });
    $('.menu_colse,.menu_overlay').on("click", function () {
        $('body').removeClass('mobile-nav-shown');
        $(".navbar-collapse").removeClass("show");
        $('.menu_arrow').removeClass('open');
        $('li .dropdown-menu').hide();
    });
    /* ===================================
     END Mega Menu
     ====================================== */
    /* ===================================
     START Search Toggle 
     ====================================== */
    $('.search_form').on("click", function (e) {
        e.stopPropagation();
    });
    $(".search_icon a").on("click", function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(this).next().toggle();
    });
    $(document).on("click", function () {
        $('.search_form').hide();
    });
    /* ===================================
     END Search Toggle 
     ====================================== */
    /* ===================================
     START Selectpicker
     ====================================== */
    $('.selectpicker').selectpicker();
    /* ===================================
     END  Selectpicker
     ====================================== */
    /* ===================================
     START Banner slider
     ====================================== */
    $(".banner_slider").owlCarousel({
        nav: false,
        dots: true,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        items: 1
    });
    /* ===================================
     END Banner slider
     ====================================== */
    /* ===================================
     START Instagram slider
     ====================================== */
    // create two separate instances of Instafeed
    if ($('#instafeed').length > 0) {
        var userFeed = new Instafeed({
            target: 'instafeed',
            get: 'user',
            tagName: 'earthyellow',
            userId: '6666610766',
            accessToken: '6666610766.2a7d13b.60b18490cde1420db117dce0dfe65513',
            resolution: 'standard_resolution',
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}"/></a>',
            after: function () {
                var x = $('.instagram_slider').children();
                var i = 0;
                for (i = 0; i < x.length; i += 2) {
                    $('.owl-item:empty').remove();
                    x.slice(i, i + 2).wrapAll('<div></div>');
                    instaslider('#instafeed');
                    $('.owl-next').on("click", function () {
                        $('.instagram_slider .owl-prev').show();
                        var active = $('.instagram_slider .active').length;
                        if (active > 1) {
                            $('.instagram_slider .owl-next').hide();
                        }
                    });
                    $('.owl-prev').on("click", function () {
                        $('.instagram_slider .owl-next').show();
                        if ($(this).hasClass('disabled') === 1) {
                            $('.instagram_slider .owl-prev').hide();
                        }
                    });

                }
            }
        });
        userFeed.run();
    }
    function instaslider(c) {
        $(c).owlCarousel({
            margin: 2,
            items: 4,
            nav: true,
            dots: false
        });
    }
    if ($('#shoes_instafeed').length > 0) {
        var shoes_userFeed = new Instafeed({
            target: 'shoes_instafeed',
            get: 'user',
            tagName: 'shoes',
            userId: '6666610766',
            accessToken: '6666610766.2a7d13b.60b18490cde1420db117dce0dfe65513',
            resolution: 'low_resolution',
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}"/></a>',
            after: function () {
                $('#shoes_instafeed').owlCarousel({
                    margin: 30,
                    items: 4,
                    nav: true,
                    dots: false,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 2,
                            margin: 20
                        },
                        767: {
                            items: 2,
                            margin: 20,
                            loop: false
                        },
                        768: {
                            items: 3,
                            loop: false,
                            margin: 20
                        },
                        992: {
                            items: 4,
                            loop: false
                        }
                    }
                });
            }
        });
        shoes_userFeed.run();
    }
    if ($('#watch_instafeed').length > 0) {
        var watch_userFeed = new Instafeed({
            target: 'watch_instafeed',
            get: 'user',
            tagName: 'watch',
            userId: '6666610766',
            accessToken: '6666610766.2a7d13b.60b18490cde1420db117dce0dfe65513',
            resolution: 'standard_resolution',
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}"/></a>',
            after: function () {
                $('#watch_instafeed').owlCarousel({
                    margin: 0,
                    items: 6,
                    nav: true,
                    dots: false,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 2
                        },
                        567: {
                            items: 3,
                            loop: false
                        },
                        768: {
                            items: 4,
                            loop: false
                        },
                        991: {
                            items: 5,
                            loop: false
                        },
                        1199: {
                            items: 6,
                            loop: false
                        }
                    }
                });
            }
        });
        watch_userFeed.run();
    }
    if ($('#bag_instafeed').length > 0) {
        var bag_userFeed = new Instafeed({
            target: 'bag_instafeed',
            get: 'user',
            tagName: 'bag',
            userId: '6666610766',
            accessToken: '6666610766.2a7d13b.60b18490cde1420db117dce0dfe65513',
            resolution: 'standard_resolution',
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}"/></a>',
            after: function () {
                $('#bag_instafeed').owlCarousel({
                    margin: 30,
                    items: 4,
                    nav: true,
                    dots: false,
                    responsiveClass: true,
                    responsive: {
                        0: {
                            items: 2,
                            margin: 20
                        },
                        767: {
                            items: 2,
                            margin: 20,
                            loop: false
                        },
                        768: {
                            items: 3,
                            loop: false,
                            margin: 20
                        },
                        992: {
                            items: 4,
                            loop: false
                        }
                    }
                });
            }
        });
        bag_userFeed.run();
    }
    if ($('#fur_instafeed').length > 0) {
        var fur_userFeed = new Instafeed({
            target: 'fur_instafeed',
            get: 'user',
            tagName: 'furniture',
            userId: '6666610766',
            accessToken: '6666610766.2a7d13b.60b18490cde1420db117dce0dfe65513',
            resolution: 'standard_resolution',
            limit:6,
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}"/></a>',
            after: function () {
                var x1 = $('.instagram_slider').children();
                var i1 = 0;
                for (i1 = 0; i1 < x1.length; i1 += 2) {                    
                    x1.slice(i1, i1 + 2).wrapAll('<div class="col-4"></div>');
                }
            }
        });
        fur_userFeed.run();
    }   
    
    /* ===================================
     End Instagram slider
     ====================================== */
    /* ===================================
     START Wishlist Toggle 
     ====================================== */
    $('.heart').each(function (e) {
        $(this).on("click", function () {
            $(this).toggleClass('add_wishlist');
        });
    });
    /* ===================================
     END Wishlist Toggle 
     ====================================== */
    /* ===================================
     START Product change column
     ====================================== */
    // Product change column
    $(document).on("click", ".grid-list", function (a) {
        var grid = $(this).data('column');
        $(this).addClass('active');
        $(this).siblings('.grid-list').removeClass('active');
        $('.category-products li.product').removeClass("column2 column3 column4").addClass(grid);
        var wow = new WOW({
            boxClass: 'wow',
            animateClass: 'animated',
            offset: 0,
            mobile: false,
            live: true
        });
        $(window).imagesLoaded(function () {
            wow.init();
        });
    });
    /* ===================================
     END Product change column
     ====================================== */
    /* ===================================
     START Range slider
     ====================================== */
    function collision($div1, $div2) {
        var x1 = $div1.offset().left;
        var w1 = 40;
        var r1 = x1 + w1;
        var x2 = $div2.offset().left;
        var w2 = 40;
        var r2 = x2 + w2;

        if (r1 < x2 || x1 > r2)
            return false;
        return true;

    }
    // slider call
    $('#slider').slider({
        range: true,
        min: 0,
        max: 135,
        values: [0, 100],
        slide: function (event, ui) {

            $('.ui-slider-handle:eq(0) .price-range-min').html('$' + ui.values[ 0 ]);
            $('.ui-slider-handle:eq(1) .price-range-max').html('$' + ui.values[ 1 ]);
            $('.price-range-both').html('<i>$' + ui.values[ 0 ] + ' - </i>$' + ui.values[ 1 ]);

            //

            if (ui.values[0] === ui.values[1]) {
                $('.price-range-both i').css('display', 'none');
                $('.ui-slider-handle').css('margin-left', '-0.8em');
            } else {
                $('.price-range-both i').css('display', 'inline');
                $('.ui-slider-handle').css('margin-left', '0');
            }

            //

            if (collision($('.price-range-min'), $('.price-range-max')) === true) {
                $('.price-range-min, .price-range-max').css('opacity', '0');
                $('.price-range-both').css('display', 'block');
                $('.ui-slider-handle').css('margin-left', '0');
            } else {
                $('.price-range-min, .price-range-max').css('opacity', '1');
                $('.price-range-both').css('display', 'none');
                $('.ui-slider-handle').css('margin-left', '-0.8em');
            }

        }
    });
    $('.ui-slider-range').append('<span class="price-range-both value"><i>$' + $('#slider').slider('values', 0) + ' - </i>' + $('#slider').slider('values', 1) + '</span>');
    $('.ui-slider-handle:eq(0)').append('<span class="price-range-min value">$' + $('#slider').slider('values', 0) + '</span>');
    $('.ui-slider-handle:eq(1)').append('<span class="price-range-max value">$' + $('#slider').slider('values', 1) + '</span>');
    /* ===================================
     END Range slider
     ====================================== */
    /* ===================================
     START mCustomScrollbar
     ====================================== */
    $('.mCustomScrollbar').mCustomScrollbar();
    /* ===================================
     END mCustomScrollbar
     ====================================== */
    /* ===================================
     START Collection Filter
     ====================================== */
    $(document).on('click', '.filter_menu a', function () {
        $('.collection_sidebar').animate({left: '0'});
        $('body').addClass('collection-filter');
    });
    $('.filter_colse,.filter-overlay').on("click", function () {
        var collection_sidebar = $('.collection_sidebar').outerWidth();
        $('.collection_sidebar').animate({left: -collection_sidebar});
        $('body').removeClass('collection-filter');
    });
    // Filter Toggle 
    $(document).on("click", ".category_close_icon", function (a) {
        $(this).parent('.category_list_title').siblings('.layer-filter').slideToggle();
        $(this).parent('.category_list_title').toggleClass('open-filter');
    });
    /* ===================================
     END Collection Filter
     ====================================== */
    /* ===================================
     START Collection Sidebar  Height
     ====================================== */
    var s_title = $('.sidebar_title').outerHeight();
    var s_height = $(window).height();
    var s_total = s_height - s_title;
    $('.filter_content').css('height', s_total - 60);
    /* ===================================
     END Collection Sidebar  Height
     ====================================== */
    /* ===================================
     START Product Detail Slider
     ====================================== */
    var sync1 = $("#sync1");
    var sync2 = $("#sync2");
    var syncedSecondary = true;
    var slidesPerPage = 4;

    sync1.owlCarousel({
        items: 1,
        dots: false
    }).on('changed.owl.carousel', syncPosition);
    sync2.on('initialized.owl.carousel', function () {
        sync2.find(".owl-item").eq(0).addClass("current");
    })
            .owlCarousel({
                items: slidesPerPage,
                dots: false,
                margin: 12,
                nav: true,
                smartSpeed: 200,
                slideSpeed: 500,
                mouseDrag: false,
                touchDrag: false,
                slideBy: slidesPerPage,
                responsiveRefreshRate: 100
            }).on('changed.owl.carousel', syncPosition2);

    function syncPosition(el) {
        var count = el.item.count - 1;
        var current = Math.round(el.item.index - (el.item.count / 2) - .5);
        if (current < 0) {
            current = count;
        }
        if (current > count) {
            current = 0;
        }
        sync2
                .find(".owl-item")
                .removeClass("current")
                .eq(current)
                .addClass("current");
        var onscreen = sync2.find('.owl-item.active').length - 1;
        var start = sync2.find('.owl-item.active').first().index();
        var end = sync2.find('.owl-item.active').last().index();

        if (current > end) {
            sync2.data('owl.carousel').to(current, 100, true);
        }
        if (current < start) {
            sync2.data('owl.carousel').to(current - onscreen, 100, true);
        }
    }
    function syncPosition2(el) {
        if (syncedSecondary) {
            var number = el.item.index;
            sync1.data('owl.carousel').to(number, 100, true);
        }
    }
    sync2.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        sync1.data('owl.carousel').to(number, 300, true);
    });
    
    
    var sync3 = $("#sync3");
    var sync4 = $("#sync4");
    var syncedSecondary1 = true;
    var slidesPerPage1 = 5;

    sync3.owlCarousel({
        items: 1,
        dots: false
    }).on('changed.owl.carousel', syncPosition3);
    sync4.on('initialized.owl.carousel', function () {
        sync4.find(".owl-item").eq(0).addClass("current");
    })
            .owlCarousel({
                items: slidesPerPage1,
                dots: false,
                margin: 12,
                nav: true,
                autoplay:false ,
                smartSpeed: 200,
                slideSpeed: 500,
                mouseDrag: false,
                touchDrag: false,
                slideBy: slidesPerPage1,
                responsiveRefreshRate: 100
            }).on('changed.owl.carousel', syncPosition4);

    function syncPosition3(el) {
        var count3 = el.item.count - 1;
        var current3 = Math.round(el.item.index - (el.item.count / 2) - .5);
        if (current3 < 0) {
            current3 = count3;
        }
        if (current3 > count3) {
            current3 = 0;
        }
        sync4
                .find(".owl-item")
                .removeClass("current")
                .eq(current3)
                .addClass("current");
        var onscreen = sync4.find('.owl-item.active').length - 1;
        var start = sync4.find('.owl-item.active').first().index();
        var end = sync4.find('.owl-item.active').last().index();

        if (current3 > end) {
            sync4.data('owl.carousel').to(current3, 100, true);
        }
        if (current3 < start) {
            sync4.data('owl.carousel').to(current3 - onscreen, 100, true);
        }
    }
    function syncPosition4(el) {
        if (syncedSecondary1) {
            var number = el.item.index;
            sync3.data('owl.carousel').to(number, 100, true);
        }
    }
    sync4.on("click", ".owl-item", function (e) {
        e.preventDefault();
        var number = $(this).index();
        sync3.data('owl.carousel').to(number, 300, true);
    });
    /* ===================================
     END Product Detail Slider
     ====================================== */
    /* ===================================
     START Quantity Box
     ====================================== */
    // Quantity Box
    $(".qty_number").append('<div class="inc button"><span>+</span></div><div class="dec button"><span>-</span></div>');
    $(".button").on("click", function () {
        var $button = $(this);
        var oldValue = $button.parent().find("input").val();
        if (oldValue === "") {
            oldValue = 0;
        }
        if ($button.text() === "+") {
            var newVal = parseFloat(oldValue) + 1;
        } else {
            // Don't allow decrementing below zero
            if (oldValue > 0) {
                var newVal = parseFloat(oldValue) - 1;
            } else {
                newVal = 0;
            }
        }
        $button.parent().find("input").val(newVal);
    });
    /* ===================================
     END Quantity Box
     ====================================== */
    /* ===================================
     START Get the modal
     ====================================== */
    $(".popup_btn").on("click", function () {
        var modal = $(this).data("modal");
        $(modal).show();
        $('body').toggleClass('model_open');
        // product detail slider
        var sync1 = $("#q_sync1");
        var sync2 = $("#q_sync2");
        var syncedSecondary = true;
        var slidesPerPage = 4;

        sync1.owlCarousel({
            items: 1,
            dots: false
        }).on('changed.owl.carousel', syncPosition);
        sync2.on('initialized.owl.carousel', function () {
            sync2.find(".owl-item").eq(0).addClass("current");
        })
                .owlCarousel({
                    items: slidesPerPage,
                    dots: false,
                    margin: 12,
                    nav: true,
                    smartSpeed: 200,
                    mouseDrag: false,
                    touchDrag: false,
                    slideSpeed: 500,
                    slideBy: slidesPerPage,
                    responsiveRefreshRate: 100
                }).on('changed.owl.carousel', syncPosition2);

        function syncPosition(el) {
            var count = el.item.count - 1;
            var current = Math.round(el.item.index - (el.item.count / 2) - .5);
            if (current < 0) {
                current = count;
            }
            if (current > count) {
                current = 0;
            }
            sync2
                    .find(".owl-item")
                    .removeClass("current")
                    .eq(current)
                    .addClass("current");
            var onscreen = sync2.find('.owl-item.active').length - 1;
            var start = sync2.find('.owl-item.active').first().index();
            var end = sync2.find('.owl-item.active').last().index();

            if (current > end) {
                sync2.data('owl.carousel').to(current, 100, true);
            }
            if (current < start) {
                sync2.data('owl.carousel').to(current - onscreen, 100, true);
            }
        }
        function syncPosition2(el) {
            if (syncedSecondary) {
                var number = el.item.index;
                sync1.data('owl.carousel').to(number, 100, true);
            }
        }
        sync2.on("click", ".owl-item", function (e) {
            e.preventDefault();
            var number = $(this).index();
            sync1.data('owl.carousel').to(number, 300, true);
        });
    });
    $('.close_popup').on("click", function () {
        $('.modal').hide();
        $('body').removeClass('model_open');
    });
    $(".modal").on("click", function (e) {
        var className = e.target.className;
        if (className === "modal") {
            $(this).closest(".modal").hide();
            $('body').removeClass('model_open');
        }
    });
    /* ===================================
     END Get the modal
     ====================================== */
    /* ===================================
     START Block
     ====================================== */
    if ($(window).width() <= 1024) {
        $(document).on("click", function (e) {
            var target = e.target;
            if (!$(target).is('.blocks'))
                $(".blocks").removeClass("block_hover");
        });
        $('.blocks').on("click", function (e) {
            e.stopPropagation();
            $('.blocks').removeClass("block_hover");
            $(this).addClass('block_hover');
        });
    }
    /* ===================================
     END Block
     ====================================== */
    /* ===================================
     START Password
     ====================================== */
    $('.enter_password a').on("click", function () {
        $('.store_form').hide();
        $('.enter_password_form').show();
        $(this).hide();
    });
    $('.enter_password_form_close').on("click", function () {
        $('.store_form,.enter_password a').show();
        $('.enter_password_form').hide();
    });
    if ($(window).width() <= 768) {
        $('.comming_soon_section').css('height', $(window).height());
    }
    /* ===================================
     END Password
     ====================================== */
    /* ===================================
     START Revolution  Slider  
     ====================================== */
    // revolution  slider  
    $('#rev_slider_1').show().revolution({
        /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
        gridheight: [600, 350, 300, 250],
        navigation: {
            arrows: {
                enable: false
            },
            bullets: {
                enable: true,
                style: 'hesperiden',
                hide_onleave: false,
                h_align: 'center',
                v_align: 'bottom',
                h_offset: 0,
                v_offset: 20,
                space: 5
            }
        }
    });
    // revolution  slider  
    $('#rev_slider_3').show().revolution({
        gridheight: [701, 350, 300, 250],
        navigation: {
            arrows: {
                enable: false
            },
            bullets: {
                enable: true,
                style: 'hesperiden',
                hide_onleave: false,
                h_align: 'left',
                v_align: 'bottom',
                h_offset: 0,
                v_offset: 20,
                space: 5
            }
        }
    });
    var revapi = jQuery('#rev_slider_2').show().revolution(
            {
                // ...slider settings       
                /* [DESKTOP, LAPTOP, TABLET, SMARTPHONE] */
                gridheight: [703, 350, 300, 250],
                navigation: {
                    arrows: {
                        enable: true
                    },
                    bullets: {
                        enable: false,
                        style: 'hesperiden',
                        hide_onleave: false,
                        h_align: 'left',
                        v_align: 'bottom',
                        h_offset: 0,
                        v_offset: 20,
                        space: 5
                    }
                }
            });
    revapi.on('revolution.slide.onchange', function (e, data) {
        // slider changed
        if ($(".container.arrow_con").length === 0)
        {
            $(".tparrows").wrapAll("<div class='container arrow_con'></div>");
        }
    });
    $('#rev_slider_4').show().revolution({
        sliderType: "carousel",
        sliderLayout: "fullwidth",        
        delay: 9000,
        navigation: {
            keyboardNavigation: "off",
            keyboard_direction: "horizontal",
            mouseScrollNavigation: "off",
            mouseScrollReverse: "default",
            onHoverStop: "off",
            touch: {
                touchenabled: "off"
            }
            ,
            arrows: {
                enable: false                
            },
            tabs: {
                style: "gyges",
                enable: true,
                width: 149,
                height: 98,
                min_width: 149,
                wrapper_padding: 0,
                wrapper_color: "#26292b",
                wrapper_opacity: "1",
                tmp: '<div class="tp-tab-content"> <span class="tp-tab-title">{{title}}</span></div><div class="tp-tab-image"></div>',
                visibleAmount: 5,
                hide_onmobile: false,
                hide_onleave: false,
                hide_delay: 200,
                direction: "horizontal",
                span: true,
                position: "outer-bottom",
                space: 0,
                h_align: "center",
                v_align: "bottom",
                h_offset: 0,
                v_offset: 0
            }
        },
        visibilityLevels: [1240, 1024, 778, 480],
        gridwidth:1920,
        gridheight: 781       
    });
   
            var tpj = jQuery;
            var revapi16;
            tpj(document).ready(function () {
                if (tpj("#rev_slider_16_1").revolution === undefined) {
                    revslider_showDoubleJqueryError("#rev_slider_16_1");
                } else {
                    revapi16 = tpj("#rev_slider_16_1").show().revolution({
                        sliderType: "hero",
                        jsFileLocation: "revolution/js/",
                        sliderLayout: "fullscreen",
                        dottedOverlay: "none",
                        delay: 9000,
                        particles: {startSlide: "first", endSlide: "last", zIndex: "8",
                            particles: {
                                number: {value: 200}, color: {value: "#ffffff"},
                                shape: {
                                    type: "circle", stroke: {width: 0, color: "#ffffff", opacity: 1},
                                    image: {src: ""}
                                },
                                opacity: {value: 1, random: true, min: 0.5, anim: {enable: true, speed: 1, opacity_min: 0, sync: false}},
                                size: {value: 2, random: true, min: 0.5, anim: {enable: true, speed: 10, size_min: 1, sync: false}},
                                line_linked: {enable: false, distance: 150, color: "#ffffff", opacity: 0.4, width: 1},
                                move: {enable: true, speed: 1, direction: "none", random: false, min_speed: 1, straight: true, out_mode: "out"}},
                            interactivity: {
                                events: {onhover: {enable: true, mode: "bubble"}, onclick: {enable: false, mode: "repulse"}},
                                modes: {grab: {distance: 400, line_linked: {opacity: 0.5}}, bubble: {distance: 400, size: 0, opacity: 1}, repulse: {distance: 200}}
                            }
                        },
                        navigation: {
                        },
                         gridheight: [600, 350, 300, 250],
                        lazyType: "none",
                        parallax: {
                            type: "mouse",
                            origo: "slidercenter",
                            speed: 2000,
                            levels: [2, 4, 6, 4, 5, 30, 35, 40, 45, 46, 47, 48, 49, 50, 51, 55]
                        },
                        shadow: 0,
                        spinner: "off",
                        autoHeight: "off",
                        fullScreenAutoWidth: "off",
                        fullScreenAlignForce: "off",
                        fullScreenOffsetContainer: "",
                        fullScreenOffset: "60px",
                        disableProgressBar: "on",
                        hideThumbsOnMobile: "off",
                        hideSliderAtLimit: 0,
                        hideCaptionAtLimit: 0,
                        hideAllCaptionAtLilmit: 0,
                        debugMode: false,
                        fallbacks: {
                            simplifyAll: "off",
                            disableFocusListener: false
                        }
                    });
                }

                RsParticlesAddOn(revapi16);
            });	/*ready*/
        
    /* ===================================
     END Revolution  Slider  
     ====================================== */
    /* ==================================
     START Shoes Slider 
     ====================================== */
    $("#arrival_slider").owlCarousel({
        dots: false,
        loop: true,
        nav: true,
        items: 3,
        margin: 30,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            768: {
                items: 2,
                loop: false
            },
            992: {
                items: 3,
                loop: false
            }
        }
    });
    $("#fur_product_slider").owlCarousel({
        dots: false,
        loop: true,
        nav: true,
        items: 4,
        margin: 0,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            768: {
                items: 2,
                loop: false
            },
            992: {
                items: 4,
                loop: false
            }
        }
    });
    $("#fur_sell_product_slider").owlCarousel({
        dots: false,
        loop: true,
        nav: true,
        items: 3,
        margin: 0,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 1
            },
            768: {
                items: 2,
                loop: false
            },
            992: {
                items: 3,
                loop: false
            }
        }
    });
    /* ==================================
     END Shoes Slider 
     ====================================== */
    /* ==================================
     START Brand logo Slider 
     ====================================== */
    $("#brand_slider").owlCarousel({
        dots: false,
        loop: true,
        nav: true,
        items: 4,
        margin: 30,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            481: {
                items: 2
            },
            768: {
                items: 3,
                loop: false
            },
            992: {
                items: 4,
                loop: false
            }
        }
    });
    $("#fur_blog_slider").owlCarousel({
        nav: true,
        dots: false,
        slideSpeed: 300,
        paginationSpeed: 400,
        singleItem: true,
        items: 1
    });
    /* ==================================
     END  Brand logo Slider 
     ====================================== */
    /* ===================================
     START  wow animation - on scroll
     ====================================== */
    var wow = new WOW({
        boxClass: 'wow',
        animateClass: 'animated',
        offset: 0,
        mobile: false,
        live: true
    });
    $(window).imagesLoaded(function () {
        wow.init();
    });
    /* ===================================
     END  wow animation - on scroll
     ====================================== */
    /* ==================================
     START Load More
     ====================================== */
    $('ul.size li:lt(4),ul.men li:lt(4),ul.color li:lt(4),ul.women li:lt(4)').show();
    $('.loadMore').on("click", function () {
        $(this).parent("div").children("ul").children("li:lt(100)").show();
        $(this).hide();
    });
    /* ==================================
     End Load More
     ====================================== */
    window.onresize = function () {
        /* ===================================
         START  Window Height 
         ====================================== */
        var window_height = $(window).height();
        var headeheight = $('header').outerHeight();
        var footeheight = $('footer').height();
        var sub_total = headeheight + footeheight;
        var total_height = window_height - sub_total;
        $('.main_section').css('min-height', total_height);
        /* ===================================
         START  Window Height 
         ====================================== */
        /* ===================================
         START  Collection Sidebar  Height
         ====================================== */
        var s_title = $('.sidebar_title').outerHeight();
        var s_height = $(window).height();
        var s_total = s_height - s_title;
        $('.filter_content').css('height', s_total - 60);
        if ($(window).width() <= 768) {
            $('.comming_soon_section').css('height', $(window).height());
        }
        /* ===================================
         END  Collection Sidebar  Height
         ====================================== */
    };
    $("#bag_product_slider").owlCarousel({
        dots: false,
        nav: true,
        margin: 30,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            481: {
                items: 1
            },
            678: {
                items: 2
            },
            767: {
                center: true,
                loop: true
            }
        }
    });
    /* ===================================
     START Page Load
     ====================================== */
    function load() {
        $('#preloader').delay(900).fadeOut(500);
    }
    $(window).on('load', load());
    /* ===================================
     END Page Load
     ====================================== */

    /* ===================================
     START Instafeed Type
     ====================================== */
      if ($('#instafeed_type2').length > 0) {
        var fur_userFeed = new Instafeed({
            target: 'instafeed_type2',
            get: 'user',
            tagName: 'furniture',
            userId: '6666610766',
            accessToken: '6666610766.2a7d13b.60b18490cde1420db117dce0dfe65513',
            resolution: 'standard_resolution',
            limit:6,
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}" class="img-fluid"/></a>',
            after: function () {
                var x1 = $('.instafeed_silder_type2').children();
                var i1 = 0;
                for (i1 = 0; i1 < x1.length; i1 += 2) {                    
                    x1.slice(i1, i1 + 2).wrapAll('<div class="col-4"></div>');
                }
            }
        });
        fur_userFeed.run();
    }   
     if ($('#instafeed_type3').length > 0) {
        var fur_userFeed = new Instafeed({
            target: 'instafeed_type3',
            get: 'user',
            tagName: 'furniture',
            userId: '6666610766',
            accessToken: '6666610766.2a7d13b.60b18490cde1420db117dce0dfe65513',
            resolution: 'standard_resolution',
            limit:6,
            template: '<a href="{{link}}" target="_blank"><img src="{{image}}" class="img-fluid"/></a>',
            after: function () {
                var x1 = $('.instafeed_silder_type3').children();
                var i1 = 0;
                for (i1 = 0; i1 < x1.length; i1 += 2) {                    
                    x1.slice(i1, i1 + 2).wrapAll('<div class="col-4"></div>');
                }
            }
        });
        fur_userFeed.run();
    } 
    /* ===================================
     END Instafeed Type
     ====================================== */
    
    /* ===================================
     START Tab 
     ====================================== */
    $("ul.tabs li").click(function () {
        $(this).addClass("active");
        $(this).siblings("ul.tabs li").removeClass("active");
        var activeTab = $(this).attr("rel");
        $("#" + activeTab).addClass("active_content");
        $("#" + activeTab).siblings('.tab_content').removeClass("active_content");
        $(".tab_drawer_heading[rel^='" + activeTab + "']").addClass("d_active");
        $(".tab_drawer_heading[rel^='" + activeTab + "']").siblings(".tab_drawer_heading").removeClass("d_active");
    });
    $(".tab_drawer_heading").on("click", function () {
        $(this).toggleClass("d_active");
        $(this).siblings(".tab_drawer_heading").removeClass("d_active");
        var d_activeTab = $(this).attr("rel");
        $("#" + d_activeTab).toggleClass("active_content");
        $("#" + d_activeTab).siblings('.tab_content').removeClass("active_content");
        $("ul.tabs li").removeClass("active");
        $("ul.tabs li[rel^='" + d_activeTab + "']").addClass("active");
    });
    $(".electronics_tab_slider").owlCarousel({
        dots: true,
        loop: true,
        nav: false,
        items: 4,
        margin: 30,
        responsiveClass: true,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2,
                loop: false
            },
            767: {
                items: 3,
                loop: false                
            },
            1200: {
                items: 4,
                loop: false
            }
        }
    });
    /* ===================================
     END Tab 
     ====================================== */

     /* ===================================
     START countdowntimer Type
     ====================================== */
     $("#watch_countdowntimer").countdowntimer({
                        dateAndTime : "2019/01/01 00:00:00",
                        size : "lg",
                        regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
                        regexpReplaceWith: "<li class='day text-white rounded-circle text-center'><span class='no d-block'>$1</span><span class='text text-capitalize d-block'>days</span></li>\n\
            <li class='hours text-white  rounded-circle  text-center'><span class='no d-block'>$2</span><span class='text text-capitalize d-block'>hours</span></li> \n\
        <li class='min text-white  rounded-circle  text-center'><span class='no d-block'>$3</span><span class='text text-capitalize d-block'>minutes</span></li>\n\
        <li class='second text-white  rounded-circle text-center'><span class='no d-block'>$4</span><span class='text text-capitalize d-block'>seconds</span>"
	}); 
        
        $("#shoes_countdowntimer").countdowntimer({
                        dateAndTime : "2019/01/01 00:00:00",
                        size : "lg",
                        regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
                        regexpReplaceWith: "<li class='day position-relative text-center'><span class='no d-block'>$1</span><span class='text text-capitalize d-block'>days</span></li>\n\
            <li class='hours position-relative text-center '><span class='no d-block'>$2</span><span class='text text-capitalize d-block'>hours</span></li> \n\
        <li class='min position-relative text-center'><span class='no d-block'>$3</span><span class='text text-capitalize d-block'>minutes</span></li>\n\
        <li class='second position-relative text-center'><span class='no d-block'>$4</span><span class='text text-capitalize d-block'>seconds</span>"
	}); 
        
        $("#electronics_countdowntimer").countdowntimer({
                        dateAndTime : "2019/01/01 00:00:00",
                        size : "lg",
                        regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
                        regexpReplaceWith: "<li class='day rounded-circle position-relative text-center'><span class='no d-block'>$1</span><span class='text text-capitalize d-block'>days</span></li>\n\
            <li class='hours position-relative text-center rounded-circle '><span class='no d-block'>$2</span><span class='text text-capitalize d-block'>hours</span></li> \n\
        <li class='min position-relative text-center rounded-circle'><span class='no d-block'>$3</span><span class='text text-capitalize d-block'>minutes</span></li>\n\
        <li class='second position-relative text-center rounded-circle'><span class='no d-block'>$4</span><span class='text text-capitalize d-block'>seconds</span>"
	}); 
        
         $("#beauty_countdowntimer").countdowntimer({
                        dateAndTime : "2019/01/01 00:00:00",
                        size : "lg",
                        regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
                        regexpReplaceWith: "<li class='day'><span class='no d-block'>$1</span><span class='text text-capitalize d-block  text-center'>days</span></li>\n\
            <li class='hours  '><span class='no d-block'>$2</span><span class='text text-capitalize d-block text-center'>hours</span></li> \n\
        <li class='min '><span class='no d-block'>$3</span><span class='text text-capitalize d-block text-center'>minutes</span></li>\n\
        <li class='second '><span class='no d-block'>$4</span><span class='text text-capitalize d-block text-center'>seconds</span>"
	}); 
        
          $("#baby_countdowntimer").countdowntimer({
                        dateAndTime : "2019/01/01 00:00:00",
                        size : "lg",
                        regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
                        regexpReplaceWith: "<li class='day'><span class='no d-block'>$1  :</span><span class='text text-capitalize d-block  text-center'>days</span></li>\n\
            <li class='hours  '><span class='no d-block'>$2 :</span><span class='text  d-block '>hours</span></li> \n\
        <li class='min '><span class='no d-block'>$3 :</span><span class='text d-block'>minutes</span></li>\n\
        <li class='second '><span class='no d-block'>$4 </span><span class='text  d-block '>seconds</span>"
	}); 
         $("#handcraft_countdowntimer").countdowntimer({
                        dateAndTime : "2019/01/01 00:00:00",
                        size : "lg",
                        regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
                        regexpReplaceWith: "<li class='day text-center position-relative'><span class='no d-block'>$1 </span><span class='text text-capitalize d-block  text-center'>days</span></li>\n\
            <li class='hours text-center position-relative '><span class='no d-block'>$2 </span><span class='text text-capitalize d-block '>hours</span></li> \n\
        <li class='min text-center position-relative'><span class='no d-block'>$3 </span><span class='text text-capitalize d-block'>minutes</span></li>\n\
        <li class='second text-center position-relative'><span class='no d-block'>$4 </span><span class='text text-capitalize d-block '>seconds</span>"
	}); 
         $("#furniture_countdowntimer").countdowntimer({
                        dateAndTime : "2019/01/01 00:00:00",
                        size : "lg",
                        regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
                        regexpReplaceWith: "<li class='day text-center rounded-circle position-relative'><span class='no d-block'>$1 </span><span class='text text-capitalize d-block  text-center'>days</span></li>\n\
            <li class='hours text-center position-relative rounded-circle'><span class='no d-block'>$2 </span><span class='text text-capitalize d-block '>hours</span></li> \n\
        <li class='min text-center position-relative rounded-circle'><span class='no d-block'>$3 </span><span class='text text-capitalize d-block'>minutes</span></li>\n\
        <li class='second text-center position-relative rounded-circle'><span class='no d-block'>$4 </span><span class='text text-capitalize d-block '>seconds</span>"
	}); 
        
        $("#offer_countdowntimer").countdowntimer({
                        dateAndTime : "2019/01/01 00:00:00",
                        size : "lg",
                        regexpMatchFormat: "([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2}):([0-9]{1,2})",
                        regexpReplaceWith: "<li class='hours'><span class='no d-block'>$2:</span><span class='text text-capitalize d-block '>Hrs</span></li> \n\
        <li class='min '><span class='no d-block'>$3:</span><span class='text text-capitalize d-block'>Mins</span></li>\n\
        <li class='second '><span class='no d-block'>$4 </span><span class='text text-capitalize d-block '>Secs</span>"
	});
        
        
    /* ===================================
     END countdowntimer Type
     ====================================== */

    /* ===================================
     START rotate3d Type
     ====================================== */
     $('.mixer_3d').rotate3d({
                'source': 'src/3d_images/Mixer/mixer',
                'ext' : '.jpg',
                'count' : 23,
                'speed': 23
              });
              $('.coffee_3d').rotate3d({
                'source': 'src/3d_images/Coffee_machine/coffee',
                'ext' : '.jpg',
                'count' : 15,
                'speed': 15
              });
              $('.camera_3d').rotate3d({
                'source': 'src/3d_images/Camera/camera',
                'ext' : '.jpg',
                'count' : 35,
                'speed': 35
              });
              $('.watch_3d').rotate3d({
                'source': 'src/3d_images/Watch/watch',
                'ext' : '.jpg',
                'count' : 71,
                'speed': 15
              });
              $('.handheld_3d').rotate3d({
                'source': 'src/3d_images/handheld/handheld',
                'ext' : '.jpg',
                'count' : 39,
                'speed': 39
              });
    /* ===================================
     END rotate3d Type
     ====================================== */
    /* ===================================
     START slick 
     ====================================== */
    
    $('.slider-for').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        fade: true,
        draggable:false,
        asNavFor: '.slider-nav'
    });
    $('.slider-nav').slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        asNavFor: '.slider-for',
        dots: false,
        centerMode: true,
        focusOnSelect: true,
        vertical: true,
        verticalSwiping: false,
        infinite: false,
        draggable:false,   
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1  
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 420,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            }
        ]
    });
    /* ===================================
     END slick 
     ====================================== */



})(jQuery);