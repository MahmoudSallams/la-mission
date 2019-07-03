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