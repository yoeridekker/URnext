
/**
* UBnext theme functions - js
*/

// Define constants
var scroller,
    contentOffset = 0,
    windowwidth = 0,
    windowheight = 0,
    banner = false,
    bannerheight = 0,
    bannerWrapperHeight = 0,
    scroll,
    nav,
    sidebar = false,
    sidebarTopCorrection = 80,
    wpadminbar = false,
    adminBarHeight = 0,
    breadcrumbs = false,
    breadcrumbsHeight = 0,
    grid = false,
    page = 1;


// init jQuery noConflict - Just to be sure
var $jquery = jQuery.noConflict();

// Init WOW js if animations are enabled
if( localize.animations === '1' ){
    new WOW().init();
}

/**
* UBnext theme functions - setup listeners
*/

// Window load
$jquery(window).on('load', function(){
    urnext_setDimensions();
    urnext_initBanner(false);
    
    $jquery('body').focus();

    // Sidebar scroll 
    if( sidebar ){
        var stickyCorrection = localize.stickyHeader === '1' ? adminBarHeight + sidebarTopCorrection : adminBarHeight + 15;
        $jquery('#inner-sidebar').stick_in_parent({
            //parent: '#main-content',
            offset_top: stickyCorrection
        });
    }

    // Window resize
    $jquery(window).on('resize', function(){
        urnext_setDimensions();
        urnext_setBlockheight();
        urnext_initBanner(true);
        // Check if we use isotope
        if( grid && localize.gridLayout === '1' ){
            grid.isotope('layout');
        }
        $jquery('body:not(.page-template-template-stretched) #main-content').css('min-height', windowheight);
    });

    // Window scroll
    $jquery(window).on('scroll', function(){
        scroll = $jquery(window).scrollTop();

        // Defined in header.php
        var navBreakPoint = bannerWrapperHeight-breadcrumbsHeight-adminBarHeight;
        if( hideHeaderOnScroll ){
            if( scroll >= navBreakPoint ){
                nav.fadeOut(100);
            }else{
                nav.fadeIn(400);
            }
        }

        if( banner && localize.hasParallax === '1' ){
            var pos = ( ( ( scroll / bannerheight ) * 100 ) / 2 ) + 50;
            //var pos = ( ( scroll / bannerheight ) * 100 );
            banner.css('background-position-y', pos + '%');
        }
        
    });

    // Check if we use isotope
    if( grid && localize.gridLayout === '1' ){
        grid.isotope('layout');
    }

    // Finally, remove the loader
    $jquery("#siteloader").fadeOut(500);
});

// Document ready
$jquery( document ).ready( function(){
    urnext_setDimensions();
    urnext_globalInit();
    urnext_initGallery();
    urnext_setBlockheight();
    urnext_initGrid();
    urnext_initMenu();
});

function urnext_globalInit(){

    // Define primary navbar
    nav = $jquery('nav#navbar');

    // Try to define the sidebar
    if( $jquery('#sidebar').length === 1) sidebar = $jquery('#sidebar');

    // Try to define the grid
    if( $jquery('.grid').length === 1) grid = $jquery('.grid');

    // Define banner
    if( $jquery('#banner').length === 1 ) banner = $jquery('#banner');

    // Define breadcrumbs
    if( $jquery('#breadcrumbs').length === 1 ) breadcrumbs = $jquery('#breadcrumbs');

    // Define wpadminbar
    if( $jquery('#wpadminbar').length === 1 ) wpadminbar = $jquery('#wpadminbar');

    $jquery('.add-tooltip').tooltipster({
        side:'bottom',
        content: 'Loading cart...',
        functionBefore: function(instance, helper) {
            var $origin = $jquery(helper.origin);
            // we set a variable so the data is only loaded once via Ajax, not every time the tooltip opens
            if ($origin.data('loaded') !== true) {
                $jquery.get( localize.ajaxurl + '?action=urnext_get_cart_contens', function(data) {

                    // call the 'content' method to update the content of our tooltip with the returned data.
                    // note: this content update will trigger an update animation (see the updateAnimation option)
                    instance.content(data);

                    // to remember that the data has been loaded
                    $origin.data('loaded', true);
                });
            }
        }
    });

    $jquery('#scroll-down').on('click', function(e){
        e.preventDefault();
        urnext_setDimensions();
        var scrollToPos = hideHeaderOnScroll ? ( contentOffset - breadcrumbsHeight - adminBarHeight ) : ( contentOffset - breadcrumbsHeight - adminBarHeight - 80 );
        $jquery("html, body").animate({ scrollTop: scrollToPos }, 1000);
    });

    // Add listeners 
    var loadmorePagination = $jquery('#urnext-loadmore');
    loadmorePagination.on('click', function(e){
        e.preventDefault();
        var request = $jquery(this).data();
        request.paged = page;
        $jquery.ajax({
            url: localize.ajaxurl,
            type: 'post',
            dataType:'json',
            async: true,
            data:{
                action: 'more_post_ajax',
                data: request
            },
            success: function(data){
                if( grid && localize.gridLayout === '1' ){
                    // Append items
                    grid.isotope( 'insert', $jquery(data.html) );
                    // Size items
                    urnext_setBlockheight();
                    // Re-laouy items
                    grid.isotope( 'layout' );
                }else{
                    grid.append( data.html );
                }
                // Update the paged param 
                page++;
                // Check if we have more results
                if( page >= data.max_num_pages ){
                    loadmorePagination.remove();
                }
            }
        })
    });
}

function urnext_setDimensions(){
    if( breadcrumbs ) breadcrumbsHeight = breadcrumbs.outerHeight();
    if( wpadminbar ) adminBarHeight = wpadminbar.outerHeight();
    windowwidth = $jquery(window).width();
    windowheight = $jquery(window).height();
    bannerWrapperHeight = $jquery('#banner-wrapper').height();
    contentOffset = $jquery('#main-content').offset().top;
}

function urnext_setBlockheight(){
    if( grid && localize.gridLayout === '1' ){
        var gridWidth = grid.find('.sizer').width();
        grid.find('.grid-item').each(function(){
            //var gridHeight = $jquery(this).hasClass('full') ? ( gridWidth * 2 ) : gridWidth ;
            if( localize.squareItems === '1' || $jquery(this).hasClass('image') ){
                $jquery(this).css('min-height', gridWidth );
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
        adaptiveHeight: true,
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
                breakpoint: 1024,
                settings: {
                slidesToShow: 2,
            }
        },
            {
                breakpoint: 768,
                settings: {
                slidesToShow: 1,
                }
            }
        ]
    });
}

function urnext_initGrid(){
    // Check if we use isotope
    if( grid && localize.gridLayout === '1' ){
        grid.isotope({
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
    if ( windowwidth < 768 ){
        if( banner && banner.hasClass('has-banner') ) banner.addClass('auto-height');
    }else{
        if( banner && banner.hasClass('has-banner') ) banner.removeClass('auto-height');
    }
    // set the banner
    urnext_setBanner();
}

function urnext_setBanner(){
    urnext_setDimensions();
    bannerheight = windowheight - adminBarHeight;
    if( banner ){
        if( localize.fullHeight === '1' ){
            if( banner.hasClass('auto-height') ){
                banner.height('auto');
            }else{
                banner.height(bannerheight);
            }
        }else{
            banner.height('auto');
        }
    }
}

function urnext_initMenu(){
    var toggles     = $jquery('.toggler');
    var menu        = $jquery('#overlay');
    var search      = $jquery('#search-overlay');
    var activeClass = 'nav-active';
    var body        = $jquery('body');
    var onSearch    = false;

    toggles.click( function(e) {

        e.preventDefault();
        body.toggleClass('no-overflow');
        var toggleTarget = $jquery(this).attr('id');
        
        if( toggleTarget === 'toggle' ){
            toggles.toggleClass('toggle-active');
            if( onSearch ){
                search.find('input#urnext-searchinput').focus();
                search.removeClass(activeClass);
                onSearch = false;
            }else{
                menu.toggleClass(activeClass);
                menu.find("li").each(function(i) {
                    if( menu.hasClass(activeClass) ){
                        $jquery(this).delay(50*i).fadeIn();
                    }else{
                        $jquery(this).delay(20*i).fadeOut();
                    }
                });
            }
        }
         
        if( toggleTarget === 'search' ){
            onSearch = true;
            menu.removeClass(activeClass);
            search.addClass(activeClass);
            search.find('input#urnext-searchinput').focus();
            toggles.addClass('toggle-active');
        }
    });
}