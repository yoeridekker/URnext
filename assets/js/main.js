
/**
* UBnext theme functions - js
*/

// Define constants
var scroller,
    contentOffset,
    windowwidth = 0,
    windowheight = 0,
    banner = false,
    bannerheight = 0,
    scroll,
    nav,
    particlesColor = '#fff';


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
    initBanner(false);
    contentOffset = $jquery('div#main-content').offset().top;
    $jquery('body').focus();

    // Window resize
    $jquery(window).on('resize', function(){
        setBlockheight();
        initBanner(true);
        contentOffset = $jquery('div#main-content').offset().top;
        $jquery('div#main-content').css('min-height', windowheight);
    });

    // Window scroll
    $jquery(window).on('scroll', function(){
        scroll = $jquery(window).scrollTop();

        // Defined in header.php
        if( hideHeaderOnScroll ){
            if( scroll >= ( contentOffset - 100 ) ){
                nav.fadeOut(100);
            }else{
                nav.fadeIn(400);
            }
        }

        if( banner && localize.parallax === '1' ){
            banner.css('background-position', 'center ' + ((scroll)) + 'px');
        }
        
    });
    // Finally, remove the loader
    $jquery("#siteloader").fadeOut(500);
});

// Document ready
$jquery( document ).ready( function(){
    globalInit();
    initGallery();
    setBlockheight();
    initGrid();
    initMenu();
});

function globalInit(){

    // Define primary navbar
    nav = $jquery('nav#navbar');

    if( $jquery('#banner').length === 1 ){
        banner = $jquery('#banner');
    }
    contentOffset = $jquery('div#main-content').offset().top;
  
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
        $jquery("html, body").animate({ scrollTop: contentOffset }, 1000);
    });

    $jquery(".textadjust").fitText(
        2, 
        { 
            minFontSize: '17px',
            maxFontSize: '20px'
        }
    );
    $jquery(".headadjust").fitText(
        2,
        { 
            minFontSize: '22px',
            maxFontSize: '60px'
        }
    );
    $jquery(".tinytextadjust").fitText(
        3,
        { 
            minFontSize: '13px',
            maxFontSize: '16px'
        }
    );
}

function setWindowwidth(){
    windowwidth = $jquery(window).width();
}

function setWindowheight(){
    windowheight = $jquery(window).height();
}

var smallest = 999999999;
function setBlockheight(){
    setWindowwidth();
    setWindowheight();

    var gridWidth = $jquery('div.grid div.sizer').width();
    if( gridWidth < smallest ){
        smallest = gridWidth;
    }
    $jquery('div.grid div.grid-item').each(function(){
        //var gridWidth = $jquery(this).innerWidth();
        //var gridOuterWidth = $jquery(this).outerWidth();
        //console.log(gridWidth,gridOuterWidth);
        var gridHeight = $jquery(this).hasClass('full') ? ( gridWidth * 2 ) : gridWidth ;
        //var gridHeight = gridWidth;
        $jquery(this).height( gridHeight );
    });
}

function initGallery(){
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

function initGrid(){
  $jquery('.grid').isotope({
    itemSelector: '.grid-item',
    percentPosition: true,
    layoutMode: 'masonry',
    masonry: {
      // use element for option
      columnWidth: '.sizer', 
    }
  });
}

function initBanner( resize ){
    if ( windowwidth < 768 ){
        if( banner && banner.hasClass('has-banner') ) banner.addClass('auto-height');
    }else{
        if( banner && banner.hasClass('has-banner') ) banner.removeClass('auto-height');
    }
    // set the banner
    setBanner();
}

function setBanner(){
  
    setParticles();

    var adminBarHeight = 0;
    if( $jquery('#wpadminbar').length === 1 ){
        adminBarHeight = $jquery('#wpadminbar').outerHeight();
    }

    var breadcrumbsHeight = 0;
    if( $jquery('div#breadcrumbs').length === 1 ){
        breadcrumbsHeight = $jquery('div#breadcrumbs').outerHeight();
    }

    bannerheight = windowheight - adminBarHeight - breadcrumbsHeight;

    if( banner ){
        if( banner.hasClass('auto-height') ){
            banner.height('auto');
        }else{
            banner.height(bannerheight);
        }
    }
    
}

function initMenu(){
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
      toggles.addClass('toggle-active');
    }
  });
}

/* ---- particles.js config ---- */
function setParticles(){
  
  // check if a paricles container is set 
  if( $jquery('#particles-js').length === 0 ) return false;
  particlesJS(
    "particles-js", {
      "particles": {
        "number": {
          "value": 80,
          "density": {
            "enable": true,
            "value_area": 800
          }
        },
        "color": {
          "value": particlesColor
        },
        "shape": {
          "type": "circle",
          "stroke": {
            "width": 0,
            "color": particlesColor
          },
          "polygon": {
            "nb_sides": 5
          },
          "image": {
            "src": "img/github.svg",
            "width": 100,
            "height": 100
          }
        },
        "opacity": {
          "value": 0.5,
          "random": false,
          "anim": {
            "enable": false,
            "speed": 1,
            "opacity_min": 0.1,
            "sync": false
          }
        },
        "size": {
          "value": 3,
          "random": true,
          "anim": {
            "enable": false,
            "speed": 40,
            "size_min": 0.1,
            "sync": false
          }
        },
        "line_linked": {
          "enable": true,
          "distance": 150,
          "color": particlesColor,
          "opacity": 0.4,
          "width": 1
        },
        "move": {
          "enable": true,
          "speed": 6,
          "direction": "none",
          "random": false,
          "straight": false,
          "out_mode": "out",
          "bounce": false,
          "attract": {
            "enable": false,
            "rotateX": 600,
            "rotateY": 1200
          }
        }
      },
      "interactivity": {
        "detect_on": "canvas",
        "events": {
          "onhover": {
            "enable": true,
            "mode": "repulse"
          },
          "onclick": {
            "enable": true,
            "mode": "push"
          },
          "resize": true
        },
        "modes": {
          "grab": {
            "distance": 400,
            "line_linked": {
              "opacity": 1
            }
          },
          "bubble": {
            "distance": 400,
            "size": 40,
            "duration": 2,
            "opacity": 8,
            "speed": 3
          },
          "repulse": {
            "distance": 200,
            "duration": 0.4
          },
          "push": {
            "particles_nb": 4
          },
          "remove": {
            "particles_nb": 2
          }
        }
      },
      "retina_detect": true
  });
}