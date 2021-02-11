@extends('layouts.app')

@section('css')
<link href="{{ asset('/css/daterangepicker.css') }}" rel="stylesheet">
{{ Html::style('/css/prescription-print-style.css') }}
<style type="text/css">
	/* .btn-print-prescription{
		position: absolute;
		top: 5px;
		right: 35px;
	} */
	div.prescription-detail-expanded{
		position: relative;
	}
	.dt-server td{
		vertical-align: middle;
	}
</style>
@endsection

@section('content')
	<div class="card">
		<div class="card-header">
			<b>{!! Auth::user()->subModule() !!}</b>
			
			<div class="card-tools">
				<a href="{{route('prescription.create')}}" class="btn btn-sm btn-success btn-flat"><i class="fa fa-plus"></i> &nbsp;{{ __('label.buttons.create') }}</a>
			</div>

			<!-- Error Message -->
			@component('components.crud_alert')
			@endcomponent

		</div>

		<div class="card-body">

			<div class="row justify-content-center">
				<div class="col-sm-3">
					<div class="form-group">
						{!! Html::decode(Form::label('date', __('label.form.prescription.choose_date')." <small>*</small>")) !!}
						<div class="input-group">
							<div class="input-group-prepend">
								<span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
							</div>
							<input type="text" class="form-control pull-right" id="dateRangePicker" autocomplete="off">
							<input type="hidden" class="form-control" id="from">
							<input type="hidden" class="form-control" id="to">
						</div>
					</div>
				</div>
			</div>
			
      <table class="table table-bordered dt-server expandable-table" width="100%" id="prescription_table">
				<thead>
					<tr>
						{{-- <th class="text-center" width="30px"></th> --}}
						<th class="text-center" width="8%">{!! __('module.table.prescription.code') !!}</th>
						<th class="text-center" width="8%">{!! __('module.table.date') !!}</th>
						<th class="text-center" width="25%">{!! __('module.table.prescription.pt_name') !!}</th>
						<th class="text-center" width="10%">{!! __('module.table.prescription.pt_phone') !!}</th>
						<th width="12%" class="text-center">{!! __('module.table.action') !!}</th>
					</tr>
				</thead>
				<tbody>
					
				</tbody>
			</table>
		</div>

    <span class="sr-only" id="deleteAlert" data-title="{{ __('alert.swal.title.delete', ['name' => Auth::user()->module()]) }}" data-text="{{ __('alert.swal.text.unrevertible') }}" data-btnyes="{{ __('alert.swal.button.yes') }}" data-btnno="{{ __('alert.swal.button.no') }}" data-rstitle="{{ __('alert.swal.result.title.success') }}" data-rstext="{{ __('alert.swal.result.text.delete') }}"> Delete Message </span>

	</div>

	{{-- Password Confirm modal --}}
	@component('components.confirm_password')@endcomponent
	
@endsection

@section('js')
	<script src="{{ asset('/js/daterangepicker.js') }}"></script>
	<script type="text/javascript">

		
		$('#dateRangePicker').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().startOf('month'),
        endDate  : moment().endOf('month')
      },
      function (start, end) {
        $('#from').val(start.format('YYYY-MM-DD'));
        $('#to').val(end.format('YYYY-MM-DD'));
        getDatatable(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'))
      }
    )
    // $('#dateRangePicker').val('');

	
		getDatatable(moment().startOf('month').format('YYYY-MM-DD'), moment().endOf('month').format('YYYY-MM-DD'));


		function getDatatable(from, to) {
			// Load Data to datatable
			$('#prescription_table').DataTable().destroy();
			dataTablePrescription = $('#prescription_table').DataTable({
				"language": (('{{ session('locale') }}' == 'en')? '' : datatableKH),
				processing: true,
				serverSide: true,
				"lengthMenu": [[10, 50, 100, -1], [10, 50, 100, "All"]],
				"order": [[ 0, "asc" ]],
				ajax: {
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					},
					url: '{{ route('prescription.getDatatable') }}',
					data: { 'from' : from, 'to' : to },
					type: 'post',
					dataSrc: function(json) { return json.data;  }
				},
				columns: [
					// {data: 'row_detail', defaultContent: '<i class="fa fa-plus-circle text-primary"></i>', className: 'details-control text-center', searchable: false, sortable: false },
					{data: 'code', name: 'code', className: 'text-center'},
					{data: 'date', name: 'date', className: 'text-center'},
					{data: 'pt_name', name: 'pt_name'},
					{data: 'pt_phone', name: 'pt_phone'},
					{data: 'actions', name: 'actions', className: 'text-right', searchable: false, sortable: false}
				],
				order: [[1, "desc"]],
				rowCallback: function( row, data ) {

					$('td:eq(4)', row).html( `@Can("Prescription Edit")
																			<button type="button" data-url="/prescription/${ data.id }/print" class="btn btn-sm btn-flat btn-success btn-print-prescription"><i class="fa fa-print"></i></button>
																		@endCan 
																		@Can("Prescription Edit")
																			<a href="/prescription/${ data.id }/edit" class="btn btn-sm btn-flat btn-info"><i class="fa fa-pencil-alt"></i></a>
																		@endCan 
																		@Can("Prescription Delete")
																			<button type="button" class="btn btn-sm btn-flat btn-danger BtnDeleteConfirm" value="${ data.id }"><i class="fa fa-trash-alt"></i></button>
																			<form action="/prescription/${ data.id }/delete" id="form-item-${ data.id }" class="sr-only" method="POST" accept-charset="UTF-8">
																				{{ csrf_field() }}
																				<input type="hidden" name="_method" value="DELETE" />
																				<input type="hidden" name="passwordDelete" value="" />
																			</form>
																		@endCan` );

				},
				"initComplete": function( settings, json ) {

					$('#prescription_table [type="search"]').addClass('sr-only');
					$('#prescription_table_search_input').remove();
					$('#prescription_table_table_filter').append('<input type="text" class="form-control input-sm" id="prescription_table_search_input">');
					$('#prescription_table_search_input').keyup(function (e) {
						if (e.keyCode === 13) {
							$('#prescription_table [type="search"]').val($(this).val()).keyup();
						}
					});

					setTimeout( function () {
						if ($('[name="txt_filter_search"]').val() != '' ) {
							$('#prescription_table_search_input').val($('[name="txt_filter_search"]').val());
							$('#prescription_table [type="search"]').val($('[name="txt_filter_search"]').val()).keyup();
							$('[name="txt_filter_search"]').val('');
						}

					}, 250);

				},
				"drawCallback": function( settings, json ) {

					// Change Status button Click
					$('.btn_status').click(function () {
						var btn_status = $(this);
						const swalWithBootstrapButtons = Swal.mixin({
							customClass: {
								confirmButton: 'btn btn-success btn-flat ml-2 py-2 px-3',
								cancelButton: 'btn btn-danger btn-flat mr-2 py-2 px-3'
							},
							buttonsStyling: false
						})
						swalWithBootstrapButtons.fire({
						title: '{{ __("alert.swal.title.status") }}',
						icon: 'question',
						showCancelButton: true,
						confirmButtonText: '{{ __("alert.swal.button.yes") }}',
						cancelButtonText: '{{ __("alert.swal.button.no") }}',
						reverseButtons: true
						}).then((result) => {
							if (result.value) {
								$.ajax({
									url: "/prescription/"+ btn_status.data('id') +"/status",
									type: 'post',
									data: {  },
								})
								.done(function( data ) {
									Swal.fire({
										icon: 'success',
										title: "{{ __('alert.swal.result.title.success') }}",
										confirmButtonText: "{{ __('alert.swal.button.yes') }}",
										timer: 1500
									})
									.then((result) => {
										btn_status.removeClass( ((data.status == 1)? 'btn-danger' : 'btn-success')).addClass(((data.status == 1)? 'btn-success' : 'btn-danger'));
									})
								});
							}
						})

					});

					$('.BtnDeleteConfirm').click(function () {
						$('#item_id').val($(this).val());
						$('#modal_confirm_delete').modal();
					});

					$('.submit_confirm_password').click(function () {
						var id = $('#item_id').val();
						var password_confirm = $('#password_confirm').val();
						$('[name="passwordDelete"]').val(password_confirm);
						if (password_confirm!='') {
							$.ajax({
								url: "{{ route('user.password_confirm') }}",
								type: 'post',
								data: {id:id, _token:'{{ csrf_token() }}', password_confirm:password_confirm},
							})
							.done(function( result ) {
									if(result == true){
										Swal.fire({
											icon: 'success',
											title: "{{ __('alert.swal.result.title.success') }}",
											confirmButtonText: "{{ __('alert.swal.button.yes') }}",
											timer: 1500
										})
										.then((result) => {
											$( "form" ).submit(function( event ) {
												$('button').attr('disabled','disabled');
											});
											$('[name="passwordDelete"]').val(password_confirm);
											$("#form-item-"+id).submit();
										})
									}else{
										Swal.fire({
											icon: 'warning',
											title: "{{ __('alert.swal.result.title.wrong',['name'=>'ពាក្យសម្ងាត់']) }}",
											confirmButtonText: "{{ __('alert.swal.button.yes') }}",
											timer: 2500
										})
										.then((result) => {
											$('#modal_confirm_delete').modal();
										})
									}
							});
						}else{
							Swal.fire({
								icon: 'warning',
								title: "{{ __('alert.swal.title.empty') }}",
								confirmButtonText: "{{ __('alert.swal.button.yes') }}",
								timer: 1500
							})
							.then((result) => {
								$('#modal_confirm_delete').modal();
							})
						}
					});
					
					function openPrintWindow(url, name) {
						var printWindow = window.open(url, name, "width="+ screen.availWidth +",height="+ screen.availHeight +",_blank");
						var printAndClose = function () {
							if (printWindow.document.readyState == 'complete') {
								clearInterval(sched);
								printWindow.print();
								printWindow.close();
							}
						}  
							var sched = setInterval(printAndClose, 2000);
					};

					jQuery(document).ready(function ($) {
						$(".btn-print-prescription").on("click", function (e) {
							var myUrl = $(this).attr('data-url');
							e.preventDefault();
							openPrintWindow(myUrl, "to_print");
						});
					});
				}
			});
		}


		// function getDetail ( data ) {

		// 	var div =  $('<div/>').text('loading...').addClass('prescription-detail-expanded');
		// 	$.ajaxSetup({headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
		// 	$.ajax({
		// 		url: "{{ route('prescription.getPrescriptionPreview') }}",
		// 		method: 'post',
		// 		data: {
		// 		 id: data.id,
		// 		},
		// 		success: function(rs){
		// 			div.empty();
		// 			var htmlString = "";
		// 			htmlString =  rs.prescription_detail;
		// 			div.append(htmlString);
		// 			div.append('@can("Prescription Print")<button type="button" class="btn btn-flat btn-success btn-print-prescription" data-url="/prescription/'+ rs.prescription_id +'/print" data-title="'+ rs.title +'"><i class="fa fa-print"></i> {{ __("label.buttons.print") }}</button>@endCan');

		// 			$(function(){
		// 				function openPrintWindow(url, name) {
		// 					var printWindow = window.open(url, name, "width="+ screen.availWidth +",height="+ screen.availHeight +",_blank");
		// 					var printAndClose = function () {
		// 						if (printWindow.document.readyState == 'complete') {
		// 							clearInterval(sched);
		// 							printWindow.print();
		// 							printWindow.close();
		// 						}
		// 					}  
		// 						var sched = setInterval(printAndClose, 2000);
		// 				};

		// 				jQuery(document).ready(function ($) {
		// 					$(".btn-print-prescription").on("click", function (e) {
		// 						var myUrl = $(this).attr('data-url');
		// 						e.preventDefault();
		// 						openPrintWindow(myUrl, "to_print");
		// 					});
		// 				});
		// 			});

		// 			$('#print-prescription').html(htmlString);

		// 		},
		// 		error: function () {
		// 			Swal.fire({
		// 			  icon: 'error',
		// 			  title: 'Oops...',
		// 			  text: 'Something went wrong!',
		// 			})
		// 		}
		// 	});
		// 	return div;
		// }

		// // Add event listener for opening and closing details
		// $('.expandable-table tbody').on('click', 'td.details-control', function () {
		// 	var tr = $(this).closest('tr');
		// 	var row = dataTablePrescription.row( tr );
		// 	if ( row.child.isShown() ) {
		// 		// This row is already open - close it
		// 		row.child.hide();
		// 		tr.removeClass('shown');
		// 		tr.find('td.details-control').html('<i class="fa fa-plus-circle text-primary"></i>');
		// 	}else {
		// 		dataTablePrescription.rows().every(function(){
		// 			// If row has details expanded
		// 			if(this.child.isShown()){
		// 				// Collapse row details
		// 				this.child.hide();
		// 				$(this.node()).removeClass('shown');
		// 				$(this.node()).find('td.details-control').html('<i class="fa fa-plus-circle text-primary"></i>');
		// 			}
		// 		});
		// 		row.child( getDetail( row.data() ) ).show();
		// 		tr.addClass('shown');
		// 		tr.find('td.details-control').html('<i class="fa fa-minus-circle text-danger"></i>');
		// 	}

		// });

	</script>
@endsection