var $ = jQuery.noConflict();

$(document).ready(function () {
    var uaTwo = window.navigator.userAgent;
    var isIETwo = /MSIE|Trident/.test(uaTwo);

    if (isIETwo) {
        document.documentElement.classList.add('ie');
    }

    if (navigator.userAgent.indexOf('Safari') !== -1 &&
        navigator.userAgent.indexOf('Chrome') === -1) {
        $("body").addClass("safari");
    }

    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.scroll_to_top').addClass('active');
        } else {
            $('.scroll_to_top').removeClass('active');
        }
    });

    $('.scroll_to_top').click(function () {
        $("html, body").animate({scrollTop: 0}, "slow");
        return false;
    });


    let Widget_filter = toggleClicker(
        "[data-burger]", // Кликабельный элемент
        "open-menu", // Название класса для active
        "body", // Родитель кликабельного элемента
        false, // Клик вне элемента true | false
        (element, event) => {
            let menu_burger = element.querySelectorAll("[data-burger]");
            for(let i = 0; i < menu_burger.length; i++){
                menu_burger[i].classList.toggle("active");
            }
        },
        false
    );

    let bar_chart = document.querySelectorAll(".bar-chart");
    if(bar_chart.length > 0){
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

        var lineChartData = { datasets: [], labels: labels };
        array_values.forEach(function (a, i) {
            lineChartData.datasets.push({
                label: "Sales",
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
                labels,
                datasets:  lineChartData.datasets
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
                            display: true
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




});
