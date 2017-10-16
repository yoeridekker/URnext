/**
* UBnext theme functions - js
*/

if ( !window.console ) window.console = {};
if ( !window.console.log ) window.console.log = function () { };
if ( !window.onerror ) window.onerror = {};
if ( typeof google === 'undefined' ) var google;
if ( typeof themeVars === 'undefined' ) var themeVars = {};


// init jQuery noConflict - Just to be sure
( function( $jquery, window ) {
    
    "use strict";

    // Localize variables
    themeVars.localize = localize;

    // Breakpoints 
    themeVars.breakPoints = {
        tiny: 480,
        small: 768,
        medium: 992,
        large: 1180
    };

    // Check for touch devices
    themeVars.touch = false;

    // Define constants
    themeVars.contentOffset = 0;
    themeVars.minContentHeight = 0;
    themeVars.windowwidth = 0;
    themeVars.windowheight = 0;
    themeVars.scroll = 0;

    // Animations 
    themeVars.wow = false;
    themeVars.generalAnimationDuration = 400;

    // DOM elements
    themeVars.body = null;
    themeVars.nav = false;
    themeVars.menu = null;

    // WP Adminbar
    themeVars.wpadminbar = false;
    themeVars.adminBarHeight = 0;

    // MegaDropMenu
    themeVars.megaDropMenu = false;
    themeVars.megaDropMenuId = '#megadropmenu #menu-primary-menu';

    // GenieMenu
    themeVars.GenieMenu = false;
    themeVars.GenieSnap = false;
    themeVars.geniePath = null;
    themeVars.genieActiveClass = 'nav-active';
    themeVars.genieSteps = [];
    themeVars.genieStepsTotal = 0;
    themeVars.genieAnimation = 70;

    // Search overlay
    themeVars.searchOverlay = false;
    themeVars.onSearch = false;

    // Banner
    themeVars.banner = false;
    themeVars.bannerheight = 0;
    themeVars.bannerWrapperHeight = 0;

    // Breadcrumbs
    themeVars.breadcrumbs = false;
    themeVars.breadcrumbsHeight = 0;

    // Grid
    themeVars.postGrid = false;
    themeVars.pageNum = 1;
    themeVars.gridWidth = 0;

    // Sidebar
    themeVars.sidebar = false;
    themeVars.sidebarTopCorrection = 80;

    // Init WOW js if animations are enabled
    if( themeVars.localize.animations === '1' && typeof WOW === 'function' ){
        themeVars.wow = new WOW();
        themeVars.wow.init();
    }

    function global_callback(origin){
        //console.clear();
        //console.log(origin);
        //console.log(themeVars);
    }

    // Document ready
    $jquery( document ).on('ready', function(){
        urnext_setDimensions();
        urnext_globalInit();
        urnext_setBlockheight();
        urnext_initGrid();
        urnext_initMainMenu();
    });

    // Window load
    $jquery(window).on('load', function(){
        urnext_setDimensions();
        urnext_initBanner(false);
        urnext_initGallery();

        // Check if we use isotope
        if( themeVars.postGrid && themeVars.localize.gridLayout === '1' && typeof isotope === 'function' ){
            themeVars.postGrid.isotope('layout');
        }

        // Finally, remove the loader
        setTimeout(function(){
            urnext_AfterAnimation();
        }, themeVars.localize.animationDuration );
    });

    // Window resize
    $jquery(window).on('resize', function(){
        urnext_setDimensions();
        urnext_setBlockheight();
        urnext_initBanner(true);
        // Check if we use isotope
        if( themeVars.postGrid && themeVars.localize.gridLayout === '1' && typeof isotope === 'function' ){
            // Re-layout isotope
            themeVars.postGrid.isotope('layout');
        }
    });

    // Window scroll
    $jquery(window).on('scroll', function(){
        themeVars.scroll = $jquery(window).scrollTop();
        var navBreakPoint = themeVars.bannerWrapperHeight - themeVars.breadcrumbsHeight- themeVars.adminBarHeight ;
        if( themeVars.localize.hideHeader === '1' ){
            if( themeVars.scroll >= navBreakPoint ){
                themeVars.nav.fadeOut(100); // Always fast for optimal usage
            }else{
                themeVars.nav.fadeIn(themeVars.generalAnimationDuration);
            }
        }
        if( themeVars.banner && themeVars.localize.hasParallax === '1' ){
            var pos = ( ( ( themeVars.scroll / themeVars.bannerheight ) * 100 ) / 2 ) + 50;
            themeVars.banner.css('background-position-y', pos + '%');
        }
    });

    function urnext_AfterAnimation(){
        urnext_setDimensions();
        urnext_stickySidebar();
        themeVars.body.removeClass('no-overflow');
        $jquery("#siteloader").fadeOut(themeVars.generalAnimationDuration);
        themeVars.scrollToElementHash = window.location.hash;
        if( themeVars.scrollToElementHash !== '' ){
            themeVars.scrollToElement = $jquery( themeVars.scrollToElementHash );
            if( themeVars.scrollToElement.length === 1){
                $jquery("html, body").animate({ scrollTop: themeVars.scrollToElement.offset().top }, 1000);
            }
        }
    }

    function urnext_stickySidebar(){
        if( themeVars.sidebar ){
            themeVars.stickyCorrection = themeVars.localize.hasStickyHeader === '1' ? themeVars.adminBarHeight + themeVars.sidebarTopCorrection + 15 : themeVars.adminBarHeight + 15 ;
            new StickySidebar('#inner-sidebar', { 
                topSpacing: themeVars.stickyCorrection,
                bottomSpacing: 0,
                containerSelector: '.row',
                innerWrapperSelector: '.sidebar__inner',
                resizeSensor: false,
                minWidth: ( themeVars.breakPoints.medium - 1 )
            });
        }
    }

    function urnext_globalInit(){

        // first set the preloader type 
        $jquery('#rotating-plane').addClass('selected');
        // check for touch support
        if ( ('ontouchstart' in window) || window.DocumentTouch && document instanceof DocumentTouch) { 
            // Touch events are supported
            themeVars.touch = true;
            $jquery('body').addClass('touch');
        }

        // Define DOM elements
        themeVars.body      = $jquery('body');
        themeVars.nav       = $jquery('nav#navbar');
        themeVars.menu      = $jquery('#overlay');
        themeVars.GenieMenu = $jquery('#genie-overlay');

        // Define snap 
        if( themeVars.localize.mainMenuType === '2' && typeof Snap === 'function' ){
            themeVars.GenieSnap         = Snap('#genie');
            themeVars.geniePath         = themeVars.GenieSnap.select('path');
            themeVars.genieSteps        = themeVars.GenieMenu.data('steps').split(';');
            themeVars.genieStepsTotal   = themeVars.genieSteps.length;
        }

        // Try to define the sidebar
        if( $jquery('#sidebar').length === 1) themeVars.sidebar = $jquery('#sidebar');

        // Try to define the grid
        if( $jquery('.grid').length === 1) themeVars.postGrid = $jquery('.grid');

        // Define banner
        if( $jquery('#banner').length === 1 ) themeVars.banner = $jquery('#banner');

        // Define breadcrumbs
        if( $jquery('#breadcrumbs').length === 1 ) themeVars.breadcrumbs = $jquery('#breadcrumbs');

        // Define wpadminbar
        if( $jquery('#wpadminbar').length === 1 ) themeVars.wpadminbar = $jquery('#wpadminbar');

        $jquery('#scroll-down').on('click', function(e){
            e.preventDefault();
            urnext_setDimensions();
            var scrollToPos = themeVars.localize.hideHeader === '1' ? ( themeVars.contentOffset - themeVars.breadcrumbsHeight - themeVars.adminBarHeight ) : ( themeVars.contentOffset - themeVars.breadcrumbsHeight - themeVars.adminBarHeight );
            $jquery("html, body").animate({ scrollTop: scrollToPos }, themeVars.localize.animationDuration );
        });

        // Add listeners 
        var loadmorePagination = $jquery('#urnext-loadmore');
        loadmorePagination.on('click', function(e){
            e.preventDefault();
            var request = $jquery(this).data();
            request.paged = themeVars.pageNum;
            $jquery.ajax({
                url: themeVars.localize.ajaxurl,
                type: 'post',
                dataType:'json',
                async: true,
                data:{
                    action: 'more_post_ajax',
                    data: request
                },
                success: function(data){
                    if( themeVars.postGrid && themeVars.localize.gridLayout === '1' ){
                        // Append items
                        themeVars.postGrid.isotope( 'insert', $jquery(data.html) );
                        // Size items
                        urnext_setBlockheight();
                        // Re-laouy items
                        themeVars.postGrid.isotope( 'layout' );
                    }else{
                        themeVars.postGrid.append( data.html );
                    }
                    // Update the paged param 
                    themeVars.pageNum++;
                    // Check if we have more results
                    if( themeVars.pageNum >= data.max_num_pages ){
                        loadmorePagination.remove();
                    }
                }
            })
        });
    }
    
    function urnext_setDimensions(){
        if( themeVars.breadcrumbs ) themeVars.breadcrumbsHeight = themeVars.breadcrumbs.outerHeight();
        if( themeVars.wpadminbar ) themeVars.adminBarHeight = themeVars.wpadminbar.outerHeight();
        themeVars.windowwidth         = $jquery(window).width();
        themeVars.windowheight        = $jquery(window).height();
        themeVars.bannerWrapperHeight = $jquery('#banner-wrapper').height();
        themeVars.contentOffset       = $jquery('#main-content').offset().top;
        themeVars.minContentHeight    = themeVars.windowheight - themeVars.bannerWrapperHeight - themeVars.breadcrumbsHeight;
        //$jquery('body:not(.page-template-template-stretched) #main-content').css('min-height', themeVars.minContentHeight);
    
        // Check if we need to hide the menu
        if( themeVars.windowwidth < themeVars.localize.menuBreakpoint ){
            if( themeVars.nav ) themeVars.nav.addClass('has-mobile-menu');
            if( themeVars.megaDropMenu ) themeVars.megaDropMenu.removeClass('showmenu');
        }else{
            if( themeVars.nav ) themeVars.nav.removeClass('has-mobile-menu');
            if( themeVars.megaDropMenu ) themeVars.megaDropMenu.addClass('showmenu');
        }
    }

    function urnext_setBlockheight(){
        if( themeVars.postGrid && themeVars.localize.gridLayout === '1' ){
            themeVars.gridWidth = themeVars.postGrid.find('.sizer').width();
            themeVars.postGrid.find('.grid-item').each(function(){
                //var gridHeight = $jquery(this).hasClass('full') ? ( themeVars.gridWidth * 2 ) : themeVars.gridWidth ;
                if( themeVars.localize.squareItems === '1' || $jquery(this).hasClass('image') ){
                    $jquery(this).css('min-height', themeVars.gridWidth );
                } 
            });
        }
    }

    function urnext_initGallery(){
        $jquery('#main-content .article-content .gallery').find('br').remove();
        $jquery('#main-content .article-content .gallery').slick({
            infinite: true,
            dots:false,
            arrows: true,
            slidesToScroll: 1,
            adaptiveHeight: false,
        });
        $jquery('.slick-gallery').slick({
            centerMode: true,
            centerPadding: 0,
            slidesToShow: 3,
            infinite: true,
            dots:true,
            arrows: false,
            slidesToScroll: 1,
            responsive: [
                {
                    breakpoint: themeVars.breakPoints.medium,
                    settings: {
                    slidesToShow: 2,
                }
            },
                {
                    breakpoint: themeVars.breakPoints.small,
                    settings: {
                    slidesToShow: 1,
                    }
                }
            ]
        });
    }

    function urnext_initGrid(){
        // Check if we use isotope
        if( themeVars.postGrid && themeVars.localize.gridLayout === '1' ){
            themeVars.postGrid.isotope({
                itemSelector: '.grid-item',
                percentPosition: false,
                layoutMode: 'masonry',
                masonry: {
                    // use element for option
                    columnWidth: '.grid .sizer', 
                }
            });
        }
    }

    function urnext_initBanner( resize ){
        if ( themeVars.windowwidth < themeVars.breakPoints.small ){
            if( themeVars.banner && themeVars.banner.hasClass('has-banner') ) themeVars.banner.addClass('auto-height');
        }else{
            if( themeVars.banner && themeVars.banner.hasClass('has-banner') ) themeVars.banner.removeClass('auto-height');
        }
        // set the banner
        urnext_setBanner();
    }

    function urnext_setBanner(){
        urnext_setDimensions();
        themeVars.bannerheight = themeVars.windowheight - themeVars.adminBarHeight;
        if( themeVars.banner ){
            if( themeVars.localize.fullHeight === '1' ){
                if( !themeVars.banner.hasClass('auto-height') ){
                    themeVars.banner.height(themeVars.bannerheight);
                    return true;
                }
            }
            themeVars.banner.height('auto');
        }
    }

    function nextStep( pos ) {
        pos++;
        if( pos > themeVars.genieStepsTotal - 1 ){
            themeVars.GenieMenu.find("li").each(function(index) {
                $jquery(this).delay( ( themeVars.genieAnimation / 4 ) * index ).fadeIn();
            });
            return;
        }
        themeVars.geniePath.animate({
                'path' : themeVars.genieSteps[pos]
            },
            themeVars.genieAnimation, 
            mina.linear, 
            function() { 
                nextStep(pos);
            } 
        );
    }

    function prevStep( pos ) {
        pos--;
        themeVars.GenieMenu.find("li").hide();
        if( pos < 0 ) return;
        themeVars.geniePath.animate({
                'path' : themeVars.genieSteps[pos] 
            },
            themeVars.genieAnimation,
            mina.linear,
            function() { 
                if( pos === 0 ) themeVars.GenieMenu.removeClass(themeVars.genieActiveClass);
                prevStep(pos);
            }
        );
    }

    function urnext_initMainMenu(){
        if( themeVars.localize.mainMenuType === '1' ) urnext_initMegaDropMenu();
        if( themeVars.localize.mainMenuType === '2' ) urnext_initGenieMenu();
        initMobileMenu();
    }

    function urnext_initGenieMenu(){
        var toggles     = $jquery('.toggler');
        var search      = $jquery('#search-overlay');
        var onSearch    = false;
        toggles.click( function(e) {
            e.preventDefault();
            themeVars.body.toggleClass('no-overflow');
            var toggleTarget = $jquery(this).attr('id');
            if( toggleTarget === 'toggle' ){
                toggles.toggleClass('toggle-active');
                if( onSearch ){
                    search.find('input#urnext-searchinput').focus();
                    search.removeClass(themeVars.genieActiveClass);
                    onSearch = false;
                }else{
                    if( !themeVars.GenieMenu.hasClass(themeVars.genieActiveClass) ){
                        themeVars.GenieMenu.addClass(themeVars.genieActiveClass);
                        var pos = 0;
                        nextStep(pos);
                    }else{
                        var pos = themeVars.genieStepsTotal - 1;
                        prevStep(pos);
                    }
                }
            }
            if( toggleTarget === 'search' ){
                onSearch = true;
                themeVars.GenieMenu.removeClass(themeVars.genieActiveClass);
                search.addClass(themeVars.genieActiveClass);
                search.find('input#urnext-searchinput').focus();
                toggles.addClass('toggle-active');
            }
        });
    }

    function urnext_initMegaDropMenu(){
        themeVars.megaDropMenu      = $jquery(themeVars.megaDropMenuId);
        var megaDropMenuWidth       = themeVars.megaDropMenu.width();
        var megaDropMenuMethod      = themeVars.localize.mainMenuTrigger;
        var megaDropMenuItems       = $jquery( themeVars.megaDropMenuId + ' > li.menu-item-has-children');
        var megaDropMenuItemsLinks  = $jquery( themeVars.megaDropMenuId + ' > li.menu-item-has-children > a');
        var megaDropMenuListener    = megaDropMenuMethod === 'click' ? megaDropMenuItemsLinks : megaDropMenuItems ;

        megaDropMenuListener.on(megaDropMenuMethod, function(e){
            e.preventDefault();
            var menuItem = megaDropMenuMethod === 'click' ? $jquery(this).parent() : $jquery(this);
            if( menuItem.hasClass('expanded') ){
                menuItem.removeClass('expanded');
            }else{
                megaDropMenuItems.removeClass('expanded');
                menuItem.addClass('expanded');
            }
            $jquery('body').off('click').on('click', function(event) { 
                if( !$jquery(event.target).closest(themeVars.megaDropMenuId).length ) {
                    menuItem.removeClass('expanded');
                }
            });
        });
        if( megaDropMenuMethod && megaDropMenuMethod === 'hover' ){
            megaDropMenuItems.on('mouseleave', function() {
                megaDropMenuItems.removeClass('expanded');
            });
        }
    }

    function initMobileMenu(){
        $jquery('nav#meanmenu').meanmenu({
            meanMenuContainer: 'body',
            meanMenuClose: '<i class="lnr lnr-cross"></i>',
            meanMenuCloseSize: "1.6rem",
            meanRevealPosition: "right",
            meanRevealPositionDistance: "15px",
            meanScreenWidth: themeVars.localize.menuBreakpoint,
            meanNavPush: "0",
            meanShowChildren: true,
            meanExpandableChildren: true,
            meanExpand: '<span class="lnr lnr-chevron-down"></span>',
            meanContract: '<span class="lnr lnr-chevron-up"></span>',
            meanRemoveAttrs: true,
            removeElements: "",
            menuClasses: "bg-menu-color menu-text-color"
        });
    }

})(jQuery, window)

function urnext_init_map() {
    if( themeVars.localize.showMap === '1' ){
        var marker,mapZoom = 14,i = 0,defaultLat = 52,defaultLat = 5;
        if( typeof themeVars.localize.mapZoom === 'string' && themeVars.localize.mapZoom !== '0' ) mapZoom = parseInt(themeVars.localize.mapZoom);
        var mapSettings = {
            zoom: mapZoom,
            center: {
                lat: defaultLat,
                lng: defaultLat
            },
            mapTypeId: google.maps.MapTypeId.ROADMAP,
            scrollwheel: false,
        };
        if( themeVars.localize.mapStyle === '1' ){
            mapSettings.styles = [
                {
                    "featureType": "administrative",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": "-100"
                        }
                    ]
                },
                {
                    "featureType": "administrative.province",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "off"
                        }
                    ]
                },
                {
                    "featureType": "landscape",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": 65
                        },
                        {
                            "visibility": "on"
                        }
                    ]
                },
                {
                    "featureType": "poi",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "lightness": "50"
                        },
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": "-100"
                        }
                    ]
                },
                {
                    "featureType": "road.highway",
                    "elementType": "all",
                    "stylers": [
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "road.arterial",
                    "elementType": "all",
                    "stylers": [
                        {
                            "lightness": "30"
                        }
                    ]
                },
                {
                    "featureType": "road.local",
                    "elementType": "all",
                    "stylers": [
                        {
                            "lightness": "40"
                        }
                    ]
                },
                {
                    "featureType": "transit",
                    "elementType": "all",
                    "stylers": [
                        {
                            "saturation": -100
                        },
                        {
                            "visibility": "simplified"
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "geometry",
                    "stylers": [
                        {
                            "hue": "#ffff00"
                        },
                        {
                            "lightness": -25
                        },
                        {
                            "saturation": -97
                        }
                    ]
                },
                {
                    "featureType": "water",
                    "elementType": "labels",
                    "stylers": [
                        {
                            "lightness": -25
                        },
                        {
                            "saturation": -100
                        }
                    ]
                }
            ];
        }
        var map = new google.maps.Map( document.getElementById('contact-map'), mapSettings );
        if( themeVars.localize.locations[0].lat !== '' && themeVars.localize.locations[0].lng !== '' ){ 
            var bounds = new google.maps.LatLngBounds();
            var infowindow = new google.maps.InfoWindow();
            for (i = 0; i < themeVars.localize.locations.length; i++){
                var markerOptions = {
                    position: new google.maps.LatLng(
                        parseFloat(themeVars.localize.locations[i]['lat']),
                        parseFloat(themeVars.localize.locations[i]['lng'])
                    ),
                    map: map
                };
                if( themeVars.localize.locations[i]['icon'] !== '' ) markerOptions.icon = themeVars.localize.locations[i]['icon'];
                var marker = new google.maps.Marker(markerOptions);
                bounds.extend(marker.position);
                if( themeVars.localize.locations[i]['address'] !== '' ){
                    google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent(themeVars.localize.locations[i]['address']);
                            infowindow.open(map, marker);
                        }
                    })(marker, i));
                }
            }
            map.fitBounds(bounds);
        }else{
            map.setZoom(2);
        }
        google.maps.event.addListenerOnce(map, 'bounds_changed', function(event) {
            if ( map.getZoom() > mapZoom ) map.setZoom(mapZoom);
        });
    }
}