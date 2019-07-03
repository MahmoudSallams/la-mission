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
