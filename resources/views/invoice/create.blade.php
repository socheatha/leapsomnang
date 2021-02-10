@extends('layouts.app')

@section('css')
	{{ Html::style('/css/invoice-print-style.css') }}
	<style type="text/css">
	
	</style>
@endsection

@section('content')
<div class="card">
	<div class="card-header">
		<b>{!! Auth::user()->subModule() !!}</b>
		<div class="card-tools">
			<button type="button" class="btn btn-success btn-sm btn-flat" data-toggle="modal" data-target="#create_invoice_item_modal"><i class="fa fa-plus"></i> &nbsp; {!! __('label.buttons.add_item') !!}</button>
			<a href="{{route('invoice.index')}}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-table"></i> &nbsp;{{ __('label.buttons.back_to_list', [ 'name' => Auth::user()->module() ]) }}</a>
		</div>

		<!-- Error Message -->
		@component('components.crud_alert')
		@endcomponent

	</div>

	{!! Form::open(['url' => route('invoice.store'),'method' => 'post','class' => 'mt-3']) !!}
	<div class="card-body">
		@include('invoice.form')

		<ul class="todo-list" data-widget="todo-list">

		</ul>

	</div>
	<!-- ./card-body -->
	
	<div class="card-footer text-muted text-center">
		@include('components.submit')
	</div>
	<!-- ./card-Footer -->
	{{ Form::close() }}

</div>

@include('invoice.modal')

@endsection

@section('js')
<script type="text/javascript">

	// $('[name="item_type"]').change(function () {
		
	// 	if ($(this).val()==2) {

	// 		$('.item_type_select_option').html(`<div class="form-group">
	// 																						{!! Html::decode(Form::label('item_medicine_id', __('label.form.invoice.medicine')." <small>*</small>")) !!}
	// 																						{!! Form::select('item_medicine_id', $medicines, '', ['class' => 'form-control select2 medicine','placeholder' => __('label.form.choose'),'required']) !!}
	// 																					</div>`);
	// 		$('.medicine').select2({
	// 			theme: 'bootstrap4',
	// 		});
	// 		$('[name="item_qty"]').val('');
	// 		$('[name="item_discount"]').val('0').trigger('change');
	// 		$('[name="item_price"]').val('');
	// 		$('[name="item_description"]').val('');

	// 		$('.medicine').change(function () {
	// 			if ($(this).val()!='') {
	// 				var medicine_id = $(this).val();
	// 				$.ajaxSetup({
	// 					headers: {
	// 						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	// 					}
	// 				});
	// 				$.ajax({
	// 					url: "{{ route('medicine.getDetail') }}",
	// 					method: 'post',
	// 					data: {
	// 							id: medicine_id,
	// 					},
	// 					success: function(data){
	// 						$('[name="item_price"]').val( data.medicine.price );
	// 						$('[name="item_qty"]').val( 1 );
	// 						$('[name="item_description"]').val( data.medicine.name );
	// 					}
	// 				});
					
	// 			}
	// 		});

	// 	}else{

	// 		$('.item_type_select_option').html(`<div class="form-group">
	// 																						{!! Html::decode(Form::label('item_service_id', __('label.form.invoice.service')." <small>*</small>")) !!}
	// 																						{!! Form::select('item_service_id', $services, '', ['class' => 'form-control select2 service','placeholder' => __('label.form.choose'),'required']) !!}
	// 																					</div>`);
	// 		$('.service').select2({
	// 			theme: 'bootstrap4',
	// 		});
	// 		$('[name="item_qty"]').val('');
	// 		$('[name="item_discount"]').val('0');
	// 		$('[name="item_price"]').val('');
	// 		$('[name="item_description"]').val('');

	// 		$('.service').change(function () {
	// 			if ($(this).val()!='') {
	// 				var service_id = $(this).val();
	// 				$.ajaxSetup({
	// 					headers: {
	// 						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	// 					}
	// 				});
	// 				$.ajax({
	// 					url: "{{ route('service.getDetail') }}",
	// 					method: 'post',
	// 					data: {
	// 							id: service_id,
	// 					},
	// 					success: function(data){
	// 						$('[name="item_price"]').val( data.service.price );
	// 						$('[name="item_qty"]').val( 1 );
	// 						$('[name="item_description"]').val( data.service.name );
	// 					}
	// 				});
					
	// 			}
	// 		});

	// 	}

	// });

		$('#btn_save_service').click(function () {
			if ($('[name="service_name"]').val()!='' && $('[name="service_price"]').val()!='') {
				$.ajax({
					url: "{{ route('service.createService') }}",
					method: 'post',
					data: {
						name: $('[name="service_name"]').val(),
						price: $('[name="service_price"]').val(),
						description: $('[name="service_description"]').val(),
					},
					success: function(data){
						$('#create_service_modal .invalid-feedback').remove();
						$('#create_service_modal .form-control').removeClass('is-invalid');
						if (data.errors) {
							$.each(data.errors, function(key, value){
								console.log(key);
								$('#create_service_modal .service'+key+' input').addClass('is-invalid');
								$('#create_service_modal .service'+key).append('<span class="invalid-feedback">'+value+'</span>');
							});
							Swal.fire({
								icon: 'error',
								title: "{{ __('alert.swal.result.title.error') }}",
								confirmButtonText: "{{ __('alert.swal.button.yes') }}",
								timer: 1500
							})
						}
						if (data.success) {
							$('[name="service_name"]').val('');
							$('[name="service_price"]').val('');
							$('[name="service_description"]').val('');
							
							$('#create_service_modal').modal('hide');
							reloadSelectService(data.service.id)
							Swal.fire({
								icon: 'success',
								title: "{{ __('alert.swal.result.title.success') }}",
								confirmButtonText: "{{ __('alert.swal.button.yes') }}",
								timer: 1500
							})
						}
					}
				});
			}else{
				Swal.fire({
					icon: 'warning',
					title: "{{ __('alert.swal.title.empty_field') }}",
					confirmButtonText: "{{ __('alert.swal.button.yes') }}",
				})
			}
		});

		function reloadSelectService(id) {
			
			$.ajax({
				url: "{{ route('service.reloadSelectService') }}",
				method: 'post',
				data: {
				},
				success: function(data){
					$('#item_service_id').html(data);

					// $('#item_service_id').select2();
					$('#item_service_id').val(id).trigger('change');

				}
			});
		}


		$(".select2_pagination").change(function () {
			$('[name="txt_search_field"]').val($('.select2-search__field').val());
		});
		
		function select2_search (term) {
			$(".select2_pagination").select2('open');
			var $search = $(".select2_pagination").data('select2').dropdown.$search || $(".select2_pagination").data('select2').selection.$search;
			$search.val(term);
			$search.trigger('keyup');
		}

		$(".select2_pagination").select2({
			theme: 'bootstrap4',
			placeholder: "{{ __('label.form.choose') }}",
			allowClear: true,
			ajax: {
				url: "{{ route('patient.getSelect2Items') }}",
				method: 'post',
				dataType: 'json',
				data: function(params) {
					return {
							term: params.term || '',
							page: params.page || 1
					}
				},
				cache: true
			}
		});


	// $('.medicine').change(function () {
	// 	if ($(this).val()!='') {
	// 		var medicine_id = $(this).val();
	// 		$.ajaxSetup({
	// 			headers: {
	// 				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
	// 			}
	// 		});
	// 		$.ajax({
	// 			url: "{{ route('medicine.getDetail') }}",
	// 			method: 'post',
	// 			data: {
	// 					id: medicine_id,
	// 			},
	// 			success: function(data){
	// 				$('[name="item_price"]').val( data.medicine.price );
	// 				$('[name="item_qty"]').val( 1 );
	// 				$('[name="item_description"]').val( data.medicine.name );
	// 			}
	// 		});
			
	// 	}
	// });

	$('.service').change(function () {
		if ($(this).val()!='') {
			var service_id = $(this).val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: "{{ route('service.getDetail') }}",
				method: 'post',
				data: {
						id: service_id,
				},
				success: function(data){
					$('[name="item_price"]').val( data.service.price );
					$('[name="item_qty"]').val( 1 );
					$('[name="item_description"]').val( data.service.name );
				}
			});
			
		}
	});

	
	$('#btn_add_item').click(function () {

		if ($('[name="item_service_id"]').val() !='' && $('[name="item_price"]').val() !='' && $('[name="item_qty"]').val() !='' && $('[name="item_description"]').val() !='') {	
			var id = Math.floor(Math.random() * 1000);
			$('.todo-list').append(	`<li class="${ id }">
																<input type="hidden" name="medicine_id[]" value="${ (($('[name="item_medicine_id"]').val())? $('[name="item_medicine_id"]').val() : '') }" />
																<input type="hidden" name="service_id[]" value="${ (($('[name="item_service_id"]').val())? $('[name="item_service_id"]').val() : '') }" />
																<input type="hidden" name="price[]" value="${ $('[name="item_price"]').val() }" />
																<input type="hidden" name="discount[]" value="${ $('[name="item_discount"]').val() }" />
																<input type="hidden" name="qty[]" value="${ $('[name="item_qty"]').val() }" />
																<input type="hidden" name="description[]" value="${ $('[name="item_description"]').val() }" />
																<!-- drag handle -->
																<span class="handle">
																	<i class="fas fa-ellipsis-v"></i>
																	<i class="fas fa-ellipsis-v"></i>
																</span>
																<span class="text">${ $('[name="item_description"]').val() }</span>
																<small class="badge badge-danger"><i class="fa fa-dollar-sign"></i> ${ $('[name="item_price"]').val() * $('[name="item_qty"]').val() }</small>
																<div class="tools">
																	<i class="fa fa-times text-danger btn_remove_item" data-id="${ id }"></i>
																</div>
															</li>`);
			$('[name="item_medicine_id"]').val('').trigger('change');
			$('[name="item_service_id"]').val('').trigger('change');
			$('[name="item_price"]').val( '' );
			$('[name="item_discount"]').val( '0' ).trigger('change');
			$('[name="item_qty"]').val( '' );
			$('[name="item_description"]').val( '' );
			// $('#create_invoice_item_modal').modal('hide');

			$('.btn_remove_item').click( function () {
				$('.'+ $(this).data('id')).remove();
			});

		}else{
			Swal.fire({
				icon: 'warning',
				title: "{{ __('alert.swal.title.empty_field') }}",
				text: "{{ __('alert.swal.text.empty_field') }}",
				confirmButtonText: "{{ __('alert.swal.button.yes') }}",
			}).then((result) => {
				if (result.value) {
					$('#create_invoice_item_modal').modal('show');
				}
			})
		}
	});

	$('#patient_id').change(function () {
		if ($(this).val()!='') {
			$.ajax({
				url: "{{ route('patient.getSelectDetail') }}",
				type: 'post',
				data: {
					id : $(this).val()
				},
			})
			.done(function( result ) {
				$('[name="pt_no"]').val(result.patient.no);
				$('[name="pt_name"]').val(result.patient.name);
				$('[name="pt_phone"]').val(result.patient.phone);
				$('[name="pt_age"]').val(result.patient.age);
				$('[name="pt_gender"]').val(result.patient.pt_gender);
			});
		}
		
	});



</script>
@endsection