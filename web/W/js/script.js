(function($) {
    'use strict'

    /* Mobile Menu */
    var app = {
        dropdown: function() {
            $('.drop-nav-arrow').on('click', function() {
                if (!$(this).parent().hasClass('open')) {
                    $(this).parent().addClass('open');
                    $(this).parent().find('> .drop-nav').slideDown();
                } else {
                    $(this).parent().removeClass('open');
                    $(this).parent().find('> .drop-nav').slideUp();
                }
            });
        }
    }

    $(document).ready(function() {
        $('.language-menu .current-lang').on('click', function() {
            $('.language-menu').toggleClass('active');
            $('.language-menu ul').toggle();
        });

        $('.search-part > a').on('click', function() {
            $('.search-part').toggleClass('active');
            $('.search-part .search-box').slideToggle();
            return false;
        });

        $('.scroll').on('click', function() {
            $("html, body").animate({
                scrollTop: $('#reach-to').offset().top
            }, 2000);
            return false;
        });

        $(".menu-icon a").on('click', function(e) {
            if ($(this).hasClass('open')) {
                $(this).removeClass('open');
                $('.menu-main').removeClass('open');
            } else {
                $(this).addClass('open');
                $('.menu-main').addClass('open');
            }
            return false;
        });

        $('.menu-icon a').on('click', function() {
            $('body').toggleClass('hidden-body');
        });

        $('.icon-find').on('click', function() {
            $('.location-footer-map').addClass('location-open');
            return false;
        });

        $('.icon-find-location').on('click', function() {
            $('.location-footer-map').removeClass('location-open');
            return false;
        });

        $('.date-pick').datepicker()
    });

    $(window).on('load', function() {
        initComponents();

        $('.menu-main ul li').each(function() {
            if ($(this).find('.drop-nav').length) {
                $(this).append('<span class="drop-nav-arrow"><i class="fa fa-angle-down"></i></span>')
            }
        });
        app.dropdown();

        equalheight('.equal-inset');
        equalheight('.chef-blog');
        equalheight('.menu-sector-list');
        equalheight('.shop-main-list');
        equalheight('.chef-member');

        headerFix();

        $('#pre-loader').delay(1000).fadeOut();

    });

    $(window).on('resize', function() {
        initComponents();
        equalheight('.equal-inset');
        equalheight('.chef-blog');
        equalheight('.menu-sector-list');
        equalheight('.shop-main-list');
        equalheight('.chef-member');
    });

    $('.top-arrow').on('click', function() {
        $("html, body").animate({ scrollTop: 0 }, 600);
        return false;
    });

    $(window).on('scroll', function() {
        headerFix();

        if ($(this).scrollTop() > 500) {
            $('.top-arrow').fadeIn();
        } else {
            $('.top-arrow').fadeOut();
        }
        return false;
    });

    function initComponents() {
        initBg();
    }

    function initBg() {
        $('.banner-bg').each(function() {
            var background = $(this).data('background');
            $(this).css('background-image', 'url("' + background + '")');
        });
    }

})(jQuery);


$(document).on('ready', function() {

    // Check map is available
    if ($('.map-outer').length > 0) {
        $('#map').height($(window).height());
    } else {
        $('#map').height('600px');
    }

    // Initialize google map
    var map;

    function initialize() {
        // Set google map property
        var myCenter = new google.maps.LatLng(40.7127837, -74.00594130000002);
        var mapProp = {
            center: myCenter,
            zoom: 11,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [{ "featureType": "administrative.locality", "elementType": "labels", "stylers": [{ "visibility": "on" }] }, { "featureType": "administrative.locality", "elementType": "labels.text.fill", "stylers": [{ "color": "#000000" }, { "visibility": "on" }] }, { "featureType": "administrative.locality", "elementType": "labels.text.stroke", "stylers": [{ "visibility": "on" }, { "color": "#ffffff" }, { "weight": "0.75" }] }, { "featureType": "landscape.natural", "elementType": "geometry.fill", "stylers": [{ "visibility": "on" }, { "color": "#ded7c6" }] }, { "featureType": "poi", "elementType": "geometry.fill", "stylers": [{ "visibility": "on" }, { "color": "#ded7c6" }] }, { "featureType": "road", "elementType": "geometry", "stylers": [{ "lightness": 100 }, { "visibility": "simplified" }] }, { "featureType": "road", "elementType": "labels", "stylers": [{ "visibility": "off" }] }, { "featureType": "transit.line", "elementType": "geometry", "stylers": [{ "visibility": "on" }, { "lightness": 700 }] }, { "featureType": "water", "elementType": "all", "stylers": [{ "color": "#c3a866" }] }, { "featureType": "water", "elementType": "labels", "stylers": [{ "visibility": "off" }] }]
        };
        var map = new google.maps.Map(document.getElementById("map"), mapProp);

        // Set google map marker
        var marker = new google.maps.Marker({
            position: myCenter,
            icon: 'images/map_marker.png'
        });
        marker.setMap(map);

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            map.setOptions({ 'draggable': false });
        }
    }
    // Check google map ID is available or not
    if (document.getElementById('map') != null) {
        google.maps.event.addDomListener(window, 'load', initialize);
    }

    // Check map is available
    if ($('.footer-map-outer').length > 0) {
        $('#footer-map').height('445px');
    }

    if ($('.footer-map-outer1').length > 0) {
        $('#footer-map').height('300px');
    }

    if ($('.footer-map-outer2').length > 0) {
        $('#footer-map').height('334px');
    }

    // Initialize Footer google map
    var map;

    function footer_map_initialize() {
        // Set google map property
        var myCenter = new google.maps.LatLng(40.7127837, -74.00594130000002);
        var mapProp = {
            center: myCenter,
            zoom: 11,
            scrollwheel: false,
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            styles: [{ "featureType": "administrative", "elementType": "labels.text.fill", "stylers": [{ "color": "#444444" }] }, { "featureType": "landscape", "elementType": "all", "stylers": [{ "color": "#f2f2f2" }] }, { "featureType": "poi", "elementType": "all", "stylers": [{ "visibility": "off" }] }, { "featureType": "road", "elementType": "all", "stylers": [{ "saturation": -100 }, { "lightness": 45 }] }, { "featureType": "road.highway", "elementType": "all", "stylers": [{ "visibility": "simplified" }] }, { "featureType": "road.arterial", "elementType": "labels.icon", "stylers": [{ "visibility": "off" }] }, { "featureType": "transit", "elementType": "all", "stylers": [{ "visibility": "off" }] }, { "featureType": "water", "elementType": "all", "stylers": [{ "color": "#46bcec" }, { "visibility": "on" }] }]
        };
        var map = new google.maps.Map(document.getElementById("footer-map"), mapProp);

        // Set google map marker
        var marker = new google.maps.Marker({
            position: myCenter,
            icon: 'images/map_marker.png'
        });
        marker.setMap(map);

        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            map.setOptions({ 'draggable': false });
        }
    }

    if (document.getElementById('footer-map') != null) {
        google.maps.event.addDomListener(window, 'load', footer_map_initialize);
    }

    $('.icon-find').on('click', footer_map_initialize);

    // Send mail to company
    $(".alert-container").hide();
    $("form[name='contact-form']").on('submit', function(e) {
        e.preventDefault();
        var url = "functions.php"; // the script where you handle the form input.
        var thisForm = $(this);
        var btnValue = $(this).find(".send_message").attr('value');
        $(this).find(".send_message").attr('value', 'SUBMITTING...');
        $(this).find(".send_message").attr('disabled', 'disabled');
        $.ajax({
            type: "POST",
            url: url,
            data: thisForm.serialize(), // serializes the form's elements.
            success: function(data) {
                // show response from the php script.
                $(".alert-container").html(data);
                $(".alert-container").show();
                thisForm.trigger("reset");
                thisForm.find(".send_message").attr('value', btnValue);
                thisForm.find(".send_message").removeAttr('disabled');
                $(".alert .close").on('click', function() {
                    $(".alert-container").hide();
                });
            }
        });
        return false; // avoid to execute the actual submit of the form.
    });

});

function headerFix() {

    var window_height = $(window).height(),
        document_height = $(document).height(),
        topPos = $(document).scrollTop(),
        header_height = $('header-part').height();

    if (topPos > header_height) {
        if ((window_height < document_height) && $('.header-part').hasClass('sticky')) {
            $('.header-part').addClass('sticky-fixed');
        }
    } else {
        $('.header-part').removeClass('sticky-fixed');
    }
}

/* Equal height div for dynamic generated by js */

equalheight = function(container) {

    var currentTallest = 0,
        currentRowStart = 0,
        rowDivs = new Array(),
        $el,
        topPosition = 0;
    $(container).each(function() {

        $el = $(this);
        $($el).height('auto')
        topPostion = $el.position().top;

        if (currentRowStart != topPostion) {
            for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
                rowDivs[currentDiv].height(currentTallest);
            }
            rowDivs.length = 0; // empty the array
            currentRowStart = topPostion;
            currentTallest = $el.height();
            rowDivs.push($el);
        } else {
            rowDivs.push($el);
            currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);
        }
        for (currentDiv = 0; currentDiv < rowDivs.length; currentDiv++) {
            rowDivs[currentDiv].height(currentTallest);
        }
    });
}