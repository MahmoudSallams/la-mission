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