$(document).ready(function () {
    const renters_table=$("#renters-table");

    let table = renters_table.DataTable({
        order: [[ 0, "desc" ]],
        serverSide: true,
        ajax: {
			url: renters_table.data('url')
		},
        columns: [
            { data: 'renter', name: 'renter' },
            { data: 'period', name: 'period' },
            { data: 'violation', name: 'violation' },
            { data: 'total_paid', name: 'total_paid' },
        ]
    });
});
