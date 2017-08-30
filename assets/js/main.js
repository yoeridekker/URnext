
/**
 * UBnext theme functions - js
 */

// Define constants
var 
  scroller,
  windowwidth,
  windowheight,
  scroll,
  nav,
  particlesColor = '#fff';

// Init WOW js
new WOW().init();

// init jQuery noConflict - Just to be sure
var $jquery = jQuery.noConflict();

/**
 * UBnext theme functions - setup listeners
 */

// Window resize
$jquery(window).on('resize', function(){
  setBlockheight();
  initScrollPanels(true);
});

// Window load
$jquery(window).on('load', function(){
    initScrollPanels(false);
    $jquery('body').focus();
});

// Window scroll
$jquery(window).on('scroll', function(){
  scroll = $jquery(window).scrollTop();
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
}

function setWindowwidth(){
  windowwidth = $jquery(window).width();
}

function setWindowheight(){
  windowheight = $jquery(window).height();
}

function setBlockheight(){
  setWindowwidth();
  setWindowheight();
  $jquery('div.grid div.grid-item').each(function(){
    var gridWidth = $jquery(this).width();
    var gridHeight = $jquery(this).hasClass('full') ? ( gridWidth / 2 ) : gridWidth ;
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
      columnWidth: '.sizer'
    }
  });
}

function initScrollPanels( resize ){
  
  if ( windowwidth < 768 ){
    $jquery('div.content-panel.has-banner').addClass('auto-height');
  }else{
    $jquery('div.content-panel.has-banner').removeClass('auto-height');
  }
  
  if( resize ){
    $jquery.scrollify.destroy();
    setScrollPanels();
    return true;
  }
  
  // Set the scroll panels
  setScrollPanels();
}

function setScrollPanels(){
  nav = $jquery('nav#navbar');
  scroller = $jquery.scrollify({
    section : ".content-panel",
    scrollbars: true,
    offset:0,
    scrollSpeed: 500,
    interstitialSection: 'div.auto-height',
    before:function(i,panels) {
        var ref = panels[i].attr("data-section-name");
        $jquery(".pager .active").removeClass("active");
        $jquery(".pager").find("a[href=\"#" + ref + "\"]").addClass("active");
    },
    after: function( i,panels ){
      //console.log( panels.length );
      if( hideHeaderOnScroll ){
        if( i > 0 ){
          nav.fadeOut();
        }else{
          nav.fadeIn();
        }
      }
    },
    afterRender:function() {
        
      var pager = "<ul class=\"pager\">";
      var activeClass = "";
      $jquery(".content-panel").each(function(i) {
          activeClass = "";
          if(i===0) {
              activeClass = "active";
          }
          pager += "<li><a class=\"text-color " + activeClass + "\" href=\"#" + $jquery(this).attr("data-section-name") + "\"></a></li>";
      });
      pager += "</ul>";
      $jquery(".home").append(pager);

      $jquery(".pager a").on("click",$jquery.scrollify.move);
      setParticles();
      $jquery("#siteloader").fadeOut(1000);
    }
  });
}

function initMenu(){
  var toggles     = $jquery('.toggler');
  var menu        = $jquery('#overlay');
  var search      = $jquery('#search-overlay');
  var activeClass = 'nav-active';
  var onSearch    = false;

  toggles.click( function(e) {
    e.preventDefault();
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
            $jquery(this).delay(100*i).fadeIn();
          }else{
            $jquery(this).delay(50*i).fadeOut();
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