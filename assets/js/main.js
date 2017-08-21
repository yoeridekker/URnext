
new WOW().init();

var blockheight, windowwidth, windowheight, scroll, nav;


function setWindowwidth(){
  windowwidth = jQuery(window).width();
}

function setWindowheight(){
  windowheight = jQuery(window).height();
}

function setBlockheight(){
  setWindowwidth();
  setWindowheight();
  jQuery('div.grid div.grid-item').each(function(){
    var gridWidth = jQuery(this).width();
    var gridHeight = jQuery(this).hasClass('full') ? ( gridWidth / 2 ) : gridWidth ;
      jQuery(this).height( gridHeight );
  });
}

jQuery(window).on('resize', function(){
  setBlockheight();
});

jQuery(window).on('load', function(){
    jQuery("#siteloader").fadeOut(1000);
});

jQuery(window).on('scroll', function(){
  scroll = jQuery(window).scrollTop();
});


jQuery( document ).ready( function($){
  nav = jQuery('nav#navbar');
  setBlockheight();
  $('.grid').isotope({
    itemSelector: '.grid-item',
    percentPosition: true,
    layoutMode: 'masonry',
    masonry: {
      // use element for option
      columnWidth: '.sizer'
    }
  });

  

    $.scrollify({
        section : ".content-panel",
        scrollbars: true,
        offset:10,
        interstitialSection: 'div.auto-height',
        before:function(i,panels) {
            var ref = panels[i].attr("data-section-name");
            $(".pager .active").removeClass("active");
            $(".pager").find("a[href=\"#" + ref + "\"]").addClass("active");
        },
        after: function( i,panels ){
          if( i > 0 ){
            nav.fadeOut();
          }else{
            nav.fadeIn();
          }
        },
        afterRender:function() {
            
            var pager = "<ul class=\"pager\">";
            var activeClass = "";
            $(".content-panel").each(function(i) {
                activeClass = "";
                if(i===0) {
                    activeClass = "active";
                }
                pager += "<li><a class=\"text-color " + activeClass + "\" href=\"#" + $(this).attr("data-section-name") + "\"></a></li>";
            });
            pager += "</ul>";
            $(".home").append(pager);

            $(".pager a").on("click",$.scrollify.move);
            setParticles();
        }
    });
    
    $('#toggle').click(function() {
        $(this).toggleClass('toggle-active');
        $('#overlay').toggleClass('nav-active');

        $("#overlay li").each(function(i) {
            if( $('#overlay').hasClass('nav-active') ){
                $(this).delay(100*i).fadeIn();
            }else{
                $(this).delay(50*i).fadeOut();
            }
            
        });
    });

    $('a#search').click( function(e) {
      e.preventDefault();
      $(this).toggleClass('toggle-active');
      $('#search-overlay').toggleClass('nav-active');
  });
});

function initMenu(){

    
}
/* ---- particles.js config ---- */
function setParticles(){
    // check if a paricles container is set 
    if( jQuery('#particles-js').length === 0 ){
      return false;
    }
particlesJS("particles-js", {
    "particles": {
      "number": {
        "value": 80,
        "density": {
          "enable": true,
          "value_area": 800
        }
      },
      "color": {
        "value": "#ffffff"
      },
      "shape": {
        "type": "circle",
        "stroke": {
          "width": 0,
          "color": "#000000"
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
        "color": "#ffffff",
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