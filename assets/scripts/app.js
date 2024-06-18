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
//@prepros-prepend vendor/foundation/js/plugins/foundation.tabs.js

// Accordian
//@prepros-prepend vendor/foundation/js/plugins/foundation.accordion.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.accordionMenu.js
//@prepros-prepend vendor/foundation/js/plugins/foundation.responsiveAccordionTabs.js

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

// Isotope
//@prepros-prepend vendor/isotope.pkgd.js

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
    _app.isotope_filtering = function() {
          
        var $isotopeFilterLoadMore = document.querySelector('.isotope-filter-loadmore');
    
        if( $isotopeFilterLoadMore ) {
                
                var $container = $('.isotope-filter-loadmore .filter-grid');
                var $postsPer = $isotopeFilterLoadMore.getAttribute('data-postsper');
                //console.log('posts per load:' + $postsPer);
                
                const checkableInputs = document.querySelectorAll('#options input');
                // Add keydown event listener to each input
                checkableInputs.forEach(function(input) {
                    input.addEventListener('keydown', function(event) {
                        // Check if the pressed key is Enter (key code 13)
                        if (event.key === 'Enter' || event.keyCode === 13) {
                            event.preventDefault(); // Prevent form submission
                
                            // Toggle checkbox state
                            if (input.type === 'checkbox') {
                                input.click();
                                input.parentElement.focus();
                            }
                        }
                    });
                });
                
               const facetingBtns = function(filteredItems) {
                    // console.log('Filtering Complete after filter with ' + filteredItems.length + ' items');
                    const filterButtons = document.querySelectorAll('#options input');
               
                    if (filterButtons.length > 0) {
                        const postsShown = filteredItems;
                        let activeTerms = [];
               
                        postsShown.forEach(function(postShown) {
                            if (postShown) {
                                const post = Object.values(postShown);
                                const terms = post[0].getAttribute('data-terms');
                                activeTerms.push(terms.split(' '));
                            }
                        });
               
                        // Flatten the array of arrays into a single array
                        activeTerms = activeTerms.flat();
               
                        filterButtons.forEach(function(btn) {
                           
                            var greatGrandparent = $(btn).parent().parent().parent();
                            var grandparent = $(btn).parent().parent();
                            const taxonomyGroup = $(grandparent).data('group');

                            const btnTerms = btn.getAttribute('data-taxonomy-terms').split(' ');
               
                            const hasMatchingTerm = btnTerms.some(term => activeTerms.includes(term));
                            const wrapper = btn.parentElement.parentElement;
                            var groupSiblings = $(grandparent).siblings(`[data-group="${taxonomyGroup}"]`);
                            if (!hasMatchingTerm) {
                                if (!wrapper.classList.contains('top-level')) {
                                    wrapper.classList.add('hide-btn');
                                    wrapper.querySelector('input').setAttribute('tabindex', '-1');
                                }
                            } else {
                                if(!groupSiblings.hasClass('active')) {
                                    wrapper.classList.remove('hide-btn');
                                    wrapper.querySelector('input').setAttribute('tabindex', '');
                                }
                            }
                        });
                    }
                };
               
                $($container).isotope({
                    itemSelector: '.filter-grid article',
                    layoutMode: 'fitRows',
                    getSortData: {
                        beername: '.beer-name',
                        brewdate: '.brew-date',
                    }
                });
                
                $('.sort-dropdown').on( 'click', 'button', function() {
                    let parentDropdown = $(this).parent().parent();
                    $(parentDropdown).foundation('close');
                    
                    if( $(this).hasClass('active') ) {
                        // do nothing
                    } else {
                        $(this).addClass('active');
                        $(this).attr('disabled','disabled');
                        $(this).parent().siblings().find('button').removeClass('active');
                        /* Get the element name to sort */
                        var sortValue = $(this).attr('data-sort-value');
    
                        /* Get the sorting direction: asc||desc */
                        var direction = $(this).attr('data-sort-direction');
                        /* convert it to a boolean */
                        var isAscending = (direction == 'asc');
                        
                        $container.isotope({ sortBy: sortValue, sortAscending: isAscending });
                        
                        loadMore(initShow);
                    }
                    
                });
               
                // Function to set equal heights for each row
                const setEqualRowHeights = function() {
                    const rows =$isotopeFilterLoadMore.querySelectorAll('.filter-grid.equal-heights > *'); // Assuming each row is a direct child of .filter-grid
                    let maxRowHeight = 0;
               
                    rows.forEach(function(row) {
                        const rowHeight = row.getBoundingClientRect().height;
                        maxRowHeight = Math.max(maxRowHeight, rowHeight);
                    });
               
                    rows.forEach(function(row) {
                        row.style.minHeight = maxRowHeight + 'px';
                    });
                    $container.isotope('layout');
                };
                // Attach the event listener to the window object
                window.addEventListener('resize', setEqualRowHeights);
                
                $container.addClass('init');

                var isAnimating = false;
                var filters = {};
                var comboFilter = "";
                $('#options input').on( 'click', function( event ) {
                    if (isAnimating) return; // Prevent clicks during transition
                    isAnimating = true; 
                    
                    var checkbox = event.target;
                    var $checkbox = $( checkbox );
                    //var group = $checkbox.parents('.option-set').attr('data-group');
                    


                    // Initialize an empty array to store input values
                    var queryParams = [];
                    
                    var greatGrandparent = $(this).parent().parent().parent();
                    var grandparent = $(this).parent().parent();
                    const taxonomyGroup = $(grandparent).data('group');
                    
                    var group = taxonomyGroup;
                    //console.log(group );
                    
                    if( $(grandparent).hasClass('active') ) {
                        $(grandparent).removeClass('active');
                        var groupSiblings = $(grandparent).siblings(`[data-group="${taxonomyGroup}"]`);
                        $(groupSiblings).each(function() {
                            $(this).removeClass('hide-btn');
                        });
                    } else {
                        $(grandparent).addClass('active');
                        var groupSiblings = $(grandparent).siblings(`[data-group="${taxonomyGroup}"]`);

                        $(groupSiblings).each(function() {
                            if(!$(this).hasClass('active')) {
                                $(this).addClass('hide-btn');
                            }
                        });
                    }

                    // Iterate over each checked input within #options
                    $('#options input:checked').each(function() {
                        // Get the name and value of each checked input
                        var name = $(this).attr('name');
                        var value = $(this).val();

                        // Construct query parameter string and push to array
                        queryParams.push(encodeURIComponent(name) + '=' + encodeURIComponent(value));
                    });
                  
                    // Construct the full query string by joining all query parameters with '&'
                    var queryString = queryParams.join('&');
                  
                    // Update the URL with the new query string
                    window.history.replaceState({}, '', window.location.pathname + '?' + queryString);
                   
                    // Reset the flag after the transition is complete
                    setTimeout(function() {
                        isAnimating = false;
                    }, 350);

                    // create array for filter group, if not there yet
                    var filterGroup = filters[ group ];
                        if ( !filterGroup ) {
                        filterGroup = filters[ group ] = [];
                    }
                  // add/remove filter
                  if ( checkbox.checked ) {
                     // add filter
                     filterGroup.push( checkbox.value );
                  } else {
                     // remove filter
                  var index = filterGroup.indexOf( checkbox.value );
                     filterGroup.splice( index, 1 );
                  }
                
                  var comboFilter = getComboFilter();
                    $($container).isotope({
                        filter: comboFilter
                    }).promise().done(function() {
                        // Initialize Isotope and then call facetingBtns directly
                        $container.isotope('layout');
                        facetingBtns($container.data('isotope').filteredItems);

                    });
                    
                });                
                
               //Click matching button if query string match
               // Parse the query string
                var queryString = window.location.search.substring(1);
                var queryParams = queryString.split('&');
                var params = {};
                queryParams.forEach(function(param) {
                    var pair = param.split('=');
                    var name = pair[0];
                    var value = decodeURIComponent(pair[1]);
               
                    // If the parameter name is already in the params object, push the value to an array
                    if (params[name]) {
                        if (!Array.isArray(params[name])) {
                            params[name] = [params[name]];
                        }
                        params[name].push(value);
                    } else {
                        params[name] = value;
                    }
                });
               
                // Check inputs based on query parameters
                for (var key in params) {
                    var values = params[key];
                    if (Array.isArray(values)) {
                        // If the value is an array, iterate over each value and check the corresponding inputs
                        values.forEach(function(value) {
                            checkInput(key, value);
                        });
                    } else {
                        // If the value is not an array, check the corresponding input
                        checkInput(key, values);
                    }
                }
               
                function checkInput(name, value) {
                    var $inputs = $('#options').find('input[name="' + name + '"][value="' + value + '"]');
                    if ($inputs.length > 0) {
                        //$inputs.prop('checked', true);
                        $inputs.click();
                    }
                }                
                
               function getComboFilter() {
                    var combo = [];
                    for ( var prop in filters ) {
                        var group = filters[ prop ];
                        if ( !group.length ) {
                        // no filters in group, carry on
                            continue;
                        }
                        // add first group
                        if ( !combo.length ) {
                            combo = group.slice(0);
                            continue;
                        }
                        // add additional groups
                        var nextCombo = [];
                        // split group into combo: [ A, B ] & [ 1, 2 ] => [ A1, A2, B1, B2 ]
                        for ( var i=0; i < combo.length; i++ ) {
                            for ( var j=0; j < group.length; j++ ) {
                                var item = combo[i] + group[j];
                                nextCombo.push( item );
                            }
                        }
                        combo = nextCombo;
                    }
                    var comboFilter = combo.join(', ');
                        return comboFilter;
                }
    
                
                //****************************
                  // Isotope Load more button
                  //****************************
                  var initShow = parseInt($postsPer); //number of items loaded on init & onclick load more button
                  var counter = initShow; //counter for load more button
                  var iso = $container.data('isotope'); // get Isotope instance
                
                  loadMore(initShow); //execute function onload
                
                  function loadMore(toShow) {
                    $container.find(".hidden").removeClass("hidden");
                    
                    setEqualRowHeights();
                
                    var hiddenElems = iso.filteredItems.slice(toShow, iso.filteredItems.length).map(function(item) {
                      return item.element;
                    });
                    $(hiddenElems).addClass('hidden');
                    $container.isotope('layout');
                
                    //when no more to load, hide show more button
                    if (hiddenElems.length == 0) {
                      jQuery("#load-more").parent().hide();
                    } else {
                      jQuery("#load-more").parent().show();
                    };
                
                  }
                                
                  //when load more button clicked
                  $("#load-more").click(function() {
                    if ($('#filters').data('clicked')) {
                      //when filter button clicked, set initial value for counter
                      counter = initShow;
                      $('#filters').data('clicked', false);
                    } else {
                      counter = counter;
                    };

                    counter = counter + initShow;
                
                    loadMore(counter);
                  });
                
                  //when filter button clicked
                  $('#options').on( 'change', function( event ) {
                      loadMore(initShow);
                  });
                  
        }
    }
    
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
            const slides = bannerSlider.querySelectorAll('.swiper-slide');
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
            
            if( slides.length > 1 ) {
            
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
                
            } else {
                bannerSlider.style.opacity = 1; 
            }
    
        }
        
        const heroBanner = document.querySelector('.page-banner.style-hero-slider');
        if(heroBanner) {
            const setHeroBannerMinHeight = function() {
                const headerHeight = document.querySelector('.site-header').offsetHeight;
                const windowHeight = window.innerHeight;
                
                // Calculate the min-height by subtracting headerHeight from windowHeight
                let minHeight = windowHeight - headerHeight;
        
                // Ensure the minHeight does not exceed 790px
                if (minHeight > 662) {
                    minHeight = 662;
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
    
        if(ctasSlider) {
            const delay = ctasSlider.getAttribute('data-delay');
            const swiper = new Swiper(ctasSlider, {
                loop: true,
                loopAdditionalSlides: 1,
                slidesPerView: 1,
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
                breakpoints: {
                    640: {
                      slidesPerView: 2,
                    }
                }
            });
        }
    }
    
    _app.cards_slider = function() {
        const cardsSlider = document.querySelector('.cards-slider');
        if(cardsSlider) {
            const delay = cardsSlider.getAttribute('data-delay');
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
        //_app.fixed_nav_hack();
        _app.display_on_load();
        
        // Custom Functions
        //_app.mobile_takover_nav();
        _app.isotope_filtering();
        _app.banner_slider();
        _app.ctas_slider();
        _app.cards_slider();
    }
    
    
    // initialize functions on load
    $(function() {
        _app.init();
    });
	
	
})(jQuery);