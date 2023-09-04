$('.select2').select2()

$('.status-checked .select2').on('select2:select', function (e) {
    var data = e.params.data;
    let {target} = e
    if (data.text.toLowerCase() != 'pending') {
        $(target).parent().find('.pending-icon').addClass('d-none')
    } else {
        $(target).parent().find('.pending-icon').removeClass('d-none')
    }

})

$('#summernote').summernote()

$('.lock-action').click(function (ev) {
    ev.preventDefault();
    let next_btn = $(this).siblings('.lock-action');
    next_btn.removeClass("d-none");
    //$('.lock-action').removeClass('d-none')
    $(this).addClass('d-none');
})
$('.date-period').daterangepicker()
$('.datepicker-single').daterangepicker({
    singleDatePicker: true
});
let save_input = $(".input-save");
$.each(save_input, function (index, element) {

    let el = $(element);
    let el_save = el.find(".btn.btn-save");
    let el_edit = el.find(".btn.btn-edit");

    el_save.on("click", function (ev) {
        ev.preventDefault();
        if (el.hasClass("active--adit")) {
            const url = $("#user_info").data('url')
            const input = $(el.children().first());
            const value = input.val()
            const user_field = input.attr('name');
            const data = {_method: 'PATCH'};
            data[user_field] = value;

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url,
                type: "PATCH",
                data,
                success:function (res){
                    el.removeClass("active--adit");
                    el.parent().find('.text-danger').remove()
                },
                error:function (res){
                    el.parent().find('.text-danger').remove()
                    el.parent().append(`<span class="text-danger">${res.responseJSON.message}</span>`)
                }
            });

        }
    })
    el_edit.on("click", function (ev) {
        ev.preventDefault();
        el.addClass("active--adit");
    })
})

let bar_chart = document.querySelectorAll(".bar-chart");
if (bar_chart.length > 0) {

    // matrix
    const statistic_chart=$("#statistic_chart");

    let chart_labels=statistic_chart.data('chart-labels').split(',');
    let chart_values=statistic_chart.data('chart-values').split(',');


    const data=[];

    chart_values.map(function (value){
        if (value>0){
            data.push([value])
        }
    })

    // matrix
    let labels = chart_labels;
    let array_values = data;
    // matrix

    var lineChartData = {datasets: [], labels: labels};
    array_values.forEach(function (a, i) {
        lineChartData.datasets.push({
            label: "Data Name",
            data: a,
            borderWidth: 0,
            backgroundColor: '#5E34AD',
            barPercentage: 0.60,
            categoryPercentage: 1,
            borderRadius: 10
        })
    })

    Chart.defaults.plugins.legend.display = false;
    let chart = new Chart(document.querySelectorAll(".bar-chart"), {
        type: 'bar',
        data: {
            labels: ['22 Jul', '1 Aug', '8 Aug', '15 Aug', '22 Aug'],
            datasets: lineChartData.datasets
        },
        options: {
            responsive: true,
            layout: {
                padding: {
                    top: 20,
                    left: 10,
                    right: 10
                }
            },
            scales: {
                y: {
                    ticks: {
                        display: false
                    },
                    display: false
                },
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: "rgba(0, 0, 0, 0.4)",
                        font: {
                            family: "'Nunito Sans', sans-serif",
                            size: 12,
                            weight: 800
                        }
                    }
                }
            }
        }

    });


}

// popover
$('[data-tooltip="popover"]').popover({
    trigger: 'hover'
})

$(function () {
    $('#reservation').daterangepicker();
});


$(".js-example-basic-multiple").select2({});
