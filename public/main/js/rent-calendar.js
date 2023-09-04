$(document).ready(function () {
    const rent = $('.rent-popup');
    let day=null;
    let url='';
    let selected_date=null;
    let start_date=null;
    let end_date=null;
    rent.on('click', function (e) {
        e.preventDefault();
        day = parseInt($(this).data('day'));
        url = $(this).attr('href');
    })
    let locale = {
        days: ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'],
        daysShort: ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'],
        daysMin: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
        months: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        monthsShort: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        today: 'Today',
        clear: 'Clear',
        dateFormat: 'E MMM yyyy',
        timeFormat: 'hh:mm aa',
    };
    let datepicker_data=new AirDatepicker('#rent-calendar', {
        inline: true,
        locale,
        minDate: new Date()
    })
    $('.rent-now').on('click',function (e) {
        e.preventDefault();
        selected_date=datepicker_data.selectedDates[0]??new Date();
        let start_date=dateParser(selected_date);
        let end_date= dateParser(
            new Date(selected_date.setDate(selected_date.getDate()+day))
        );
        window.location.href=`${url}?start_date=${start_date}&end_date=${end_date}`

    })
    $('.air-datepicker-cell').on('click',function (){
        const year=$(this).data('year');
        const month=$(this).data('month')+1;
        const selected_day=$(this).text();
        const arrived_date=new Date(`${year}-${month}-${selected_day}`)
        const return_date=new Date(arrived_date)
        return_date.setDate(return_date.getDate()+day)

        const options = {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };

        let formattedDate_arrived = arrived_date.toLocaleString('en-US', options);
        const day_selected_arrived = arrived_date.getDay();
        const daySuffix_arrived = getDaySuffix(day_selected_arrived);
        formattedDate_arrived=formattedDate_arrived.replace(/\b(\d+)\b/, '$1' + daySuffix_arrived);

        let formattedDate_return = return_date.toLocaleString('en-US', options);
        const day_selected_return = return_date.getDay();
        const daySuffix_return = getDaySuffix(day_selected_return);
        formattedDate_return=formattedDate_return.replace(/\b(\d+)\b/, '$1' + daySuffix_return);

        $('.arrive-date').text(`Arrives by ${formattedDate_arrived}`)
        $('.return-date').text(`Return by ${formattedDate_return}`)

    })
    function dateParser(date){
        let year=date.getFullYear();
        let month=date.getMonth()+1;
        month=month<10 ? `0${month}` : month
        let day=date.getDate();
        day=day<10 ? `0${day}` : day
        return `${year}-${month}-${day}`
    }

    function formattedDate(date){
        const options = {
            weekday: 'long',
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        };

        let formattedDate = date.toLocaleString('en-US', options);


        const day_selected = date.getDay();
        const daySuffix = getDaySuffix(day_selected);
        return formattedDate.replace(/\b(\d+)\b/, '$1' + daySuffix);
    }

    function getDaySuffix(day) {
        if (day >= 11 && day <= 13) {
            return 'th';
        }

        var lastDigit = day % 10;

        switch (lastDigit) {
            case 1:
                return 'st';
            case 2:
                return 'nd';
            case 3:
                return 'rd';
            default:
                return 'th';
        }
    }
});
