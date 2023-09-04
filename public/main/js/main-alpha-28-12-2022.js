window.onload = function(){

    $('[data-tab-nav] [data-href').on('click', function(ev) {
        ev.preventDefault();
        $([$(this)[0], $($(this).data('href'))[0]]).addClass('active-tab').siblings('.active-tab').removeClass('active-tab');
    });

    const centerText = {
        id: "centerText",
        afterDatasetsDraw(charts, args, options){
            const {ctx, chartArea: {left, right, top, bottom, width, height}} = charts;
            const text = charts.data.datasets[0].data[0];
            console.log(text);
            ctx.save();

            ctx.font = "bolder 12px Nunito Sans";
            ctx.fillStyle = "#000000";
            ctx.textAlign = "center";
            ctx.fillText(`Total`.toUpperCase(), width / 2, height / 2 + top - 10);
            ctx.restore();

            ctx.font = "800 24px Nunito Sans";
            ctx.fillStyle = "#000000";
            ctx.textAlign = "center";
            ctx.fillText(text, width / 2, height / 2 + 20);
            ctx.restore();

        }
    }
    let donut_chart = document.querySelectorAll(".donut-chart");
    let rented_amount=parseInt($('.rented_amount').text());
    let rented_count=parseInt($('.rented_count').text());
    if(donut_chart.length > 0){
        const data = {
            labels: ['Clothes amount', 'Rented'],
            datasets: [
            {
                label: 'Dataset 1',
                data: [rented_amount,rented_count],
                backgroundColor: [
                    '#FFF275',
                    '#F5F5F5'
                ],
                rotation: 180
            }
        ]};

        let chart = new Chart(document.querySelectorAll(".donut-chart"),
        {
            type: 'doughnut',
            data: data,
            options: {
                legend: {
                    display: false
                },
                tooltips: {
                    enabled: false
                },
                cutoutPercentage: 65,
                responsive: true,
                plugins: {
                    title: {
                        display: true,
                        text: 'Custom Chart Title'
                    },
                    legend: {
                        position: 'top',
                    }
                },
                hover: {mode: null}
            },
            plugins: [centerText]

        });
    }


    let element_hash = $("[data-filter]");

    if(element_hash.length){

        $.each(element_hash, function(index, el){
            let el_link = $(el);
            el_link.on("click", function(ev){
                ev.preventDefault();
                let attr_clickebale = $(this).attr("data-filter");
                let section = $(`li#${attr_clickebale}`);
                $('html').animate({
                    scrollTop: section.offset().top - 104
                }, 500);
            })
        })
    }
}
