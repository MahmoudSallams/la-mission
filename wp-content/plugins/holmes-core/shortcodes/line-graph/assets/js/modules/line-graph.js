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