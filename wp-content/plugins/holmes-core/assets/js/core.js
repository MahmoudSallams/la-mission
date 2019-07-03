(function($) {
    'use strict';

    var portfolio = {};
    mkdf.modules.portfolio = portfolio;
	
    portfolio.mkdfOnWindowLoad = mkdfOnWindowLoad;
	
    $(window).load(mkdfOnWindowLoad);
	
	/*
	 All functions to be called on $(window).load() should be in this function
	 */
	function mkdfOnWindowLoad() {
		mkdfPortfolioSingleFollow().init();
        initPortfolioNavigation();
	}
	
	var mkdfPortfolioSingleFollow = function () {
		var info = $('.mkdf-follow-portfolio-info .mkdf-portfolio-single-holder .mkdf-ps-info-sticky-holder');
		
		if (info.length) {
			var infoHolder = info.parent(),
				infoHolderOffset = infoHolder.offset().top,
				infoHolderHeight = infoHolder.height(),
				mediaHolder = $('.mkdf-ps-image-holder'),
				mediaHolderHeight = mediaHolder.height(),
				header = $('.header-appear, .mkdf-fixed-wrapper'),
				headerHeight = (header.length) ? header.height() : 0,
				constant = 30; //30 to prevent mispositioned
		}
		
		var infoHolderPosition = function () {
			if (info.length && mediaHolderHeight >= infoHolderHeight) {
				if (mkdf.scroll >= infoHolderOffset - headerHeight - mkdfGlobalVars.vars.mkdfAddForAdminBar - constant) {
					var marginTop = mkdf.scroll - infoHolderOffset + mkdfGlobalVars.vars.mkdfAddForAdminBar + headerHeight + constant;
					// if scroll is initially positioned below mediaHolderHeight
					if (marginTop + infoHolderHeight > mediaHolderHeight) {
						marginTop = mediaHolderHeight - infoHolderHeight + constant;
					}
					info.stop().animate({
						marginTop: marginTop
					});
				}
			}
		};
		
		var recalculateInfoHolderPosition = function () {
			if (info.length && mediaHolderHeight >= infoHolderHeight) {
				//Calculate header height if header appears
				if (mkdf.scroll > 0 && header.length) {
					headerHeight = header.height();
				}
				
				var headerMixin = headerHeight + mkdfGlobalVars.vars.mkdfAddForAdminBar + constant;
				if (mkdf.scroll >= infoHolderOffset - headerMixin) {
					if (mkdf.scroll + infoHolderHeight + headerMixin + 2 * constant < infoHolderOffset + mediaHolderHeight) {
						info.stop().animate({
							marginTop: (mkdf.scroll - infoHolderOffset + headerMixin + 2 * constant)
						});
						//Reset header height
						headerHeight = 0;
					} else {
						info.stop().animate({
							marginTop: mediaHolderHeight - infoHolderHeight
						});
					}
				} else {
					info.stop().animate({
						marginTop: 0
					});
				}
			}
		};
		
		return {
			init: function () {
				infoHolderPosition();
				$(window).scroll(function () {
					recalculateInfoHolderPosition();
				});
			}
		};
	};

    function initPortfolioNavigation(){
        var navigationHolder = $('.mkdf-ps-page-navigation');
        if(navigationHolder.length) {
            var paspartuSize = $('body .mkdf-wrapper').css('padding-left');
            var prev = navigationHolder.find('.mkdf-ps-prev');
            var next = navigationHolder.find('.mkdf-ps-next');
            var navPositionLeft = prev.css('left');
            var navPositionRight = next.css('right');

            var navPosition = typeof (navPositionLeft) !== 'undefined' ? navPositionLeft : navPositionRight;
            var value = 'calc(' + navPosition + ' + ' + paspartuSize + ')';
            prev.css('left', value);
            next.css('right', value);
            prev.css('opacity', 1);
            next.css('opacity', 1);
        }
    }

})(jQuery);
(function($) {
    'use strict';
	
	var accordions = {};
	mkdf.modules.accordions = accordions;
	
	accordions.mkdfInitAccordions = mkdfInitAccordions;
	
	
	accordions.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitAccordions();
	}
	
	/**
	 * Init accordions shortcode
	 */
	function mkdfInitAccordions(){
		var accordion = $('.mkdf-accordion-holder');
		
		if(accordion.length){
			accordion.each(function(){
				var thisAccordion = $(this);

				if(thisAccordion.hasClass('mkdf-accordion')){
					thisAccordion.accordion({
						animate: "easeOutQuart",
						collapsible: true,
						active: 0,
						icons: "",
						heightStyle: "content"
					});
				}

				if(thisAccordion.hasClass('mkdf-toggle')){
					var toggleAccordion = $(this),
						toggleAccordionTitle = toggleAccordion.find('.mkdf-accordion-title'),
						toggleAccordionContent = toggleAccordionTitle.next();

					toggleAccordion.addClass("accordion ui-accordion ui-accordion-icons ui-widget ui-helper-reset");
					toggleAccordionTitle.addClass("ui-accordion-header ui-state-default ui-corner-top ui-corner-bottom");
					toggleAccordionContent.addClass("ui-accordion-content ui-helper-reset ui-widget-content ui-corner-bottom").hide();

					toggleAccordionTitle.each(function(){
						var thisTitle = $(this);
						
						thisTitle.hover(function(){
							thisTitle.toggleClass("ui-state-hover");
						});

						thisTitle.on('click',function(){
							thisTitle.toggleClass('ui-accordion-header-active ui-state-active ui-state-default ui-corner-bottom');
							thisTitle.next().toggleClass('ui-accordion-content-active').slideToggle(400);
						});
					});
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var animationHolder = {};
	mkdf.modules.animationHolder = animationHolder;
	
	animationHolder.mkdfInitAnimationHolder = mkdfInitAnimationHolder;
	
	
	animationHolder.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitAnimationHolder();
	}
	
	/*
	 *	Init animation holder shortcode
	 */
	function mkdfInitAnimationHolder(){
		var elements = $('.mkdf-grow-in, .mkdf-fade-in-down, .mkdf-element-from-fade, .mkdf-element-from-left, .mkdf-element-from-right, .mkdf-element-from-top, .mkdf-element-from-bottom, .mkdf-flip-in, .mkdf-x-rotate, .mkdf-z-rotate, .mkdf-y-translate, .mkdf-fade-in, .mkdf-fade-in-left-x-rotate'),
			animationClass,
			animationData,
			animationDelay;
		
		if(elements.length){
			elements.each(function(){
				var thisElement = $(this);
				
				thisElement.appear(function() {
					animationData = thisElement.data('animation');
					animationDelay = parseInt(thisElement.data('animation-delay'));
					
					if(typeof animationData !== 'undefined' && animationData !== '') {
						animationClass = animationData;
						var newClass = animationClass+'-on';
						
						setTimeout(function(){
							thisElement.addClass(newClass);
						},animationDelay);
					}
				},{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var button = {};
	mkdf.modules.button = button;
	
	button.mkdfButton = mkdfButton;
	
	
	button.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfButton().init();
	}
	
	/**
	 * Button object that initializes whole button functionality
	 * @type {Function}
	 */
	var mkdfButton = function() {
		//all buttons on the page
		var buttons = $('.mkdf-btn');
		
		/**
		 * Initializes button hover color
		 * @param button current button
		 */
		var buttonHoverColor = function(button) {
			if(typeof button.data('hover-color') !== 'undefined') {
				var changeButtonColor = function(event) {
					event.data.button.css('color', event.data.color);
				};
				
				var originalColor = button.css('color');
				var hoverColor = button.data('hover-color');
				
				button.on('mouseenter', { button: button, color: hoverColor }, changeButtonColor);
				button.on('mouseleave', { button: button, color: originalColor }, changeButtonColor);
			}
		};
		
		/**
		 * Initializes button hover background color
		 * @param button current button
		 */
		var buttonHoverBgColor = function(button) {
			if(typeof button.data('hover-bg-color') !== 'undefined') {
				var changeButtonBg = function(event) {
					event.data.button.css('background-color', event.data.color);
				};
				
				var originalBgColor = button.css('background-color');
				var hoverBgColor = button.data('hover-bg-color');
				
				button.on('mouseenter', { button: button, color: hoverBgColor }, changeButtonBg);
				button.on('mouseleave', { button: button, color: originalBgColor }, changeButtonBg);
			}
		};
		
		/**
		 * Initializes button border color
		 * @param button
		 */
		var buttonHoverBorderColor = function(button) {
			if(typeof button.data('hover-border-color') !== 'undefined') {
				var changeBorderColor = function(event) {
					event.data.button.css('border-color', event.data.color);
				};
				
				var originalBorderColor = button.css('borderTopColor'); //take one of the four sides
				var hoverBorderColor = button.data('hover-border-color');
				
				button.on('mouseenter', { button: button, color: hoverBorderColor }, changeBorderColor);
				button.on('mouseleave', { button: button, color: originalBorderColor }, changeBorderColor);
			}
		};
		
		return {
			init: function() {
				if(buttons.length) {
					buttons.each(function() {
						buttonHoverColor($(this));
						buttonHoverBgColor($(this));
						buttonHoverBorderColor($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var countdown = {};
	mkdf.modules.countdown = countdown;
	
	countdown.mkdfInitCountdown = mkdfInitCountdown;
	
	
	countdown.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitCountdown();
	}
	
	/**
	 * Countdown Shortcode
	 */
	function mkdfInitCountdown() {
		var countdowns = $('.mkdf-countdown'),
			date = new Date(),
			currentMonth = date.getMonth(),
			year,
			month,
			day,
			hour,
			minute,
			timezone,
			monthLabel,
			dayLabel,
			hourLabel,
			minuteLabel,
			secondLabel;
		
		if (countdowns.length) {
			countdowns.each(function(){
				//Find countdown elements by id-s
				var countdownId = $(this).attr('id'),
					countdown = $('#'+countdownId),
					digitFontSize,
					labelFontSize;
				
				//Get data for countdown
				year = countdown.data('year');
				month = countdown.data('month');
				day = countdown.data('day');
				hour = countdown.data('hour');
				minute = countdown.data('minute');
				timezone = countdown.data('timezone');
				monthLabel = countdown.data('month-label');
				dayLabel = countdown.data('day-label');
				hourLabel = countdown.data('hour-label');
				minuteLabel = countdown.data('minute-label');
				secondLabel = countdown.data('second-label');
				digitFontSize = countdown.data('digit-size');
				labelFontSize = countdown.data('label-size');

				if( currentMonth !== month ) {
					month = month - 1;
				}
				
				//Initialize countdown
				countdown.countdown({
					until: new Date(year, month, day, hour, minute, 44),
					labels: ['', monthLabel, '', dayLabel, hourLabel, minuteLabel, secondLabel],
					format: 'ODHMS',
					timezone: timezone,
					padZeroes: true,
					onTick: setCountdownStyle
				});
				
				function setCountdownStyle() {
					countdown.find('.countdown-amount').css({
						'font-size' : digitFontSize+'px',
						'line-height' : digitFontSize+'px'
					});
					countdown.find('.countdown-period').css({
						'font-size' : labelFontSize+'px'
					});
				}
			});
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var counter = {};
	mkdf.modules.counter = counter;
	
	counter.mkdfInitCounter = mkdfInitCounter;
	
	
	counter.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitCounter();
	}
	
	/**
	 * Counter Shortcode
	 */
	function mkdfInitCounter() {
		var counterHolder = $('.mkdf-counter-holder');
		
		if (counterHolder.length) {
			counterHolder.each(function() {
				var thisCounterHolder = $(this),
					thisCounter = thisCounterHolder.find('.mkdf-counter');
				
				thisCounterHolder.appear(function() {
					thisCounterHolder.css('opacity', '1');
					
					//Counter zero type
					if (thisCounter.hasClass('mkdf-zero-counter')) {
						var max = parseFloat(thisCounter.text());
						thisCounter.countTo({
							from: 0,
							to: max,
							speed: 1500,
							refreshInterval: 100
						});
					} else {
						thisCounter.absoluteCounter({
							speed: 2000,
							fadeInDelay: 1000
						});
					}
				},{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			});
		}
	}
	
})(jQuery);
(function ($) {
    'use strict';

    var customFont = {};
    mkdf.modules.customFont = customFont;

    customFont.mkdfCustomFontResize = mkdfCustomFontResize;
    customFont.mkdfCustomFontTypeOut = mkdfCustomFontTypeOut;


    customFont.mkdfOnDocumentReady = mkdfOnDocumentReady;
    customFont.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(document).ready(mkdfOnDocumentReady);
    $(window).load(mkdfOnWindowLoad);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfCustomFontResize();
    }

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfCustomFontTypeOut();
    }

    /*
     **	Custom Font resizing style
     */
    function mkdfCustomFontResize() {
        var holder = $('.mkdf-custom-font-holder');

        if (holder.length) {
            holder.each(function () {
                var thisItem = $(this),
                    itemClass = '',
                    smallLaptopStyle = '',
                    ipadLandscapeStyle = '',
                    ipadPortraitStyle = '',
                    mobileLandscapeStyle = '',
                    style = '',
                    responsiveStyle = '';

                if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
                    itemClass = thisItem.data('item-class');
                }

                if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
                    smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
                }
                if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
                    ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
                }
                if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
                    ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
                }
                if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
                    mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
                }

                if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
                    smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
                }
                if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
                    ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
                }
                if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
                    ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
                }
                if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
                    mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
                }

                if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {

                    if (smallLaptopStyle.length) {
                        responsiveStyle += "@media only screen and (max-width: 1366px) {.mkdf-custom-font-holder." + itemClass + " { " + smallLaptopStyle + " } }";
                    }
                    if (ipadLandscapeStyle.length) {
                        responsiveStyle += "@media only screen and (max-width: 1024px) {.mkdf-custom-font-holder." + itemClass + " { " + ipadLandscapeStyle + " } }";
                    }
                    if (ipadPortraitStyle.length) {
                        responsiveStyle += "@media only screen and (max-width: 768px) {.mkdf-custom-font-holder." + itemClass + " { " + ipadPortraitStyle + " } }";
                    }
                    if (mobileLandscapeStyle.length) {
                        responsiveStyle += "@media only screen and (max-width: 680px) {.mkdf-custom-font-holder." + itemClass + " { " + mobileLandscapeStyle + " } }";
                    }
                }

                if (responsiveStyle.length) {
                    style = '<style type="text/css">' + responsiveStyle + '</style>';
                }

                if (style.length) {
                    $('head').append(style);
                }
            });
        }
    }

    /*
     * Init Type out functionality for Custom Font shortcode
     */
    function mkdfCustomFontTypeOut() {
        var mkdfTyped = $('.mkdf-cf-typed');

        if (mkdfTyped.length && !mkdf.htmlEl.hasClass('touch')) {
            mkdfTyped.each(function () {

                //vars
                var thisTyped = $(this),
                    typedWrap = thisTyped.parent('.mkdf-cf-typed-wrap'),
                    customFontHolder = typedWrap.parent('.mkdf-custom-font-holder'),
                    str = [],
                    string_1 = thisTyped.find('.mkdf-cf-typed-1').text(),
                    string_2 = thisTyped.find('.mkdf-cf-typed-2').text(),
                    string_3 = thisTyped.find('.mkdf-cf-typed-3').text(),
                    string_4 = thisTyped.find('.mkdf-cf-typed-4').text();

                if (string_1.length) {
                    str.push(string_1);
                }

                if (string_2.length) {
                    str.push(string_2);
                }

                if (string_3.length) {
                    str.push(string_3);
                }

                if (string_4.length) {
                    str.push(string_4);
                }

                customFontHolder.appear(function () {
                    thisTyped.typed({
                        strings: str,
                        typeSpeed: 90,
                        backDelay: 700,
                        loop: true,
                        contentType: 'text',
                        loopCount: false,
                        cursorChar: '_'
                    });
                }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
            });
        }
    }

})(jQuery);
(function($) {
	'use strict';

	var elementsHolder = {};
	mkdf.modules.elementsHolder = elementsHolder;

	elementsHolder.mkdfInitElementsHolderResponsiveStyle = mkdfInitElementsHolderResponsiveStyle;


	elementsHolder.mkdfOnDocumentReady = mkdfOnDocumentReady;

	$(document).ready(mkdfOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitElementsHolderResponsiveStyle();
	}

	/*
	 **	Elements Holder responsive style
	 */
	function mkdfInitElementsHolderResponsiveStyle(){
		var elementsHolder = $('.mkdf-elements-holder, .ms-tableCell');

		if(elementsHolder.length){
			elementsHolder.each(function() {
				var thisElementsHolder = $(this),
					elementsHolderItem = thisElementsHolder.children('.mkdf-eh-item'),
					style = '',
					responsiveStyle = '';

				elementsHolderItem.each(function() {
					var thisItem = $(this),
						itemClass = '',
						largeLaptop = '',
						smallLaptop = '',
						ipadLandscape = '',
						ipadPortrait = '',
						mobileLandscape = '',
						mobilePortrait = '';

					if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
						itemClass = thisItem.data('item-class');
					}
					if (typeof thisItem.data('1367-1600') !== 'undefined' && thisItem.data('1367-1600') !== false) {
						largeLaptop = thisItem.data('1367-1600');
					}
					if (typeof thisItem.data('1025-1366') !== 'undefined' && thisItem.data('1025-1366') !== false) {
						smallLaptop = thisItem.data('1025-1366');
					}
					if (typeof thisItem.data('769-1024') !== 'undefined' && thisItem.data('769-1024') !== false) {
						ipadLandscape = thisItem.data('769-1024');
					}
					if (typeof thisItem.data('681-768') !== 'undefined' && thisItem.data('681-768') !== false) {
						ipadPortrait = thisItem.data('681-768');
					}
					if (typeof thisItem.data('680') !== 'undefined' && thisItem.data('680') !== false) {
						mobileLandscape = thisItem.data('680');
					}

					if(largeLaptop.length || smallLaptop.length || ipadLandscape.length || ipadPortrait.length || mobileLandscape.length || mobilePortrait.length) {

						if(largeLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1367px) and (max-width: 1600px) {.mkdf-eh-item-content."+itemClass+" { padding: "+largeLaptop+" !important; } }";
						}
						if(smallLaptop.length) {
							responsiveStyle += "@media only screen and (min-width: 1025px) and (max-width: 1366px) {.mkdf-eh-item-content."+itemClass+" { padding: "+smallLaptop+" !important; } }";
						}
						if(ipadLandscape.length) {
							responsiveStyle += "@media only screen and (min-width: 769px) and (max-width: 1024px) {.mkdf-eh-item-content."+itemClass+" { padding: "+ipadLandscape+" !important; } }";
						}
						if(ipadPortrait.length) {
							responsiveStyle += "@media only screen and (min-width: 681px) and (max-width: 768px) {.mkdf-eh-item-content."+itemClass+" { padding: "+ipadPortrait+" !important; } }";
						}
						if(mobileLandscape.length) {
							responsiveStyle += "@media only screen and (max-width: 680px) {.mkdf-eh-item-content."+itemClass+" { padding: "+mobileLandscape+" !important; } }";
						}
					}

                    if (typeof mkdf.modules.common.mkdfOwlSlider === "function") { // if owl function exist
                        var owl = thisItem.find('.mkdf-owl-slider');
                        if (owl.length) { // if owl is in elements holder
                            setTimeout(function () {
                                owl.trigger('refresh.owl.carousel'); // reinit owl
                            }, 100);
                        }
                    }

				});

				if(responsiveStyle.length) {
					style = '<style type="text/css">'+responsiveStyle+'</style>';
				}

				if(style.length) {
					$('head').append(style);
				}

			});
		}
	}

})(jQuery);
(function ($) {
    'use strict';

    var fullscreenInfo = {};
    mkdf.modules.fullscreenInfo = fullscreenInfo;
    fullscreenInfo.mkdfInitFullscreenInfo = mkdfInitFullscreenInfo;
    fullscreenInfo.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitFullscreenInfo();
    }

    function mkdfInitFullscreenInfo() {
        var intro = $('#mkdf-intro'),
            outro = $('#mkdf-outro'),
            touch = mkdf.htmlEl.hasClass('touch');

        var titleHide = function () {
            bgStripes.end.css({
                'transform-origin': '0 50%',
                'transform': 'scaleX(0)'
            }).one(mkdf.transitionEnd, function () {
                removeIntro();
            });
        }

        var infoAppear = function () {
            info.subtitle
                .add(info.tagline)
                .css('opacity', '1');
        }

        var infoHide = function () {
            info.subtitle
                .add(info.tagline)
                .css('opacity', '0');
        }

        var svgAppear = function () {
            svg.wrap
                .css('opacity', '1')
                .one(mkdf.transitionEnd, function () {
                    svg.mouseOutline
                        .add(svg.wheelOutline)
                        .add(svg.wheel)
                        .css('stroke-dashoffset', '0');
                    svg.circles.css('opacity', '1');
                    svg.arrow.css({
                        'opacity': '1',
                        'transform': 'translateY(0)'
                    });
                    !touch && svg.arrow.one(mkdf.transitionEnd, function () {
                        $(window).one('mousewheel click', animateOut);
                    });
                    touch && checkForRev();
                });
        }

        var svgHide = function () {
            svg.mouseOutline.css('stroke-dashoffset', '148');
            svg.wheelOutline.css('stroke-dashoffset', '29');
            svg.wheel.css('stroke-dashoffset', '5');
            svg.circles.css('opacity', '0');
            svg.arrow.css('opacity', '0');
        }

        var animateIn = function () {
            bgStripes.start.find('span').on('animationiteration', function () {
                bgStripes.start.remove();
                bgStripes.end.css('transform', 'scaleX(1)');
                infoAppear();
                svgAppear();
            })
        }

        var animateOut = function (e) {
            infoHide();
            titleHide();
            svgHide();
        }

        var checkForRev = function () {
            var revSlider = $('.mkdf-wait-for-intro .rev_slider');
            revSlider.length && revSlider.revstart();
        }

        var removeIntro = function () {
            intro
                .css('transform', 'scaleX(0)')
                .one(mkdf.transitionEnd, function () {
                    mkdf.modules.common.mkdfEnableScroll();
                    checkForRev();
                });
        }

        var appearFx = function () {
            outro.appear(function () {
                outro.addClass('mkdf-appeared');
            }, {
                accX: 0,
                accY: mkdfGlobalVars.vars.mkdfElementAppearAmount
            });
        }

        if (intro.length) {
            var bgStripes = {
                start: intro.find('.mkdf-bg-stripe.mkdf-start'),
                end: intro.find('.mkdf-bg-stripe.mkdf-end')
            }

            var info = {
                subtitle: intro.find('.mkdf-intro-subtitle'),
                tagline: intro.find('.mkdf-intro-tagline'),
            }

            var svg = {
                wrap: intro.find('svg'),
                mouseOutline: intro.find('.mkdf-mouse-outline'),
                wheelOutline: intro.find('.mkdf-wheel-outline'),
                wheel: intro.find('.mkdf-wheel'),
                arrow: intro.find('.mkdf-arrow'),
                circles: intro.find('circle')
            };

            !touch && mkdf.modules.common.mkdfDisableScroll();
            animateIn();
        }

        if (outro.length) {
            appearFx();
        }
    }
})(jQuery);
(function($) {
	'use strict';
	
	var googleMap = {};
	mkdf.modules.googleMap = googleMap;
	
	googleMap.mkdfShowGoogleMap = mkdfShowGoogleMap;
	
	
	googleMap.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfShowGoogleMap();
	}
	
	/*
	 **	Show Google Map
	 */
	function mkdfShowGoogleMap(){
		var googleMap = $('.mkdf-google-map');
		
		if(googleMap.length){
			googleMap.each(function(){
				var element = $(this);
				
				var snazzyMapStyle = false;
				var snazzyMapCode  = '';
				if(typeof element.data('snazzy-map-style') !== 'undefined' && element.data('snazzy-map-style') === 'yes') {
					snazzyMapStyle = true;
					var snazzyMapHolder = element.parent().find('.mkdf-snazzy-map'),
						snazzyMapCodes  = snazzyMapHolder.val();
					
					if( snazzyMapHolder.length && snazzyMapCodes.length ) {
						snazzyMapCode = JSON.parse( snazzyMapCodes.replace(/`{`/g, '[').replace(/`}`/g, ']').replace(/``/g, '"').replace(/`/g, '') );
					}
				}
				
				var customMapStyle;
				if(typeof element.data('custom-map-style') !== 'undefined') {
					customMapStyle = element.data('custom-map-style');
				}
				
				var colorOverlay;
				if(typeof element.data('color-overlay') !== 'undefined' && element.data('color-overlay') !== false) {
					colorOverlay = element.data('color-overlay');
				}
				
				var saturation;
				if(typeof element.data('saturation') !== 'undefined' && element.data('saturation') !== false) {
					saturation = element.data('saturation');
				}
				
				var lightness;
				if(typeof element.data('lightness') !== 'undefined' && element.data('lightness') !== false) {
					lightness = element.data('lightness');
				}
				
				var zoom;
				if(typeof element.data('zoom') !== 'undefined' && element.data('zoom') !== false) {
					zoom = element.data('zoom');
				}
				
				var pin;
				if(typeof element.data('pin') !== 'undefined' && element.data('pin') !== false) {
					pin = element.data('pin');
				}
				
				var mapHeight;
				if(typeof element.data('height') !== 'undefined' && element.data('height') !== false) {
					mapHeight = element.data('height');
				}
				
				var uniqueId;
				if(typeof element.data('unique-id') !== 'undefined' && element.data('unique-id') !== false) {
					uniqueId = element.data('unique-id');
				}
				
				var scrollWheel;
				if(typeof element.data('scroll-wheel') !== 'undefined') {
					scrollWheel = element.data('scroll-wheel');
				}
				var addresses;
				if(typeof element.data('addresses') !== 'undefined' && element.data('addresses') !== false) {
					addresses = element.data('addresses');
				}
				
				var map = "map_"+ uniqueId;
				var geocoder = "geocoder_"+ uniqueId;
				var holderId = "mkdf-map-"+ uniqueId;
				
				mkdfInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, colorOverlay, saturation, lightness, scrollWheel, zoom, holderId, mapHeight, pin,  map, geocoder, addresses);
			});
		}
	}
	
	/*
	 **	Init Google Map
	 */
	function mkdfInitializeGoogleMap(snazzyMapStyle, snazzyMapCode, customMapStyle, color, saturation, lightness, wheel, zoom, holderId, height, pin,  map, geocoder, data){
		
		if(typeof google !== 'object') {
			return;
		}
		
		var mapStyles = [];
		if(snazzyMapStyle && snazzyMapCode.length) {
			mapStyles = snazzyMapCode;
		} else {
			mapStyles = [
				{
					stylers: [
						{hue: color },
						{saturation: saturation},
						{lightness: lightness},
						{gamma: 1}
					]
				}
			];
		}
		
		var googleMapStyleId;
		
		if(snazzyMapStyle || customMapStyle === 'yes'){
			googleMapStyleId = 'mkdf-style';
		} else {
			googleMapStyleId = google.maps.MapTypeId.ROADMAP;
		}
		
		wheel = wheel === 'yes';
		
		var qoogleMapType = new google.maps.StyledMapType(mapStyles, {name: "Google Map"});
		
		geocoder = new google.maps.Geocoder();
		var latlng = new google.maps.LatLng(-34.397, 150.644);
		
		if (!isNaN(height)){
			height = height + 'px';
		}
		
		var myOptions = {
			zoom: zoom,
			scrollwheel: wheel,
			center: latlng,
			zoomControl: true,
			zoomControlOptions: {
				style: google.maps.ZoomControlStyle.SMALL,
				position: google.maps.ControlPosition.RIGHT_CENTER
			},
			scaleControl: false,
			scaleControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			streetViewControl: false,
			streetViewControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			panControl: false,
			panControlOptions: {
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeControl: false,
			mapTypeControlOptions: {
				mapTypeIds: [google.maps.MapTypeId.ROADMAP, 'mkdf-style'],
				style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
				position: google.maps.ControlPosition.LEFT_CENTER
			},
			mapTypeId: googleMapStyleId
		};
		
		map = new google.maps.Map(document.getElementById(holderId), myOptions);
		map.mapTypes.set('mkdf-style', qoogleMapType);
		
		var index;
		
		for (index = 0; index < data.length; ++index) {
			mkdfInitializeGoogleAddress(data[index], pin, map, geocoder);
		}
		
		var holderElement = document.getElementById(holderId);
		holderElement.style.height = height;
	}
	
	/*
	 **	Init Google Map Addresses
	 */
	function mkdfInitializeGoogleAddress(data, pin, map, geocoder){
		if (data === '') {
			return;
		}
		
		var contentString = '<div id="content">'+
			'<div id="siteNotice">'+
			'</div>'+
			'<div id="bodyContent">'+
			'<p>'+data+'</p>'+
			'</div>'+
			'</div>';
		
		var infowindow = new google.maps.InfoWindow({
			content: contentString
		});
		
		geocoder.geocode( { 'address': data}, function(results, status) {
			if (status === google.maps.GeocoderStatus.OK) {
				map.setCenter(results[0].geometry.location);
				var marker = new google.maps.Marker({
					map: map,
					position: results[0].geometry.location,
					icon:  pin,
					title: data.store_title
				});
				google.maps.event.addListener(marker, 'click', function() {
					infowindow.open(map,marker);
				});
				
				google.maps.event.addDomListener(window, 'resize', function() {
					map.setCenter(results[0].geometry.location);
				});
			}
		});
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var icon = {};
	mkdf.modules.icon = icon;
	
	icon.mkdfIcon = mkdfIcon;
	
	
	icon.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfIcon().init();
	}
	
	/**
	 * Object that represents icon shortcode
	 * @returns {{init: Function}} function that initializes icon's functionality
	 */
	var mkdfIcon = function() {
		var icons = $('.mkdf-icon-shortcode');
		
		/**
		 * Function that triggers icon animation and icon animation delay
		 */
		var iconAnimation = function(icon) {
			if(icon.hasClass('mkdf-icon-animation')) {
				icon.appear(function() {
					icon.parent('.mkdf-icon-animation-holder').addClass('mkdf-icon-animation-show');
				}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			}
		};
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.mkdf-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		/**
		 * Function that triggers icon holder background color hover functionality
		 */
		var iconHolderBackgroundHover = function(icon) {
			if(typeof icon.data('hover-background-color') !== 'undefined') {
				var changeIconBgColor = function(event) {
					event.data.icon.css('background-color', event.data.color);
				};
				
				var hoverBackgroundColor = icon.data('hover-background-color');
				var originalBackgroundColor = icon.css('background-color');
				
				if(hoverBackgroundColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBackgroundColor}, changeIconBgColor);
					icon.on('mouseleave', {icon: icon, color: originalBackgroundColor}, changeIconBgColor);
				}
			}
		};
		
		/**
		 * Function that initializes icon holder border hover functionality
		 */
		var iconHolderBorderHover = function(icon) {
			if(typeof icon.data('hover-border-color') !== 'undefined') {
				var changeIconBorder = function(event) {
					event.data.icon.css('border-color', event.data.color);
				};
				
				var hoverBorderColor = icon.data('hover-border-color');
				var originalBorderColor = icon.css('borderTopColor');
				
				if(hoverBorderColor !== '') {
					icon.on('mouseenter', {icon: icon, color: hoverBorderColor}, changeIconBorder);
					icon.on('mouseleave', {icon: icon, color: originalBorderColor}, changeIconBorder);
				}
			}
		};
		
		return {
			init: function() {
				if(icons.length) {
					icons.each(function() {
						iconAnimation($(this));
						iconHoverColor($(this));
						iconHolderBackgroundHover($(this));
						iconHolderBorderHover($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function($) {
	'use strict';
	
	var iconListItem = {};
	mkdf.modules.iconListItem = iconListItem;
	
	iconListItem.mkdfInitIconList = mkdfInitIconList;
	
	
	iconListItem.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitIconList().init();
	}
	
	/**
	 * Button object that initializes icon list with animation
	 * @type {Function}
	 */
	var mkdfInitIconList = function() {
		var iconList = $('.mkdf-animate-list');
		
		/**
		 * Initializes icon list animation
		 * @param list current slider
		 */
		var iconListInit = function(list) {
			setTimeout(function(){
				list.appear(function(){
					list.addClass('mkdf-appeared');
				},{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			},30);
		};
		
		return {
			init: function() {
				if(iconList.length) {
					iconList.each(function() {
						iconListInit($(this));
					});
				}
			}
		};
	};
	
})(jQuery);
(function ($) {
    'use strict';

    var iconShowcase = {};
    mkdf.modules.iconShowcase = iconShowcase;

    iconShowcase.mkdfInitInteractiveIconShowcase = mkdfInitInteractiveIconShowcase;


    iconShowcase.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitInteractiveIconShowcase();
    }

    function mkdfInitInteractiveIconShowcase() {

        var interactiveShowcase = $('.mkdf-int-icon-showcase'),
            noAnimationOnTouch = $('.mkdf-no-animations-on-touch');

        if (interactiveShowcase.length) {
            interactiveShowcase.each(function () {
                var thisShowcase = $(this),
                    iconHolders = thisShowcase.find('.mkdf-showcase-item-holder'),
                    thisIcons = thisShowcase.find('.mkdf-showcase-icon'),
                    thisContent = thisShowcase.find('.mkdf-showcase-content'),
                    thisFirstItem = thisShowcase.find('.mkdf-showcase-item-holder:first-child'),
                    thisActiveItem = thisShowcase.find('.mkdf-showcase-item-holder.mkdf-showcase-active'),
                    isInitialized = false,
                    isPaused = false,
                    currentItem,
                    itemInterval = 3000,
                    numberOfItems = iconHolders.length;

                if (typeof thisShowcase.data('interval') !== 'undefined' && thisShowcase.data('interval') !== false) {
                    itemInterval = thisShowcase.data('interval');
                }

                if (!noAnimationOnTouch.length) {
                    //appear
                    thisShowcase.appear(function () {
                        setTimeout(function () {
                            thisShowcase.addClass('mkdf-appeared');
                            if (!thisActiveItem.length) {
                                setTimeout(function () {
                                    isInitialized = true;
                                    thisFirstItem.addClass('mkdf-showcase-active');
                                    // console.log(thisFirstItem);
                                    if (thisShowcase.hasClass('mkdf-autoplay')) {
                                        showcaseLoop();
                                        thisShowcase.hover(function (e) {
                                            isPaused = true;
                                        }, function (e) {
                                            isPaused = false;
                                        });
                                    }
                                }, 2500);
                            }
                        }, 30);
                    }, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
                } else {
                    thisFirstItem.addClass('mkdf-showcase-active');
                    // console.log(thisFirstItem);
                    isInitialized = true;
                }

                //hover actions
                thisIcons.each(function () {
                    var thisIcon = $(this),
                        thisHolder = thisIcon.parent();

                    thisIcon.mouseenter(function () {
                        if (isInitialized == true) {
                            thisHolder.siblings().removeClass('mkdf-showcase-active mkdf-current');
                            thisHolder.addClass('mkdf-showcase-active mkdf-current');
                            currentItem = thisShowcase.find('.mkdf-current').index(); //reset current loop item to latest hovered item
                        }
                    });
                });

                //loop through the items
                function showcaseLoop() {
                    currentItem = 0; //start from the first item, index = 0

                    var loop = setInterval(function () {
                        if (!isPaused) {
                            iconHolders.removeClass('mkdf-showcase-active mkdf-current');
                            if (currentItem == numberOfItems - 1) {
                                currentItem = 0;
                            } else {
                                currentItem++;
                            }
                            iconHolders.eq(currentItem).addClass('mkdf-showcase-active');
                        }
                    }, itemInterval);
                }
            });
        }
    }

})(jQuery);

(function($) {
	'use strict';
	
    var iconWithText = {};
    
	mkdf.modules.iconWithText = iconWithText;
	iconWithText.mkdfIconWithText = mkdfIconWithText;
	iconWithText.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfIconWithText().init();
	}
	
	/**
	 * Object that represents icon with text shortcode
	 */
	var mkdfIconWithText = function() {
		var iwts = $('.mkdf-iwt');
		
		/**
		 * Function that triggers icon hover color functionality
		 */
		var iconHoverColor = function(icon) {
			if(typeof icon.data('hover-color') !== 'undefined') {
				var changeIconColor = function(event) {
					event.data.icon.css('color', event.data.color);
				};
				
				var iconElement = icon.find('.mkdf-icon-element');
				var hoverColor = icon.data('hover-color');
				var originalColor = iconElement.css('color');
				
				if(hoverColor !== '') {
					icon.closest('.mkdf-iwt').find('a').on('mouseenter', {icon: iconElement, color: hoverColor}, changeIconColor);
					icon.closest('.mkdf-iwt').find('a').on('mouseleave', {icon: iconElement, color: originalColor}, changeIconColor);
				}
			}
		};
		
		return {
			init: function() {
				if(iwts.length) {
					iwts.each(function() {
						iconHoverColor($(this).find('.mkdf-icon-shortcode'));
					});
				}
			}
		};
	};
	
})(jQuery);
(function ($) {
    'use strict';

    var lineGraph = {};
    mkdf.modules.lineGraph = lineGraph;

    lineGraph.mkdfInitLineGraph = mkdfInitLineGraph;


    lineGraph.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitLineGraph();
    }

    function mkdfInitLineGraph() {
        var holder = $('.mkdf-line-graph-holder');

        holder.each(function () {
            var chartId = $(this).find('.mkdf-lg-data').data('id');
            var chart = document.getElementById('lineGraph' + chartId);
            var labels = $(this).find('.mkdf-lg-data').data('labels');
            var datasets = $(this).find('.mkdf-lg-data').data('dataset');
            var scaleSetps = $(this).find('.mkdf-lg-data').data('scale-steps');
            var scaleSetpsWidth = $(this).find('.mkdf-lg-data').data('scale-steps-width');
            var chartData = {
                labels: labels,
                datasets: datasets
            };

            $('#lineGraph' + chartId).appear(function () {
                new Chart(chart.getContext('2d')).Line(chartData, {
                    scaleOverride: true,
                    scaleStepWidth: parseInt(scaleSetpsWidth),
                    scaleSteps: parseInt(scaleSetps),
                    bezierCurve: true,
                    pointDot: false,
                    scaleLineColor: '#000000',
                    scaleFontColor: '#000000',
                    scaleFontSize: 17,
                    scaleFontFamily: 'Montserrat',
                    scaleGridLineColor: '#cccccc',
                    scaleGridLineWidth: 1,
                    datasetStroke: false,
                    datasetStrokeWidth: 0,
                    animationSteps: 120,
                });
            }, {accX: 0, accY: -200});

        });
    }

})(jQuery);
(function($) {
	'use strict';
	
	var pieChart = {};
	mkdf.modules.pieChart = pieChart;
	
	pieChart.mkdfInitPieChart = mkdfInitPieChart;
	
	
	pieChart.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitPieChart();
	}
	
	/**
	 * Init Pie Chart shortcode
	 */
	function mkdfInitPieChart() {
		var pieChartHolder = $('.mkdf-pie-chart-holder');
		
		if (pieChartHolder.length) {
			pieChartHolder.each(function () {
				var thisPieChartHolder = $(this),
					pieChart = thisPieChartHolder.children('.mkdf-pc-percentage'),
					barColor = '#000',
					trackColor = '#eaeaea',
					lineWidth = 15,
					size = 260;
				
				if(typeof pieChart.data('size') !== 'undefined' && pieChart.data('size') !== '') {
					size = pieChart.data('size');
				}
				
				if(typeof pieChart.data('bar-color') !== 'undefined' && pieChart.data('bar-color') !== '') {
					barColor = pieChart.data('bar-color');
				}
				
				if(typeof pieChart.data('track-color') !== 'undefined' && pieChart.data('track-color') !== '') {
					trackColor = pieChart.data('track-color');
				}
				
				pieChart.appear(function() {
					initToCounterPieChart(pieChart);
					thisPieChartHolder.css('opacity', '1');
					
					pieChart.easyPieChart({
						barColor: barColor,
						trackColor: trackColor,
						scaleColor: false,
						lineCap: 'butt',
						lineWidth: lineWidth,
						animate: 1500,
						size: size
					});
				},{accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for pie chart number from zero to defined number
	 */
	function initToCounterPieChart(pieChart){
		var counter = pieChart.find('.mkdf-pc-percent'),
			max = parseFloat(counter.text());
		
		counter.countTo({
			from: 0,
			to: max,
			speed: 1500,
			refreshInterval: 50
		});
	}
	
})(jQuery);
(function ($) {
	'use strict';

	var process = {};
	mkdf.modules.process = process;

	process.mkdfInitProcess = mkdfInitProcess;


	process.mkdfOnDocumentReady = mkdfOnDocumentReady;

	$(document).ready(mkdfOnDocumentReady);

	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitProcess()
	}

	/**
	 * Inti process shortcode on appear
	 */
	function mkdfInitProcess() {
		var holder = $('.mkdf-process-holder');

		if (holder.length) {
			holder.appear(function () {
				var thisHolder = $(this);
				thisHolder.addClass('mkdf-process-appeared');
			}, {
				accX: 0,
				accY: mkdfGlobalVars.vars.mkdfElementAppearAmount
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var progressBar = {};
	mkdf.modules.progressBar = progressBar;
	
	progressBar.mkdfInitProgressBars = mkdfInitProgressBars;
	
	
	progressBar.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitProgressBars();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function mkdfInitProgressBars() {
		var progressBar = $('.mkdf-progress-bar');
		
		if (progressBar.length) {
			progressBar.each(function () {
				var thisBar = $(this),
					thisBarContent = thisBar.find('.mkdf-pb-content'),
					progressBar = thisBar.find('.mkdf-pb-percent'),
					percentage = thisBarContent.data('percentage');
				
				thisBar.appear(function () {
					mkdfInitToCounterProgressBar(progressBar, percentage);
					
					thisBarContent.css('width', percentage+'%');

					if (thisBar.hasClass('mkdf-pb-percent-floating')) {
						progressBar.css({
							'opacity': 1,
							'left': percentage+'%'
						});
					}
				}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
			});
		}
	}
	
	/*
	 **	Counter for horizontal progress bars percent from zero to defined percent
	 */
	function mkdfInitToCounterProgressBar(progressBar, percentageValue){
		var percentage = parseFloat(percentageValue);
		
		if(progressBar.length) {
			progressBar.each(function() {
				var thisPercent = $(this);
				thisPercent.css('opacity', '1');
				
				thisPercent.countTo({
					from: 0,
					to: percentage,
					speed: 1000,
					refreshInterval: 100
				});
			});
		}
	}
	
})(jQuery);
(function ($) {
    'use strict';

    var slidingImageHolder = {};
    mkdf.modules.slidingImageHolder = slidingImageHolder;

    slidingImageHolder.mkdfInitSlidingImageHolder = mkdfInitSlidingImageHolder;


    slidingImageHolder.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitSlidingImageHolder();
    }

    function mkdfRequestAnimationFrame() {
        window.requestNextAnimationFrame =
            (function () {
                    var originalWebkitRequestAnimationFrame = undefined,
                        wrapper = undefined,
                        callback = undefined,
                        geckoVersion = 0,
                        userAgent = navigator.userAgent,
                        index = 0,
                        self = this;

                    // Workaround for Chrome 10 bug where Chrome
                    // does not pass the time to the animation function

                    if (window.webkitRequestAnimationFrame) {
                        // Define the wrapper

                        wrapper = function (time) {
                            if (time === undefined) {
                                time = +new Date();
                            }

                            self.callback(time);
                        };

                        // Make the switch

                        originalWebkitRequestAnimationFrame = window.webkitRequestAnimationFrame;

                        window.webkitRequestAnimationFrame = function (callback, element) {
                            self.callback = callback;

                            // Browser calls the wrapper and wrapper calls the callback
                            originalWebkitRequestAnimationFrame(wrapper, element);
                        };
                    }

                    // Workaround for Gecko 2.0, which has a bug in
                    // mozRequestAnimationFrame() that restricts animations
                    // to 30-40 fps.

                    if (window.mozRequestAnimationFrame) {
                        // Check the Gecko version. Gecko is used by browsers
                        // other than Firefox. Gecko 2.0 corresponds to
                        // Firefox 4.0.

                        index = userAgent.indexOf('rv:');

                        if (userAgent.indexOf('Gecko') !== -1) {
                            geckoVersion = userAgent.substr(index + 3, 3);

                            if (geckoVersion === '2.0') {
                                // Forces the return statement to fall through
                                // to the setTimeout() function.

                                window.mozRequestAnimationFrame = undefined;
                            }
                        }
                    }

                    return window.requestAnimationFrame ||
                        window.webkitRequestAnimationFrame ||
                        window.mozRequestAnimationFrame ||
                        window.oRequestAnimationFrame ||
                        window.msRequestAnimationFrame ||

                        function (callback, element) {
                            var start,
                                finish;

                            window.setTimeout(function () {
                                start = +new Date();
                                callback(start);
                                finish = +new Date();

                                self.timeout = 1000 / 60 - (finish - start);

                            }, self.timeout);
                        };
                }
            )();
    }

    function mkdfInitSlidingImageHolder() {
        var slidingImageHolder = $('.mkdf-sliding-image-holder');

        if (slidingImageHolder.length) {
            slidingImageHolder.each(function () {
                var thisSlidingImageHolder = $(this);

                thisSlidingImageHolder.waitForImages(function () {
                    // infinite scroll effect
                    if (!$('html').hasClass('touch')) {
                        mkdfRequestAnimationFrame();

                        var images = thisSlidingImageHolder.find('.mkdf-sliding-image-background-image'),
                            imageWidth = Math.round(images.width());

                        if (imageWidth == 0) {
                            imageWidth = 1920;
                        }

                        thisSlidingImageHolder.find('.mkdf-aux-background-image').css('left', imageWidth); //set to the right of initial image

                        images.each(function (i) {
                            var image = $(this),
                                currentPos = 0,
                                delta = 1;
                            var mikadoInfiniteScrollEffect = function () {
                                currentPos -= delta;

                                if (Math.round(image.offset().left) <= -imageWidth) {
                                    image.css('left', parseInt(imageWidth - 2 * delta));
                                    currentPos = 0;
                                }

                                image.css('transform', 'translate3d(' + currentPos + 'px,0,0)');
                                requestNextAnimationFrame(mikadoInfiniteScrollEffect);
                            };

                            $(window).load(function () {
                                mikadoInfiniteScrollEffect();
                            });
                        });
                    }
                });
            });
        }
    }

})(jQuery);
(function($) {
	'use strict';
	
	var tabs = {};
	mkdf.modules.tabs = tabs;
	
	tabs.mkdfInitTabs = mkdfInitTabs;
	
	
	tabs.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitTabs();
	}
	
	/*
	 **	Init tabs shortcode
	 */
	function mkdfInitTabs(){
		var tabs = $('.mkdf-tabs');
		
		if(tabs.length){
			tabs.each(function(){
				var thisTabs = $(this);
				
				thisTabs.children('.mkdf-tab-container').each(function(index){
					index = index + 1;
					var that = $(this),
						link = that.attr('id'),
						navItem = that.parent().find('.mkdf-tabs-nav li:nth-child('+index+') a'),
						navLink = navItem.attr('href');
					
					link = '#'+link;

					if(link.indexOf(navLink) > -1) {
						navItem.attr('href',link);
					}
				});
				
				thisTabs.tabs();

                $('.mkdf-tabs a.mkdf-external-link').unbind('click');
			});
		}
	}
	
})(jQuery);
(function ($) {
    'use strict';

    var teamCarousel = {};
    mkdf.modules.teamCarousel = teamCarousel;

    teamCarousel.mkdfInitTeamCarousel = mkdfInitTeamCarousel;


    teamCarousel.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfInitTeamCarousel();
    }

    function mkdfInitTeamCarousel() {
        var sliderHolder = $('.mkdf-team-carousel-holder');

        sliderHolder.each(function (e) {
            var imageSlider = $(this).find('.mkdf-tc-image-slider');
            var textSlider = $(this).find('.mkdf-tc-text-slider');

            var loop = true,
                autoplay = true,
                sliderSpeed = 5000,
                sliderSpeedAnimation = 600,
                autoplayHoverPause = false,
                dots = false,
                nav = false,
                drag = false;

            var text = textSlider.owlCarousel({
                items: 1,
                loop: loop,
                autoplay: autoplay,
                autoplayTimeout: sliderSpeed,
                smartSpeed: sliderSpeedAnimation,
                autoplayHoverPause: autoplayHoverPause,
                dots: dots,
                nav: nav,
                mouseDrag: drag,
                touchDrag: drag,
                responsive: {
                    769: {
                        autoplay: autoplay,
                    },
                    0: {
                        autoplay: true,
                    }
                },
                onInitialize: function () {
                    textSlider.css('visibility', 'visible');
                }
            });

            var image = imageSlider.owlCarousel({
                // items: 3,
                loop: loop,
                autoplay: autoplay,
                autoplayTimeout: sliderSpeed,
                smartSpeed: sliderSpeedAnimation,
                autoplayHoverPause: autoplayHoverPause,
                center: true,
                dots: dots,
                nav: nav,
                mouseDrag: drag,
                touchDrag: drag,
                responsive: {
                    1367: {
                        items: 5,
                    },
                    1025: {
                        items: 3,
                    },
                    769: {
                        items: 3,
                    },
                    0: {
                        autoplay: true,
                        items: 1
                    }
                },
                onInitialize: function () {
                    imageSlider.css('visibility', 'visible');
                }
            });

            imageSlider.find('.owl-item').on('click touchpress', function (e) {
                e.preventDefault();

                var thisItem = $(this),
                    itemIndex = thisItem.index(),
                    numberOfClones = imageSlider.find('.owl-item.cloned').length,
                    modifiedItems = itemIndex - numberOfClones / 2 >= 0 ? itemIndex - numberOfClones / 2 : itemIndex;

                image.trigger('to.owl.carousel', modifiedItems);
                text.trigger('to.owl.carousel', modifiedItems);
            });

            // on holder hover in stop
            sliderHolder.on('mouseenter', function (e) {
                imageSlider.trigger('stop.owl.autoplay');
                textSlider.trigger('stop.owl.autoplay');
            });

            // on holder hover out play slider
            sliderHolder.on('mouseleave', function (e) {
                imageSlider.trigger('play.owl.autoplay');
                textSlider.trigger('play.owl.autoplay');
            });
        })
    }

})(jQuery);
(function($) {
    'use strict';
    
    var textMarquee = {};
    mkdf.modules.textMarquee = textMarquee;
    
    textMarquee.mkdfInitTextMarquee = mkdfInitTextMarquee;
	textMarquee.mkdfTextMarqueeResize = mkdfTextMarqueeResize;
    
    textMarquee.mkdfOnDocumentReady = mkdfOnDocumentReady;
    
    $(document).ready(mkdfOnDocumentReady);
    
    /*
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfTextMarqueeResize();
        mkdfInitTextMarquee();
    }
    
    /**
     * Init Text Marquee effect
     */
    function mkdfInitTextMarquee() {
        var textMarqueeShortcodes = $('.mkdf-text-marquee');

        if (textMarqueeShortcodes.length) {
            textMarqueeShortcodes.each(function(){
                var textMarqueeShortcode = $(this),
                    marqueeElements = textMarqueeShortcode.find('.mkdf-marquee-element'),
                    originalText = marqueeElements.filter('.mkdf-original-text'),
                    auxText = marqueeElements.filter('.mkdf-aux-text');

                var calcWidth = function(element) {
                    var width;

                    if (textMarqueeShortcode.outerWidth() > element.outerWidth()) {
                        width = textMarqueeShortcode.outerWidth();
                    } else {
                        width = element.outerWidth();
                    }

                    return width;
                };

                var marqueeEffect = function () {
	                mkdfRequestAnimationFrame();
	                
                    var delta = 1, //pixel movement
                        speedCoeff = 0.8, // below 1 to slow down, above 1 to speed up
                        marqueeWidth = calcWidth(originalText);
                    marqueeElements.css({'width':marqueeWidth}); // set the same width to both elements
                    auxText.css('left', marqueeWidth); //set to the right of the initial marquee element

                    //movement loop
                    marqueeElements.each(function(i){
                        var marqueeElement = $(this),
                            currentPos = 0;

                        var mkdfInfiniteScrollEffect = function() {
                            currentPos -= delta;

                            //move marquee element
                            if (marqueeElement.position().left <= -marqueeWidth) {
                                marqueeElement.css('left', parseInt(marqueeWidth - delta));
                                currentPos = 0;
                            }

                            marqueeElement.css('transform','translate3d('+speedCoeff*currentPos+'px,0,0)');
	
	                        requestNextAnimationFrame(mkdfInfiniteScrollEffect);

                            $(window).resize(function(){
                                marqueeWidth = calcWidth(originalText);
                                currentPos = 0;
                                originalText.css('left',0);
                                auxText.css('left', marqueeWidth); //set to the right of the inital marquee element
                            });
                        }; 
                            
                        mkdfInfiniteScrollEffect();
                    });
                };

                marqueeEffect();
            });
        }
    }
    
    /*
     * Request Animation Frame shim
     */
	function mkdfRequestAnimationFrame() {
		window.requestNextAnimationFrame =
			(function () {
				var originalWebkitRequestAnimationFrame = undefined,
					wrapper = undefined,
					callback = undefined,
					geckoVersion = 0,
					userAgent = navigator.userAgent,
					index = 0,
					self = this;
				
				// Workaround for Chrome 10 bug where Chrome
				// does not pass the time to the animation function
				
				if (window.webkitRequestAnimationFrame) {
					// Define the wrapper
					
					wrapper = function (time) {
						if (time === undefined) {
							time = +new Date();
						}
						
						self.callback(time);
					};
					
					// Make the switch
					
					originalWebkitRequestAnimationFrame = window.webkitRequestAnimationFrame;
					
					window.webkitRequestAnimationFrame = function (callback, element) {
						self.callback = callback;
						
						// Browser calls the wrapper and wrapper calls the callback
						originalWebkitRequestAnimationFrame(wrapper, element);
					};
				}
				
				// Workaround for Gecko 2.0, which has a bug in
				// mozRequestAnimationFrame() that restricts animations
				// to 30-40 fps.
				
				if (window.mozRequestAnimationFrame) {
					// Check the Gecko version. Gecko is used by browsers
					// other than Firefox. Gecko 2.0 corresponds to
					// Firefox 4.0.
					
					index = userAgent.indexOf('rv:');
					
					if (userAgent.indexOf('Gecko') !== -1) {
						geckoVersion = userAgent.substr(index + 3, 3);
						
						if (geckoVersion === '2.0') {
							// Forces the return statement to fall through
							// to the setTimeout() function.
							
							window.mozRequestAnimationFrame = undefined;
						}
					}
				}
				
				return window.requestAnimationFrame   ||
					window.webkitRequestAnimationFrame ||
					window.mozRequestAnimationFrame    ||
					window.oRequestAnimationFrame      ||
					window.msRequestAnimationFrame     ||
					
					function (callback, element) {
						var start,
							finish;
						
						window.setTimeout( function () {
							start = +new Date();
							callback(start);
							finish = +new Date();
							
							self.timeout = 1000 / 60 - (finish - start);
							
						}, self.timeout);
					};
				}
			)();
	}

	/*
	 **	Text Marquee resizing style
	 */
	function mkdfTextMarqueeResize() {
		var holder = $('.mkdf-text-marquee');

		if (holder.length) {
			holder.each(function () {
				var thisItem = $(this),
					itemClass = '',
					smallLaptopStyle = '',
					ipadLandscapeStyle = '',
					ipadPortraitStyle = '',
					mobileLandscapeStyle = '',
					style = '',
					responsiveStyle = '';

				if (typeof thisItem.data('item-class') !== 'undefined' && thisItem.data('item-class') !== false) {
					itemClass = thisItem.data('item-class');
				}

				if (typeof thisItem.data('font-size-1366') !== 'undefined' && thisItem.data('font-size-1366') !== false) {
					smallLaptopStyle += 'font-size: ' + thisItem.data('font-size-1366') + ' !important;';
				}
				if (typeof thisItem.data('font-size-1024') !== 'undefined' && thisItem.data('font-size-1024') !== false) {
					ipadLandscapeStyle += 'font-size: ' + thisItem.data('font-size-1024') + ' !important;';
				}
				if (typeof thisItem.data('font-size-768') !== 'undefined' && thisItem.data('font-size-768') !== false) {
					ipadPortraitStyle += 'font-size: ' + thisItem.data('font-size-768') + ' !important;';
				}
				if (typeof thisItem.data('font-size-680') !== 'undefined' && thisItem.data('font-size-680') !== false) {
					mobileLandscapeStyle += 'font-size: ' + thisItem.data('font-size-680') + ' !important;';
				}

				if (typeof thisItem.data('line-height-1366') !== 'undefined' && thisItem.data('line-height-1366') !== false) {
					smallLaptopStyle += 'line-height: ' + thisItem.data('line-height-1366') + ' !important;';
				}
				if (typeof thisItem.data('line-height-1024') !== 'undefined' && thisItem.data('line-height-1024') !== false) {
					ipadLandscapeStyle += 'line-height: ' + thisItem.data('line-height-1024') + ' !important;';
				}
				if (typeof thisItem.data('line-height-768') !== 'undefined' && thisItem.data('line-height-768') !== false) {
					ipadPortraitStyle += 'line-height: ' + thisItem.data('line-height-768') + ' !important;';
				}
				if (typeof thisItem.data('line-height-680') !== 'undefined' && thisItem.data('line-height-680') !== false) {
					mobileLandscapeStyle += 'line-height: ' + thisItem.data('line-height-680') + ' !important;';
				}

				if (smallLaptopStyle.length || ipadLandscapeStyle.length || ipadPortraitStyle.length || mobileLandscapeStyle.length) {

					if (smallLaptopStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1366px) {.mkdf-text-marquee." + itemClass + " { " + smallLaptopStyle + " } }";
					}
					if (ipadLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 1024px) {.mkdf-text-marquee." + itemClass + " { " + ipadLandscapeStyle + " } }";
					}
					if (ipadPortraitStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 768px) {.mkdf-text-marquee." + itemClass + " { " + ipadPortraitStyle + " } }";
					}
					if (mobileLandscapeStyle.length) {
						responsiveStyle += "@media only screen and (max-width: 680px) {.mkdf-text-marquee." + itemClass + " { " + mobileLandscapeStyle + " } }";
					}
				}

				if (responsiveStyle.length) {
					style = '<style type="text/css">' + responsiveStyle + '</style>';
				}

				if (style.length) {
					$('head').append(style);
				}
			});
		}
	}

})(jQuery);
(function($) {
	'use strict';
	
	var verticalSplitSlider = {};
	mkdf.modules.verticalSplitSlider = verticalSplitSlider;
	
	verticalSplitSlider.mkdfInitVerticalSplitSlider = mkdfInitVerticalSplitSlider;
	
	
	verticalSplitSlider.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitVerticalSplitSlider();
	}
	
	/*
	 **	Vertical Split Slider
	 */
	function mkdfInitVerticalSplitSlider() {
		var slider = $('.mkdf-vertical-split-slider'),
			progressBarFlag = true;
		
		if (slider.length) {
			if (mkdf.body.hasClass('mkdf-vss-initialized')) {
				mkdf.body.removeClass('mkdf-vss-initialized');
				$.fn.multiscroll.destroy();
			}
			
			slider.height(mkdf.windowHeight).animate({opacity: 1}, 300);
			
			var defaultHeaderStyle = '';
			if (mkdf.body.hasClass('mkdf-light-header')) {
				defaultHeaderStyle = 'light';
			} else if (mkdf.body.hasClass('mkdf-dark-header')) {
				defaultHeaderStyle = 'dark';
			}
			
			slider.multiscroll({
				scrollingSpeed: 700,
				easing: 'easeInOutQuart',
				navigation: true,
				useAnchorsOnLoad: false,
				sectionSelector: '.mkdf-vss-ms-section',
				leftSelector: '.mkdf-vss-ms-left',
				rightSelector: '.mkdf-vss-ms-right',
				afterRender: function () {
					mkdfCheckVerticalSplitSectionsForHeaderStyle($('.mkdf-vss-ms-left .mkdf-vss-ms-section:first-child').data('header-style'), defaultHeaderStyle);
					mkdf.body.addClass('mkdf-vss-initialized');
					
					var contactForm7 = $('div.wpcf7 > form');
					if (contactForm7.length) {
						contactForm7.each(function(){
							var thisForm = $(this);
							
							thisForm.find('.wpcf7-submit').off().on('click', function(e){
								e.preventDefault();
								wpcf7.submit(thisForm);
							});
						});
					}
					
					//prepare html for smaller screens - start //
					var verticalSplitSliderResponsive = $('<div class="mkdf-vss-responsive"></div>'),
						leftSide = slider.find('.mkdf-vss-ms-left > div'),
						rightSide = slider.find('.mkdf-vss-ms-right > div');
					
					slider.after(verticalSplitSliderResponsive);
					
					for (var i = 0; i < leftSide.length; i++) {
						verticalSplitSliderResponsive.append($(leftSide[i]).clone(true));
						verticalSplitSliderResponsive.append($(rightSide[leftSide.length - 1 - i]).clone(true));
					}
					
					//prepare google maps clones
					var googleMapHolder = $('.mkdf-vss-responsive .mkdf-google-map');
					if (googleMapHolder.length) {
						googleMapHolder.each(function () {
							var map = $(this);
							map.empty();
							var num = Math.floor((Math.random() * 100000) + 1);
							map.attr('id', 'mkdf-map-' + num);
							map.data('unique-id', num);
						});
					}
					
					if (typeof mkdf.modules.animationHolder.mkdfInitAnimationHolder === "function") {
						mkdf.modules.animationHolder.mkdfInitAnimationHolder();
					}
					
					if (typeof mkdf.modules.button.mkdfButton === "function") {
						mkdf.modules.button.mkdfButton().init();
					}
					
					if (typeof mkdf.modules.elementsHolder.mkdfInitElementsHolderResponsiveStyle === "function") {
						mkdf.modules.elementsHolder.mkdfInitElementsHolderResponsiveStyle();
					}
					
					if (typeof mkdf.modules.googleMap.mkdfShowGoogleMap === "function") {
						mkdf.modules.googleMap.mkdfShowGoogleMap();
					}
					
					if (typeof mkdf.modules.icon.mkdfIcon === "function") {
						mkdf.modules.icon.mkdfIcon().init();
					}
					
					if (progressBarFlag && typeof mkdf.modules.progressBar.mkdfInitProgressBars === "function" && ($('.mkdf-vss-ms-left .mkdf-vss-ms-section.active').find('.mkdf-progress-bar').length || $('.mkdf-vss-ms-right .mkdf-vss-ms-section.active').find('.mkdf-progress-bar').length)){
						mkdf.modules.progressBar.mkdfInitProgressBars();
						progressBarFlag = false;
					}
				},
				onLeave: function (index, nextIndex) {
					if (progressBarFlag && typeof mkdf.modules.progressBar.mkdfInitProgressBars === "function" && ($('.mkdf-vss-ms-left .mkdf-vss-ms-section.active').find('.mkdf-progress-bar').length || $('.mkdf-vss-ms-right .mkdf-vss-ms-section.active').find('.mkdf-progress-bar').length)){
						setTimeout(function(){
							mkdf.modules.progressBar.mkdfInitProgressBars();
						},700); // scrolling speed is 700

						progressBarFlag = false;
					}

					mkdfIntiScrollAnimation(slider, nextIndex);
					mkdfCheckVerticalSplitSectionsForHeaderStyle($($('.mkdf-vss-ms-left .mkdf-vss-ms-section')[nextIndex - 1]).data('header-style'), defaultHeaderStyle);
				}
			});
			
			if (mkdf.windowWidth <= 1024) {
				$.fn.multiscroll.destroy();
			} else {
				$.fn.multiscroll.build();
			}
			
			$(window).resize(function () {
				if (mkdf.windowWidth <= 1024) {
					$.fn.multiscroll.destroy();
				} else {
					$.fn.multiscroll.build();
				}
			});
		}
	}
	
	function mkdfIntiScrollAnimation(slider, nextIndex) {
		
		if (slider.hasClass('mkdf-vss-scrolling-animation')) {
			
			if (nextIndex > 1 && !slider.hasClass('mkdf-vss-scrolled')) {
				slider.addClass('mkdf-vss-scrolled');
			} else if (nextIndex === 1 && slider.hasClass('mkdf-vss-scrolled')) {
				slider.removeClass('mkdf-vss-scrolled');
			}
		}
	}
	
	/*
	 **	Check slides on load and slide change for header style changing
	 */
	function mkdfCheckVerticalSplitSectionsForHeaderStyle(section_header_style, default_header_style) {
		if (section_header_style !== undefined && section_header_style !== '') {
			mkdf.body.removeClass('mkdf-light-header mkdf-dark-header').addClass('mkdf-' + section_header_style + '-header');
		} else if (default_header_style !== '') {
			mkdf.body.removeClass('mkdf-light-header mkdf-dark-header').addClass('mkdf-' + default_header_style + '-header');
		} else {
			mkdf.body.removeClass('mkdf-light-header mkdf-dark-header');
		}
	}
	
})(jQuery);
(function($) {
	'use strict';
	
	var videoBtn = {};
	mkdf.modules.videoBtn = videoBtn;
	videoBtn.mkdfVideoBtnAppearFx = mkdfVideoBtnAppearFx;
	videoBtn.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfVideoBtnAppearFx();
	}
	
	/*
	 **	Horizontal progress bars shortcode
	 */
	function mkdfVideoBtnAppearFx() {
		var videoBtns = $('.mkdf-video-button-holder');
		
		if (videoBtns.length && !mkdf.htmlEl.hasClass('touch')) {
            videoBtns.find('.mkdf-video-button-play-inner').appear(function() {
                $(this).closest('.mkdf-video-button-holder').addClass('mkdf-appeared');
			}, {accX: 0, accY: mkdfGlobalVars.vars.mkdfElementAppearAmount});
		}
	}
})(jQuery);
(function($) {
    'use strict';
	
	var masonryGalleryList = {};
	mkdf.modules.masonryGalleryList = masonryGalleryList;

    masonryGalleryList.mkdfInitMasonryGallery = mkdfInitMasonryGallery;

    masonryGalleryList.mkdfOnDocumentReady = mkdfOnDocumentReady;
	
	$(document).ready(mkdfOnDocumentReady);
	
	/*
	 All functions to be called on $(document).ready() should be in this function
	 */
	function mkdfOnDocumentReady() {
		mkdfInitMasonryGallery().init();
	}
	
	/**
	 * Masonry gallery, init masonry and resize pictures in grid
	 */
	function mkdfInitMasonryGallery() {
		var holder = $('.mkdf-masonry-gallery-holder');
		
		var initMasonryGallery = function (thisHolder, size) {
			thisHolder.waitForImages(function () {
				var masonry = thisHolder.children();
				
				masonry.isotope({
					layoutMode: 'packery',
					itemSelector: '.mkdf-mg-item',
					percentPosition: true,
					packery: {
						gutter: '.mkdf-mg-grid-gutter',
						columnWidth: '.mkdf-mg-grid-sizer'
					}
				});
				
				mkdf.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('.mkdf-mg-item'), size, true);
				
				setTimeout(function () {
					mkdf.modules.common.mkdfInitParallax();
				}, 600);
				
				masonry.isotope( 'layout').css('opacity', '1');
			});
		};
		
		var reInitMasonryGallery = function (thisHolder, size) {
			mkdf.modules.common.setFixedImageProportionSize(thisHolder, thisHolder.find('.mkdf-mg-item'), size, true);
			
			thisHolder.children().isotope('reloadItems');
		};
		
		return {
			init: function () {
				if (holder.length) {
					holder.each(function () {
						var thisHolder = $(this),
							size = thisHolder.find('.mkdf-mg-grid-sizer').outerWidth();
						
						initMasonryGallery(thisHolder, size);
						
						$(window).resize(function () {
							reInitMasonryGallery(thisHolder, size);
						});
					});
				}
			}
		};
	}

})(jQuery);
(function ($) {
    'use strict';

    var portfolioFullScreenSlider = {};
    mkdf.modules.portfolioFullScreenSlider = portfolioFullScreenSlider;

    portfolioFullScreenSlider.mkdfOnWindowLoad = mkdfOnWindowLoad;

    $(window).load(mkdfOnWindowLoad);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfPortfolioFullScreenSlider();
    }

    var mkdfPortfolioFullScreenSlider = function () {
        var FullScreenSliders = $('.mkdf-portfolio-fs-slider');
        FullScreenSliders.each(function () {

            var slider = $(this);
            var dataHolder = $(this).parent();
            var mobileHeaderHeight = $('.mkdf-mobile-header').height();

            var loop = true,
                autoplay = false,
                sliderSpeed = 5000,
                numberOfItems = 3,
                navigation = false,
                slidesToShowIpad = 2,
                subtractFromHeight = 2;

            if (dataHolder.data('enable-autoplay') == 'yes') {
                autoplay = true;
            }

            if (typeof dataHolder.data('subtract-from-height') !== 'undefined' && dataHolder.data('subtract-from-height') !== false) {
                subtractFromHeight = dataHolder.data('subtract-from-height');
            }

            if (dataHolder.data('subtract-from-height') == 'yes') {
                autoplay = true;
            }

            if (dataHolder.data('enable-navigation') == 'yes') {
                navigation = true;
            }

            if (typeof dataHolder.data('number-of-columns') !== 'undefined' && dataHolder.data('number-of-columns') !== false) {
                numberOfItems = dataHolder.data('number-of-columns');
            }

            if (dataHolder.data('enable-loop') == 'no') {
                loop = false;
            }

            if (typeof dataHolder.data('slider-speed') !== 'undefined' && dataHolder.data('slider-speed') !== false) {
                sliderSpeed = dataHolder.data('slider-speed');
            }


            slider.on('init', function (slick) {
                changeOnScroll();
            });

            var changeOnScroll = function () {
                slider.mousewheel(function (e) {
                    e.preventDefault();

                    if (e.deltaY < 0) {
                        slider.slick("slickNext");
                    } else {
                        slider.slick("slickPrev");
                    }
                });
            };

            if (numberOfItems > 2) {
                slidesToShowIpad = 2;
            }

            slider.slick({
                autoplay: autoplay,
                infinite: loop,
                slidesToShow: numberOfItems,
                autoplaySpeed: sliderSpeed,
                slidesToScroll: 1,
                arrows: false,
                dots: false,
                responsive: [
                    {
                        breakpoint: 769,
                        settings: {
                            slidesToShow: 2
                        }
                    },
                    {
                        breakpoint: 681,
                        settings: "unslick"
                    }
                ]
            });

            if (mkdf.windowWidth <= 680) {
                var article = slider.find('.portfolio-item');

                article.each(function () {
                    $(this).height(mkdf.windowHeight - mobileHeaderHeight);
                });
            }

            if (mkdf.windowWidth > 680 && mkdf.windowWidth <= 1024) {
                dataHolder.parent().height(mkdf.windowHeight - mobileHeaderHeight - (subtractFromHeight))
            }

        })
    };

})(jQuery);
(function ($) {
    'use strict';

    var portfolioInteractiveLinks = {};
    mkdf.modules.portfolioInteractiveLinks = portfolioInteractiveLinks;

    portfolioInteractiveLinks.mkdfOnWindowReady = mkdfOnWindowReady;
    portfolioInteractiveLinks.mkdfOnWindowResize = mkdfOnWindowResize;

    $(window).ready(mkdfOnWindowReady);
    $(window).resize(mkdfOnWindowResize);

    function mkdfOnWindowReady() {
        mkdfInitInteractiveLinkShowcase();
        mkdfInitInteractiveLinkResizing();
        mkdfILSIntroSizing();
        mkdfILSIntroChars();
        mkdfILSIntroScroll();
    }

    function mkdfOnWindowResize() {
        mkdfILSIntroSizing();
    }

    /**
     * Init item showcase shortcode
     */
    function mkdfInitInteractiveLinkShowcase() {
        var interactiveLinkShowcase = $('.mkdf-ips');

        if (interactiveLinkShowcase.length && !mkdf.htmlEl.hasClass('touch')) {
            interactiveLinkShowcase.each(function () {
                var thisInteractiveLinkShowcase = $(this),
                    items = thisInteractiveLinkShowcase.find('.mkdf-ips-item-content');

                // var windowHeight = mkdf.windowWidth > 1024 ? mkdf.windowHeight : mkdf.windowHeight - mkdfGlobalVars.vars.mkdfMobileHeaderHeight;

                if (mkdf.windowWidth > 1024) {
                    // thisInteractiveLinkShowcase.css('height', windowHeight);
                    thisInteractiveLinkShowcase.css('width', mkdf.windowWidth);
                }
                var singleImage = thisInteractiveLinkShowcase.find('.mkdf-ips-item-image'),
                    singleLink = thisInteractiveLinkShowcase.find('.mkdf-ips-item-link');

                singleLink.parent().addClass('loaded');

                singleLink.on('mouseenter', function () {
                    singleImage.removeClass('active');
                    singleLink.parent().removeClass('active');
                    var thisLink = $(this),
                        index = thisLink.parent().index();
                    thisLink.parent().addClass('active');
                    thisLink.parent().siblings().addClass('idle');
                    singleImage.eq(index).addClass('active');
                });

                singleLink.on('mouseleave', function () {
                    singleImage.removeClass('active');
                    singleLink.parent().removeClass('active idle');
                });

                if (thisInteractiveLinkShowcase.hasClass('mkdf-ips-with-scroll')) {
                    var contentHolder = thisInteractiveLinkShowcase.find('.mkdf-ips-content-table-cell'),
                        height = 0,
                        cycle = 0;

                    var paddingAdj = items.first().height();
                    if (mkdf.windowWidth >= 1024 && mkdf.windowWidth < 1440) {
                        // paddingAdj -= 25;
                        paddingAdj = 1;
                    }
                    // console.log(paddingAdj);
                    contentHolder.css('padding-top', paddingAdj);

                    items.each(function () {
                        var item = $(this),
                            visible = false;

                        var showItem = function () {
                            item.removeClass('mkdf-up mkdf-down');
                            item.addClass('mkdf-appeared');
                            visible = true;
                        };

                        var hideItem = function () {
                            item.removeClass('mkdf-appeared');
                            if ((item.offset().top < $(window).scrollTop() + paddingAdj)) {
                                item.removeClass('mkdf-down');
                                item.addClass('mkdf-up');
                            } else {
                                item.removeClass('mkdf-up');
                                item.addClass('mkdf-down');
                            }
                            visible = false;
                        };

                        //init logic
                        if ((item.offset().top >= $(window).scrollTop() + paddingAdj) && (item.offset().top + item.height() < $(window).scrollTop() + $(window).height() - paddingAdj)) {
                            showItem();
                        } else {
                            hideItem();
                        }

                        //scroll logic
                        $(window).scroll(function () {
                            if ((item.offset().top >= $(window).scrollTop() + paddingAdj) && (item.offset().top + item.height() < $(window).scrollTop() + $(window).height() - paddingAdj)) {
                                if (!visible) {
                                    showItem();
                                }
                            } else {
                                if (visible) {
                                    hideItem();
                                }
                            }
                        });
                    });
                }
            });
        }
    }

    function mkdfInitInteractiveLinkResizing() {
        var interactiveLinkShowcase = $('.mkdf-ips');

        if (interactiveLinkShowcase.length) {
            interactiveLinkShowcase.each(function () {
                var thisInteractiveLinkShowcase = $(this),
                    items = thisInteractiveLinkShowcase.find('.mkdf-ips-item-content .mkdf-ips-item-link'),
                    itemsCopy = thisInteractiveLinkShowcase.find('.mkdf-ips-item-content-copy .mkdf-ips-item-link');

                items.each(function (e) {
                    var thisItem = $(this),
                        thisItemCopy = itemsCopy.eq(e),
                        itemFontSize = parseInt(thisItem.css('font-size')),
                        coef1 = 1,
                        coef2 = 1;

                    if (typeof(thisItem.data('font-size')) == 'undefined') {
                        thisItem.data('font-size', itemFontSize);
                    } else {
                        itemFontSize = thisItem.data('font-size');
                    }

                    if (mkdf.windowWidth < 1400) {
                        coef2 = 0.85;
                    }

                    if (mkdf.windowWidth < 1300) {
                        coef1 = 0.8;
                        coef2 = 0.7;
                    }

                    if (mkdf.windowWidth < 1024) {
                        coef1 = 0.7;
                        coef2 = 0.6;
                    }

                    if (mkdf.windowWidth < 769) {
                        coef1 = 0.6;
                        coef2 = 0.5;
                    }

                    if (mkdf.windowWidth < 600) {
                        coef1 = 0.5;
                        coef2 = 0.4;
                    }

                    if (mkdf.windowWidth < 480) {
                        coef1 = 0.4;
                        coef2 = 0.27;
                    }


                    if (itemFontSize > 100) {
                        itemFontSize = Math.round(itemFontSize * coef2);
                    }
                    else if (itemFontSize > 50) {
                        itemFontSize = Math.round(itemFontSize * coef1);
                    }

                    thisItem.css('font-size', itemFontSize + 'px');
                    thisItemCopy.css('font-size', itemFontSize + 'px');
                });
            });
        }

    }

    function mkdfILSIntroSizing() {
        var introSection = $('#mkdf-ips-intro');

        if (introSection.length) {
            var contWidth = introSection.width(),
                txtEl = introSection.find('.mkdf-ips-intro-text'),
                nbChars = txtEl.find('> span').text().length,
                relSize = contWidth / nbChars,
                coeff = 1.6;

            introSection.css('height', mkdf.windowHeight - introSection.offset().top);

            txtEl.css({
                'font-size': relSize * coeff,
                'visibility': 'visible'
            });
        }
    }

    function mkdfILSIntroChars() {
        var intro = $('#mkdf-ips-intro');

        if (intro.length) {
            var txtHolder = intro.find('.mkdf-ips-intro-text span'),
                txt = txtHolder.text(),
                newTxt = txt.replace(/\w|\./g, function (c) {
                    return '<span class="mkdf-char-mask"><span>' + c + '</span></span>';
                });

            txtHolder.html(newTxt);

            var charMasks = intro.find('.mkdf-char-mask'),
                charEls = charMasks.find('span');

            charMasks.each(function (i) {
                var mask = $(this),
                    charEl = mask.find('span');

                if (mask.text() == '.') {
                    mask.addClass('mkdf-dot');
                }

                setTimeout(function () {
                    charEl.addClass('mkdf-appeared');
                }, (i * 150 - 20));
            });

            charMasks.last().find('span').one(mkdf.transitionEnd, function () {
                $(document).trigger('mkdfIntroCharsVisible');
            });
        }
    }

    function mkdfILSIntroScroll() {
        var introSection = $('#mkdf-ips-intro');

        if (introSection.length && !mkdf.htmlEl.hasClass('touch')) {
            var introHolder = introSection,
                introHolderHeight = introHolder.height(),
                introHolderOffset = introHolder.offset().top,
                introArea = introHolderHeight - introHolderOffset,
                pageJumped = false,
                normalScroll = true,
                set = false;

            var mkdfScrollHandler = function () {
                if ($(window).scrollTop() < introArea) {
                    normalScroll = false;
                }

                function mkdfScrollTo() {
                    pageJumped = true;
                    $('header').animate({opacity: 0}, 300, 'easeInOutQuint'); //custom header fade out
                    introSection.parent().addClass('mkdf-remove-intro'); //remove section, no back scroll
                    $('html, body').animate({
                        scrollTop: introArea
                    }, 1000, 'easeInOutQuint', function () {
                        introSection.remove(); //remove section, no back scroll
                        $('html, body').animate({
                            scrollTop: 0
                        }, 0, function () {
                            $('header').animate({opacity: 1}, 'easeInOutQuint', function () {
                                normalScroll = true;
                            }); //custom header fade in
                        });
                    });
                }

                window.addEventListener('wheel', function (event) {
                    var scroll = event.deltaY,
                        scrollingForward = false;

                    if (scroll > 0) {
                        scrollingForward = true;
                    } else {
                        scrollingForward = false;
                    }

                    if (!pageJumped && !normalScroll) {
                        if (scrollingForward && ($(window).scrollTop() < introArea)) {
                            event.preventDefault();
                            mkdfScrollTo();
                        }
                    } else {
                        if (!normalScroll) {
                            event.preventDefault();
                        }
                    }
                });

                //scrollbar click
                $(document).on('mousedown', function (event) {
                    if ($(window).outerWidth() <= event.pageX) {
                        if ($(window).scrollTop() == introHolderOffset) {
                            event.preventDefault();
                            mkdfScrollTo();
                        }
                    }
                });
            }

            //prevent mousewheel scroll
            window.addEventListener('wheel', function (event) {
                if (!set || !pageJumped) {
                    event.preventDefault();
                }
            });

            //prevent scrollbar scroll
            window.addEventListener('scroll', function () {
                if (!set || !pageJumped) {
                    $(window).scrollTop(introHolderOffset);
                }
            });

            //init
            $(document).one('mkdfIntroCharsVisible', function () {
                set = true;
                mkdfScrollHandler();
            });
        }
    }

})(jQuery);
(function($) {
    'use strict';

    var portfolioList = {};
    mkdf.modules.portfolioList = portfolioList;

    portfolioList.mkdfOnWindowLoad = mkdfOnWindowLoad;
    portfolioList.mkdfOnWindowScroll = mkdfOnWindowScroll;

    $(window).load(mkdfOnWindowLoad);
    $(window).scroll(mkdfOnWindowScroll);

    /*
     All functions to be called on $(window).load() should be in this function
     */
    function mkdfOnWindowLoad() {
        mkdfInitPortfolioFilter();
        mkdfInitPortfolioListAnimation();
	    mkdfInitPortfolioPagination().init();
    }

    /*
     All functions to be called on $(window).scroll() should be in this function
     */
    function mkdfOnWindowScroll() {
	    mkdfInitPortfolioPagination().scroll();
    }

    /**
     * Initializes portfolio list article animation
     */
    function mkdfInitPortfolioListAnimation(){
        var portList = $('.mkdf-portfolio-list-holder.mkdf-pl-has-animation');

        if(portList.length){
            portList.each(function(){
                var thisPortList = $(this).children('.mkdf-pl-inner');

                thisPortList.children('article').each(function(l) {
                    var thisArticle = $(this);

                    thisArticle.appear(function() {
                        thisArticle.addClass('mkdf-item-show');

                        setTimeout(function(){
                            thisArticle.addClass('mkdf-item-shown');
                        }, 1000);
                    },{accX: 0, accY: 0});
                });
            });
        }
    }

    /**
     * Initializes portfolio masonry filter
     */
    function mkdfInitPortfolioFilter(){
        var filterHolder = $('.mkdf-portfolio-list-holder .mkdf-pl-filter-holder');

        if(filterHolder.length){
            filterHolder.each(function(){
                var thisFilterHolder = $(this),
                    thisPortListHolder = thisFilterHolder.closest('.mkdf-portfolio-list-holder'),
                    thisPortListInner = thisPortListHolder.find('.mkdf-pl-inner'),
                    portListHasLoadMore = thisPortListHolder.hasClass('mkdf-pl-pag-load-more') ? true : false;

                thisFilterHolder.find('.mkdf-pl-filter:first').addClass('mkdf-pl-current');
	            
	            if(thisPortListHolder.hasClass('mkdf-pl-gallery')) {
		            thisPortListInner.isotope();
	            }

                thisFilterHolder.find('.mkdf-pl-filter').on('click', function(){
                    var thisFilter = $(this),
                        filterValue = thisFilter.attr('data-filter'),
                        filterClassName = filterValue.length ? filterValue.substring(1) : '',
	                    portListHasArticles = thisPortListInner.children().hasClass(filterClassName) ? true : false;

                    thisFilter.parent().children('.mkdf-pl-filter').removeClass('mkdf-pl-current');
                    thisFilter.addClass('mkdf-pl-current');
	
	                if(portListHasLoadMore && !portListHasArticles && filterValue.length) {
		                mkdfInitLoadMoreItemsPortfolioFilter(thisPortListHolder, filterValue, filterClassName);
	                } else {
		                filterValue = filterValue.length === 0 ? '*' : filterValue;
                   
                        thisFilterHolder.parent().children('.mkdf-pl-inner').isotope({ filter: filterValue });
						mkdf.modules.common.mkdfInitParallax();
                    }
                });
            });
        }
    }

    /**
     * Initializes load more items if portfolio masonry filter item is empty
     */
    function mkdfInitLoadMoreItemsPortfolioFilter($portfolioList, $filterValue, $filterClassName) {
        var thisPortList = $portfolioList,
            thisPortListInner = thisPortList.find('.mkdf-pl-inner'),
            filterValue = $filterValue,
            filterClassName = $filterClassName,
            maxNumPages = 0;

        if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
            maxNumPages = thisPortList.data('max-num-pages');
        }

        var	loadMoreDatta = mkdf.modules.common.getLoadMoreData(thisPortList),
            nextPage = loadMoreDatta.nextPage,
	        ajaxData = mkdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'holmes_core_portfolio_ajax_load_more'),
            loadingItem = thisPortList.find('.mkdf-pl-loading');

        if(nextPage <= maxNumPages) {
            loadingItem.addClass('mkdf-showing mkdf-filter-trigger');
            thisPortListInner.css('opacity', '0');

            $.ajax({
                type: 'POST',
                data: ajaxData,
                url: mkdfGlobalVars.vars.mkdfAjaxUrl,
                success: function (data) {
                    nextPage++;
                    thisPortList.data('next-page', nextPage);
                    var response = $.parseJSON(data),
                        responseHtml = response.html;

                    thisPortList.waitForImages(function () {
                        thisPortListInner.append(responseHtml).isotope('reloadItems').isotope({sortBy: 'original-order'});
                        var portListHasArticles = !!thisPortListInner.children().hasClass(filterClassName);

                        if(portListHasArticles) {
                            setTimeout(function() {
	                            mkdf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.mkdf-masonry-grid-sizer').width(), true);
                                thisPortListInner.isotope('layout').isotope({filter: filterValue});
                                loadingItem.removeClass('mkdf-showing mkdf-filter-trigger');

                                setTimeout(function() {
                                    thisPortListInner.css('opacity', '1');
                                    mkdfInitPortfolioListAnimation();
									mkdf.modules.common.mkdfInitParallax();
									mkdf.modules.common.mkdfGrayscale();
                                }, 300);
                            }, 400);
                        } else {
                            loadingItem.removeClass('mkdf-showing mkdf-filter-trigger');
                            mkdfInitLoadMoreItemsPortfolioFilter(thisPortList, filterValue, filterClassName);
							mkdf.modules.common.mkdfGrayscale();
                        }
                    });
                }
            });
        }
    }
	
	/**
	 * Initializes portfolio pagination functions
	 */
	function mkdfInitPortfolioPagination(){
		var portList = $('.mkdf-portfolio-list-holder');
		
		var initStandardPagination = function(thisPortList) {
			var standardLink = thisPortList.find('.mkdf-pl-standard-pagination li');
			
			if(standardLink.length) {
				standardLink.each(function(){
					var thisLink = $(this).children('a'),
						pagedLink = 1;
					
					thisLink.on('click', function(e) {
						e.preventDefault();
						e.stopPropagation();
						
						if (typeof thisLink.data('paged') !== 'undefined' && thisLink.data('paged') !== false) {
							pagedLink = thisLink.data('paged');
						}
						
						initMainPagFunctionality(thisPortList, pagedLink);
					});
				});
			}
		};
		
		var initLoadMorePagination = function(thisPortList) {
			var loadMoreButton = thisPortList.find('.mkdf-pl-load-more a');
			
			loadMoreButton.on('click', function(e) {
				e.preventDefault();
				e.stopPropagation();
				loadMoreButton.fadeOut(100);
				initMainPagFunctionality(thisPortList);
			});
		};
		
		var initInifiteScrollPagination = function(thisPortList) {
			var portListHeight = thisPortList.outerHeight(),
				portListTopOffest = thisPortList.offset().top,
				portListPosition = portListHeight + portListTopOffest - mkdfGlobalVars.vars.mkdfAddForAdminBar;
			
			if(!thisPortList.hasClass('mkdf-pl-infinite-scroll-started') && mkdf.scroll + mkdf.windowHeight > portListPosition) {
				initMainPagFunctionality(thisPortList);
			}
		};
		
		var initMainPagFunctionality = function(thisPortList, pagedLink) {
			var thisPortListInner = thisPortList.find('.mkdf-pl-inner'),
				nextPage,
				maxNumPages;
			
			if (typeof thisPortList.data('max-num-pages') !== 'undefined' && thisPortList.data('max-num-pages') !== false) {
				maxNumPages = thisPortList.data('max-num-pages');
			}
			
			if(thisPortList.hasClass('mkdf-pl-pag-standard')) {
				thisPortList.data('next-page', pagedLink);
			}
			
			if(thisPortList.hasClass('mkdf-pl-pag-infinite-scroll')) {
				thisPortList.addClass('mkdf-pl-infinite-scroll-started');
			}
			
			var loadMoreDatta = mkdf.modules.common.getLoadMoreData(thisPortList),
				loadingItem = thisPortList.find('.mkdf-pl-loading');
			
			nextPage = loadMoreDatta.nextPage;
			
			if(nextPage <= maxNumPages || maxNumPages === 0){
				if(thisPortList.hasClass('mkdf-pl-pag-standard')) {
					loadingItem.addClass('mkdf-showing mkdf-standard-pag-trigger');
					thisPortList.addClass('mkdf-pl-pag-standard-animate');
				} else {
					loadingItem.addClass('mkdf-showing');
				}
				
				var ajaxData = mkdf.modules.common.setLoadMoreAjaxData(loadMoreDatta, 'holmes_core_portfolio_ajax_load_more');
				
				$.ajax({
					type: 'POST',
					data: ajaxData,
					url: mkdfGlobalVars.vars.mkdfAjaxUrl,
					success: function (data) {
						if(!thisPortList.hasClass('mkdf-pl-pag-standard')) {
							nextPage++;
						}
						
						thisPortList.data('next-page', nextPage);
						
						var response = $.parseJSON(data),
							responseHtml =  response.html;
						
						if(thisPortList.hasClass('mkdf-pl-pag-standard')) {
							mkdfInitStandardPaginationLinkChanges(thisPortList, maxNumPages, nextPage);
							
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('mkdf-pl-masonry')){
									mkdfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else if (thisPortList.hasClass('mkdf-pl-gallery') && thisPortList.hasClass('mkdf-pl-has-filter')) {
									mkdfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
									mkdfInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								}
							});
						} else {
							thisPortList.waitForImages(function(){
								if(thisPortList.hasClass('mkdf-pl-masonry')){
								    if(pagedLink === 1) {
                                        mkdfInitHtmlIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        mkdfInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    }
								} else if (thisPortList.hasClass('mkdf-pl-gallery') && thisPortList.hasClass('mkdf-pl-has-filter') && pagedLink !== 1) {
									mkdfInitAppendIsotopeNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
								} else {
								    if (pagedLink === 1) {
                                        mkdfInitHtmlGalleryNewContent(thisPortList, thisPortListInner, loadingItem, responseHtml);
                                    } else {
                                        mkdfInitAppendGalleryNewContent(thisPortListInner, loadingItem, responseHtml);
                                    }
								}
							});
						}
						
						if(thisPortList.hasClass('mkdf-pl-infinite-scroll-started')) {
							thisPortList.removeClass('mkdf-pl-infinite-scroll-started');
						}

						if(nextPage !== maxNumPages){
							thisPortList.find('.mkdf-pl-load-more-holder .mkdf-btn').delay(1000).fadeIn(200);
						}
					}
				});
			}
			
			if(nextPage === maxNumPages){
				thisPortList.find('.mkdf-pl-load-more-holder').hide();
			}
		};
		
		var mkdfInitStandardPaginationLinkChanges = function(thisPortList, maxNumPages, nextPage) {
			var standardPagHolder = thisPortList.find('.mkdf-pl-standard-pagination'),
				standardPagNumericItem = standardPagHolder.find('li.mkdf-pag-number'),
				standardPagPrevItem = standardPagHolder.find('li.mkdf-pag-prev a'),
				standardPagNextItem = standardPagHolder.find('li.mkdf-pag-next a');
				var prevBorder = standardPagHolder.find('li.mkdf-pag-next > span');
				var nextBorder = standardPagHolder.find('li.mkdf-pag-next > span');

			standardPagNumericItem.removeClass('mkdf-pag-active');
			standardPagNumericItem.eq(nextPage-1).addClass('mkdf-pag-active');
			
			standardPagPrevItem.data('paged', nextPage-1);
			standardPagNextItem.data('paged', nextPage+1);
			
			if(nextPage > 1) {
				standardPagPrevItem.css({'opacity': '1'});
                $('.mkdf-prev-border').css({'opacity': '1'});
			} else {
				standardPagPrevItem.css({'opacity': '0'});
                $('.mkdf-prev-border').css({'opacity': '0'});
			}
			
			if(nextPage === maxNumPages) {
				standardPagNextItem.css({'opacity': '0'});
                $('.mkdf-next-border').css({'opacity': '0'});
			} else {
				standardPagNextItem.css({'opacity': '1'});
                $('.mkdf-next-border').css({'opacity': '1'});
			}
		};
		
		var mkdfInitHtmlIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.find('article').remove();
            thisPortListInner.append(responseHtml);
			mkdf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.mkdf-masonry-grid-sizer').width(), true);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('mkdf-showing mkdf-standard-pag-trigger');
			thisPortList.removeClass('mkdf-pl-pag-standard-animate');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				mkdfInitPortfolioListAnimation();
				mkdf.modules.common.mkdfInitParallax();
				mkdf.modules.common.mkdfPrettyPhoto();
				mkdf.modules.common.mkdfGrayscale();
			}, 600);
		};
		
		var mkdfInitHtmlGalleryNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('mkdf-showing mkdf-standard-pag-trigger');
			thisPortList.removeClass('mkdf-pl-pag-standard-animate');
			thisPortListInner.html(responseHtml);
			mkdfInitPortfolioListAnimation();
			mkdf.modules.common.mkdfInitParallax();
			mkdf.modules.common.mkdfPrettyPhoto();
			mkdf.modules.common.mkdfGrayscale();
		};
		
		var mkdfInitAppendIsotopeNewContent = function(thisPortList, thisPortListInner, loadingItem, responseHtml) {
            thisPortListInner.append(responseHtml);
			mkdf.modules.common.setFixedImageProportionSize(thisPortList, thisPortListInner.find('article'), thisPortListInner.find('.mkdf-masonry-grid-sizer').width(), true);
            thisPortListInner.isotope('reloadItems').isotope({sortBy: 'original-order'});
			loadingItem.removeClass('mkdf-showing');
			
			setTimeout(function() {
				thisPortListInner.isotope('layout');
				mkdfInitPortfolioListAnimation();
				mkdf.modules.common.mkdfInitParallax();
				mkdf.modules.common.mkdfPrettyPhoto();
				mkdf.modules.common.mkdfGrayscale();
			}, 600);
		};
		
		var mkdfInitAppendGalleryNewContent = function(thisPortListInner, loadingItem, responseHtml) {
			loadingItem.removeClass('mkdf-showing');
			thisPortListInner.append(responseHtml);
			mkdfInitPortfolioListAnimation();
			mkdf.modules.common.mkdfInitParallax();
			mkdf.modules.common.mkdfPrettyPhoto();
			mkdf.modules.common.mkdfGrayscale();
		};
		
		return {
			init: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('mkdf-pl-pag-standard')) {
							initStandardPagination(thisPortList);
						}
						
						if(thisPortList.hasClass('mkdf-pl-pag-load-more')) {
							initLoadMorePagination(thisPortList);
						}
						
						if(thisPortList.hasClass('mkdf-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
			scroll: function() {
				if(portList.length) {
					portList.each(function() {
						var thisPortList = $(this);
						
						if(thisPortList.hasClass('mkdf-pl-pag-infinite-scroll')) {
							initInifiteScrollPagination(thisPortList);
						}
					});
				}
			},
            getMainPagFunction: function(thisPortList, paged) {
                initMainPagFunctionality(thisPortList, paged);
            }
		};
	}

})(jQuery);
(function ($) {
    'use strict';

    var testimonialsImagePagination = {};
    mkdf.modules.testimonialsImagePagination = testimonialsImagePagination;

    testimonialsImagePagination.mkdfOnDocumentReady = mkdfOnDocumentReady;

    $(document).ready(mkdfOnDocumentReady);

    /* 
     All functions to be called on $(document).ready() should be in this function
     */
    function mkdfOnDocumentReady() {
        mkdfTestimonialsImagePagination();
    }

    /**
     * Init Owl Carousel
     */
    function mkdfTestimonialsImagePagination() {
        var sliders = $('.mkdf-testimonials-image-pagination-inner');

        if (sliders.length) {
            sliders.each(function () {
                var slider = $(this),
                    slideItemsNumber = slider.children().length,
                    loop = true,
                    autoplay = true,
                    autoplayHoverPause = true,
                    sliderSpeed = 3500,
                    sliderSpeedAnimation = 500,
                    margin = 0,
                    stagePadding = 0,
                    center = false,
                    autoWidth = false,
                    animateInClass = false, // keyframe css animation
                    animateOutClass = false, // keyframe css animation
                    navigation = true,
                    pagination = true,
                    drag = true,
                    sliderDataHolder = slider;

                var authorSlider = sliders.parent().find('.mkdf-testimonial-author-slider');

                if (sliderDataHolder.data('enable-loop') === 'no') {
                    loop = false;
                }
                if (typeof sliderDataHolder.data('slider-speed') !== 'undefined' && sliderDataHolder.data('slider-speed') !== false) {
                    sliderSpeed = sliderDataHolder.data('slider-speed');
                }
                if (typeof sliderDataHolder.data('slider-speed-animation') !== 'undefined' && sliderDataHolder.data('slider-speed-animation') !== false) {
                    sliderSpeedAnimation = sliderDataHolder.data('slider-speed-animation');
                }
                if (sliderDataHolder.data('enable-auto-width') === 'yes') {
                    autoWidth = true;
                }
                if (typeof sliderDataHolder.data('slider-animate-in') !== 'undefined' && sliderDataHolder.data('slider-animate-in') !== false) {
                    animateInClass = sliderDataHolder.data('slider-animate-in');
                }
                if (typeof sliderDataHolder.data('slider-animate-out') !== 'undefined' && sliderDataHolder.data('slider-animate-out') !== false) {
                    animateOutClass = sliderDataHolder.data('slider-animate-out');
                }
                // if (sliderDataHolder.data('enable-navigation') === 'no') {
                //     navigation = false;
                // }
                // if (sliderDataHolder.data('enable-pagination') === 'yes') {
                //     pagination = true;
                // }

                if (navigation && pagination) {
                    slider.addClass('mkdf-slider-has-both-nav');
                }

                if (pagination) {
                    var dotsContainer = '#mkdf-testimonial-pagination';
                    $('.mkdf-tsp-item').on('click', function () {
                        slider.trigger('to.owl.carousel', [$(this).index(), 300]);
                        authSlider.trigger('to.owl.carousel', [$(this).index(), 300]);
                    });
                }

                if (slideItemsNumber <= 1) {
                    loop = false;
                    autoplay = false;
                    navigation = false;
                    pagination = false;
                }

                slider.parent().parent().find('.mkdf-testimonal-nav-prev').on('click', function (e) {
                    slider.trigger('prev.owl.carousel');
                });

                slider.parent().parent().find('.mkdf-testimonal-nav-next').on('click', function (e) {
                    slider.trigger('next.owl.carousel');
                });

                // on holder hover in stop
                slider.parent().parent().on('mouseenter', function (e) {
                    slider.trigger('stop.owl.autoplay');
                });

                // on holder hover out play slider
                slider.parent().parent().on('mouseleave', function (e) {
                    slider.trigger('play.owl.autoplay');
                });


                slider.waitForImages(function () {
                    $(this).owlCarousel({
                        items: 1,
                        loop: loop,
                        autoplay: autoplay,
                        autoplayHoverPause: autoplayHoverPause,
                        autoplayTimeout: sliderSpeed,
                        smartSpeed: sliderSpeedAnimation,
                        margin: margin,
                        stagePadding: stagePadding,
                        center: center,
                        autoWidth: autoWidth,
                        animateIn: animateInClass,
                        animateOut: animateOutClass,
                        dots: pagination,
                        dotsContainer: dotsContainer,
                        nav: navigation,
                        drag: drag,
                        callbacks: true,
                        onInitialize: function () {
                            slider.css('visibility', 'visible');
                        },
                        onDrag: function (e) {
                            if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout')) {
                                var sliderIsMoving = e.isTrigger > 0;

                                if (sliderIsMoving) {
                                    slider.addClass('mkdf-slider-is-moving');
                                }
                            }
                        },
                        onDragged: function () {
                            if (mkdf.body.hasClass('mkdf-smooth-page-transitions-fadeout') && slider.hasClass('mkdf-slider-is-moving')) {

                                setTimeout(function () {
                                    slider.removeClass('mkdf-slider-is-moving');
                                }, 500);
                            }
                        }
                    });
                });

                slider.on('change.owl.carousel', function (event) {
                    authSlider.trigger('to.owl.carousel', [event.item.index, 300, true]);
                });

                var authSlider = authorSlider.owlCarousel({
                    loop: loop,
                    autoplay: false,
                    autoplayTimeout: sliderSpeed,
                    smartSpeed: 10,
                    animateIn: 'fadeIn',
                    animateOut: 'fadeOut',
                    autoplayHoverPause: autoplayHoverPause,
                    center: false,
                    dots: pagination,
                    dotsContainer: dotsContainer,
                    nav: false,
                    mouseDrag: false,
                    touchDrag: false,
                    responsive: {
                        0: {
                            items: 1
                        }
                    },
                    onInitialize: function () {
                        authorSlider.css('visibility', 'visible');
                    }
                });
            });
        }
    }

})(jQuery);