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