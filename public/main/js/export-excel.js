$(function () {
    $('.download-csv').on('click',function (e) {
        e.preventDefault();
        let export_type='payment';
        const url=$(this).data('url');
        if ($("#transaction-history").is(":visible")){
            export_type='transaction'
        }
        let file_name=`${export_type}.xlsx`

        $.ajax({
            url:`${url}?type=${export_type}`,
            xhrFields: {
                responseType: 'blob',
            },
            type:'GET',
            success: function(result, status, xhr) {
                // The actual download
                var blob = new Blob([result], {
                    type: 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
                });
                var link = document.createElement('a');
                link.href = window.URL.createObjectURL(blob);
                link.download = file_name;

                document.body.appendChild(link);

                link.click();
                document.body.removeChild(link);
            },
            error:function (response) {
                console.log(response,'error')
            },
        })

    })


})
