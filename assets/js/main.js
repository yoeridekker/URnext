
new WOW().init();

jQuery(window).on('load', function(){
    jQuery("#siteloader").fadeOut(1000);
});

jQuery( document ).ready( function($){
  
    $.scrollify({
        section : ".content-panel",
        scrollbars: true,
        offset:10,
        before:function(i,panels) {
            var ref = panels[i].attr("data-section-name");
            $(".pager .active").removeClass("active");
            $(".pager").find("a[href=\"#" + ref + "\"]").addClass("active");
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
});

function initMenu(){

    
}
/* ---- particles.js config ---- */
function setParticles(){
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