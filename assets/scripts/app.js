/**
 * Required
 */
 
 //@prepros-prepend vendor/foundation/js/plugins/foundation.core.js

/**
 * Optional Plugins
 * Remove * to enable any plugins you want to use
 */
 
 // What Input
 //@*prepros-prepend vendor/whatinput.js
 
 // Foundation Utilities
 // https://get.foundation/sites/docs/javascript-utilities.html
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.box.min.js
 //@*prepros-prepend vendor/foundation/js/plugins/foundation.util.imageLoader.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.keyboard.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.mediaQuery.min.js
 //@*prepros-prepend vendor/foundation/js/plugins/foundation.util.motion.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.nest.min.js
 //@*prepros-prepend vendor/foundation/js/plugins/foundation.util.timer.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.touch.min.js
 //@prepros-prepend vendor/foundation/js/plugins/foundation.util.triggers.min.js


// JS Form Validation
//@*prepros-prepend vendor/foundation/js/plugins/foundation.abide.js

// Tabs UI
//@*prepros-prepend vendor/foundation/js/plugins/foundation.tabs.js

// Accordian
//@prepros-prepend vendor/foundation/js/plugins/foundation.accordion.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.accordionMenu.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.responsiveAccordionTabs.js

// Menu enhancements
//@prepros-prepend vendor/foundation/js/plugins/foundation.drilldown.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.dropdown.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.dropdownMenu.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.responsiveMenu.js
//@*prepros-prepend vendor/foundation/js/plugins/foundation.responsiveToggle.js

// Equalize heights
//@*prepros-prepend vendor/foundation/js/plugins/foundation.equalizer.js

// Responsive Images
//@*prepros-prepend vendor/foundation/js/plugins/foundation.interchange.js

// Navigation Widget
//@*prepros-prepend vendor/foundation/js/plugins/foundation.magellan.js

// Offcanvas Naviagtion Option
//@prepros-prepend vendor/foundation/js/plugins/foundation.offcanvas.js

// Carousel (don't ever use)
//@*prepros-prepend vendor/foundation/js/plugins/foundation.orbit.js

// Modals
//@*prepros-prepend vendor/foundation/js/plugins/foundation.reveal.js

// Form UI element
//@*prepros-prepend vendor/foundation/js/plugins/foundation.slider.js

// Anchor Link Scrolling
//@prepros-prepend vendor/foundation/js/plugins/foundation.smoothScroll.js

// Sticky Elements
//@prepros-prepend vendor/foundation/js/plugins/foundation.sticky.js

// On/Off UI Switching
//@*prepros-prepend vendor/foundation/js/plugins/foundation.toggler.js

// Tooltips
//@*prepros-prepend vendor/foundation/js/plugins/foundation.tooltip.js

// What Input
//@prepros-prepend vendor/what-input.js

// Swiper
//@prepros-prepend vendor/swiper-bundle.js

// DOM Ready
(function($) {
	'use strict';
    
    var _app = window._app || {};
    
    _app.foundation_init = function() {
        $(document).foundation();
    }
        
    _app.emptyParentLinks = function() {
            
        $('.menu li a[href="#"]').click(function(e) {
            e.preventDefault ? e.preventDefault() : e.returnValue = false;
        });	
        
    };
    
    _app.fixed_nav_hack = function() {
        $('.off-canvas').on('opened.zf.offCanvas', function() {
            $('header.site-header').addClass('off-canvas-content is-open-right has-transition-push');		
            $('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').addClass('clicked');	
        });
        
        $('.off-canvas').on('close.zf.offCanvas', function() {
            $('header.site-header').removeClass('off-canvas-content is-open-right has-transition-push');
            $('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').removeClass('clicked');
        });
        
        $(window).on('resize', function() {
            if ($(window).width() > 1023) {
                $('.off-canvas').foundation('close');
                $('header.site-header').removeClass('off-canvas-content has-transition-push');
                $('header.site-header #top-bar-menu .menu-toggle-wrap a#menu-toggle').removeClass('clicked');
            }
        });    
    }
    
    _app.display_on_load = function() {
        $('.display-on-load').css('visibility', 'visible');
    }
    
    // Custom Functions
    
    _app.mobile_takover_nav = function() {
        $(document).on('click', 'a#menu-toggle', function(){
            
            if ( $(this).hasClass('clicked') ) {
                $(this).removeClass('clicked');
                $('#off-canvas').fadeOut(200);
            
            } else {
            
                $(this).addClass('clicked');
                $('#off-canvas').fadeIn(200);
            
            }
            
        });
    }
    
    _app.banner_slider = function() {
        const bannerSlider = document.querySelector('.page-banner .bg-slider');
        if(bannerSlider) {
            const delay = bannerSlider.getAttribute('data-delay');
            
            function pauseAndRestartAllVideos() {
              var allVideos = document.querySelectorAll('.swiper-slide video');
              allVideos.forEach(function (video) {
                video.pause();
                video.currentTime = 0;
              });
            }
            
            function playVideoInActiveSlide() {
              var activeSlide = document.querySelector('.swiper-slide-active video');
              if (activeSlide) {
                // Show loading animation.
                const playPromise = activeSlide.play();
                
                if (playPromise !== undefined) {
                    playPromise.then(_ => {
                      // Automatic playback started!
                      // Show playing UI.
                    })
                    .catch(error => {
                      // Auto-play was prevented
                      // Show paused UI.
                    });
                }
              }
            }
            
            const swiper = new Swiper('.page-banner .bg-slider', {
                loop: true,
                slidesPerView: 1,
                speed: 500,
                spaceBetween: 0,
                effect: "fade",
                autoplay: {
                    delay: delay + '000',
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
                on: {
                    init: function () {
                      // Play the video in the first slide on initialization
                      playVideoInActiveSlide();
                    },
                
                    // Listen for the transitionStart event
                    transitionStart: function () {
                      // Pause and restart all videos in slides
                      pauseAndRestartAllVideos();
                
                      // Play the video in the active slide
                      playVideoInActiveSlide();
                    }
                  }
            });
    
        }
        
        const heroBanner = document.querySelector('.page-banner.style-hero-slider');
        if(heroBanner) {
            const setHeroBannerMinHeight = function() {
                const headerHeight = document.querySelector('.site-header').offsetHeight;
                const windowHeight = window.innerHeight;
                
                // Calculate the min-height by subtracting headerHeight from windowHeight
                let minHeight = windowHeight - headerHeight;
        
                // Ensure the minHeight does not exceed 790px
                if (minHeight > 790) {
                    minHeight = 790;
                }
        
                // Set the min-height of .style-hero-slider
                heroBanner.style.minHeight = minHeight + 'px';
            }
            setHeroBannerMinHeight();
            window.addEventListener('resize', function() {
                setHeroBannerMinHeight();
            });
        }
        
    }
    
    _app.ctas_slider = function() {
        const ctasSlider = document.querySelector('.home-cta-slider');
        const delay = ctasSlider.getAttribute('data-delay');

        if(ctasSlider) {
            const swiper = new Swiper(ctasSlider, {
                loop: true,
                loopAdditionalSlides: 1,
                slidesPerView: 2,
                speed: 500,
                spaceBetween: 10,
                autoplay: {
                    delay: delay + '000',
                    disableOnInteraction: false,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
            });
        }
    }
    
    _app.cards_slider = function() {
        const cardsSlider = document.querySelector('.cards-slider');
        const delay = cardsSlider.getAttribute('data-delay');
        if(cardsSlider) {
            const swiper = new Swiper(cardsSlider, {
                loop: false,
                slidesPerView: 1,
                speed: 500,
                spaceBetween: 0,
                effect: "cards",
                grabCursor: true,
                cardsEffect: {
                    slideShadows: false,
                    perSlideOffset: 8, // Space between cards in px
                    perSlideRotate: 3, // Rotation of cards in degrees
                },
                // autoplay: {
                //     delay: delay + '000',
                //     disableOnInteraction: false,
                // },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        }
    }
            
    _app.init = function() {
        
        // Standard Functions
        _app.foundation_init();
        _app.emptyParentLinks();
        _app.fixed_nav_hack();
        _app.display_on_load();
        
        // Custom Functions
        //_app.mobile_takover_nav();
        _app.banner_slider();
        _app.ctas_slider();
        _app.cards_slider();
    }
    
    
    // initialize functions on load
    $(function() {
        _app.init();
    });
	
	
})(jQuery);