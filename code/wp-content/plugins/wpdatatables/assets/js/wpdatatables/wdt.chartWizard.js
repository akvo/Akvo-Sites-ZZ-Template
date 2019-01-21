if (typeof constructedChartData == 'undefined') {
    var constructedChartData = {};
}

var wdtChartColumnsData = {};


(function ($) {
    var wdtChartPickerDragStart = 0;
    var wdtChartPickerDragEnd = 0;
    var wdtChartPickerIsDragging = false;
    var wdtChart = null;
    var nextStepButton = $('#wdt-chart-wizard-next-step');

    $('.wdt-chart-wizard-chart-selecter-block .card').on('click', function () {
        $('.wdt-chart-wizard-chart-selecter-block .card').removeClass('selected').addClass('not-selected');
        $(this).addClass('selected').removeClass('not-selected');

        
    });

    

    /**
     * Pick the chart type
     */
    $('#chart-render-engine').change(function (e) {
        e.preventDefault();

        

        $('.wdt-chart-wizard-chart-selecter-block .card').removeClass('selected').removeClass('not-selected');
        $('div.charts-type').hide();
        if ($(this).val() != '') {
            constructedChartData.chart_engine = $(this).val();
            if ($(this).val() == 'google') {
                $('div.google-charts-type').show();
            } else if ($(this).val() == 'highcharts') {
                $('div.highcharts-charts-type').show();
            } else if ($(this).val() == 'chartjs') {
                $('div.chartjs-charts-type').show();
            }
        }
    });

    

})(jQuery);

