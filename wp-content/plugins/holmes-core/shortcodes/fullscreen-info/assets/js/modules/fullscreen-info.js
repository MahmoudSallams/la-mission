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