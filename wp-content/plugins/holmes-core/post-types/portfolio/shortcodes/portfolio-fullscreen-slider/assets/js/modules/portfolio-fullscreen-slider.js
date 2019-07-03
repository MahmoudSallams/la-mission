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