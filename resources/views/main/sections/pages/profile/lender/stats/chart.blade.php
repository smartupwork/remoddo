<div class="col-lg-6 col-md-6 mt-30 d-flex">
    <div class="widget-profile">
        <div class="widget--header">
            <div class="widget--option">
                <h4 class="def-text-1 fw-800 -ttu mb-12 mr-12">
                    Chart for sales data accross {{$selectedDay}}
                </h4>
            </div>
        </div>
        <div class="widget--body">
            <div class="widget-element">
                <canvas class="bar-chart" id="statistic_chart"
                        data-chart-labels="{{$chart_labels}}"
                        data-chart-values="{{$chart_values}}"
                ></canvas>
            </div>
        </div>
    </div>
</div>
