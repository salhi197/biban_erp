$(function(e) {
	
	//datatable-1
	$('#datable-1').DataTable({
        pageLength: 15,
    });
	
	//datatable-2
	var table = $('#datatable-2').DataTable({
        pageLength: 20
    });
	
	//datatable-3
	$('#datatable-3').DataTable( {
		"scrollY":        "200px",
		"scrollCollapse": true,
        "paging":         false,
        "pageLength": 15,

	});

	//datatable-4
	$('#datatable-4').DataTable( {
        pageLength: 15,
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal( {
					header: function ( row ) {
						var data = row.data();
						return 'Details for '+data[0]+' '+data[1];
					}
				} ),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
					tableClass: 'table'
				} )
			}
		}
	});
	
	//datatable-5
	var table = $('#datatable-5').DataTable( {
        pageLength: 15,
        lengthChange: false,
        order: [[ 0, "desc" ]],
        language: {
            search: "Entrer le code du camion"
        },        
        buttons: [ 'copy', 'excel', 'pdf', 'colvis' ],
	});
	table.buttons().container()
	.appendTo( '#datatable-5_wrapper .col-md-6:eq(0)');
	
	//datatbale-6
	$('#datatbale-6').DataTable( {
        pageLength: 15,
		responsive: {
			details: {
				display: $.fn.dataTable.Responsive.display.modal( {
					header: function ( row ) {
						var data = row.data();
						return 'Details for '+data[0]+' '+data[1];
					}
				} ),
				renderer: $.fn.dataTable.Responsive.renderer.tableAll( {
					tableClass: 'table'
				} )
			}
		}
	} );
	
	//datatbale-7
	$('#datatbale-7').DataTable({
        pageLength: 15,
    });
	
	//datatbale-8
	$('#datatbale-8').DataTable({
        pageLength: 15,
		responsive: true,
		language: {
			searchPlaceholder: 'Search...',
			sSearch: '',
			lengthMenu: '_MENU_ items/page',
		}
	});
	
	//datatbale-9
	$('#datatbale-9').DataTable({
        pageLength: 15,
		bLengthChange: false,
		searching: false,
		responsive: true
	});
});