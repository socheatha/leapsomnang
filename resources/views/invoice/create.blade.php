@extends('layouts.app')

@section('css')
	<style type="text/css">
	</style>
@endsection

@section('content')
<div class="card">
	<div class="card-header">
		<b>{!! Auth::user()->subModule() !!}</b>
		<div class="card-tools">
			<button type="button" class="btn btn-primary btn-sm btn-flat" data-toggle="modal" data-target="#create_service_modal"><i class="fa fa-plus-circle"></i> {!! __('label.buttons.create_service') !!}</button>
			<a href="{{route('invoice.index')}}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-table"></i> &nbsp;{{ __('label.buttons.back_to_list', [ 'name' => Auth::user()->module() ]) }}</a>
		</div>

		<!-- Error Message -->
		@component('components.crud_alert')
		@endcomponent

	</div>

	{!! Form::open(['url' => route('invoice.store'),'id' => 'submitForm','method' => 'post','class' => 'mt-3']) !!}
	<div class="card-body">
		@include('invoice.form')

		<div class="card card-outline card-primary mt-4">
			<div class="card-header">
				<h3 class="card-title">
					<i class="fas fa-list"></i>&nbsp;
					{{ __('alert.modal.title.invoice_detail') }}
				</h3>
				<div class="card-tools">
					{{-- <button type="button" class="btn btn-success btn-sm btn-flat" id="btn_add_item"><i class="fa fa-plus"></i> &nbsp; {!! __('label.buttons.add_item') !!}</button> --}}
					<button type="button" class="btn btn-flat btn-sm btn-success btn-prevent-submit" data-toggle="modal" data-target="#create_invoice_item_modal"><i class="fa fa-plus"></i> {!! __('label.buttons.add_item') !!}</button>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body item_list">
				<div class="mb-2" id="first-item">
					<div class="row">
						<div class="col-sm-4">
							<div class="form-group">
								{!! Html::decode(Form::label('service_id', __('label.form.invoice.service')." <small>*</small>")) !!}
								{!! Form::select('service_id[]', $services, '', ['class' => 'form-control select2 service', 'data-id'=>'first-item', 'id'=>'input-service_id-first-item','placeholder' => __('label.form.choose'),'required']) !!}
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								{!! Html::decode(Form::label('discount', __('label.form.invoice.discount')." <small>*</small>")) !!}
								{!! Form::select('discount[]', ['0'=>'0%', '0.05'=>'5%', '0.1'=>'10%', '0.15'=>'15%', '0.2'=>'20%', '0.25'=>'25%', '0.3'=>'30%', '0.35'=>'35%', '0.4'=>'40%', '0.45'=>'45%', '0.5'=>'50%', '0.55'=>'55%', '0.6'=>'60%', '0.65'=>'65%', '0.7'=>'70%', '0.75'=>'75%', '0.8'=>'80%', '0.85'=>'85%', '0.9'=>'90%', '0.95'=>'95%', '1'=>'100%'], '0', ['class' => 'form-control select2', 'id'=>'input-discount-first-item','required']) !!}
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								{!! Html::decode(Form::label('price', __('label.form.invoice.price')."($) <small>*</small>")) !!}
								{!! Form::text('price[]', '', ['class' => 'form-control', 'id'=>'input-price-first-item','placeholder' => 'price','required']) !!}
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								{!! Html::decode(Form::label('description', __('label.form.description')." <small>*</small>")) !!}
								{!! Form::textarea('description[]', '', ['class' => 'form-control', 'id'=>'input-description-first-item','placeholder' => 'description','style' => 'height: 38px','required']) !!}
							</div>
						</div>
						<div class="col-sm-1">
							<div class="form-group">
								{!! Html::decode(Form::label('', __('label.buttons.remove'))) !!}
								<div>
									<button class="btn btn-danger btn-flat btn-block btn-prevent-submit" onclick="removeItem('first-item')"><i class="fa fa-trash-alt"></i></button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /.card-body -->
		</div>

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

	$('.btn-prevent-submit').click(function (event) {
		event.preventDefault();
	});
	
	$('#btn_add_item').click(function () {

		if ($('[name="item_service_id"]').val()!='' && $('[name="item_discount"]').val()!='' && $('[name="item_price"]').val()!='' && $('[name="item_description"]').val()!='') {
			
			var service_id = $('[name="item_service_id"]').val();
			var discount = $('[name="item_discount"]').val();
			var price = $('[name="item_price"]').val();
			var description = $('[name="item_description"]').val();
	
			var id = Math.floor(Math.random() * 1000);
			$('.item_list').append(`<div class="mb-2" id="${ id }">
																<div class="row">
																	<div class="col-sm-4">
																		<div class="form-group">
																			{!! Html::decode(Form::label('service_id', __('label.form.invoice.service')." <small>*</small>")) !!}
																			{!! Form::select('service_id[]', $services, '', ['class' => 'form-control service_add', 'data-id'=>'${ id }', 'id'=>'input-service_id-${ id }','placeholder' => __('label.form.choose'),'required']) !!}
																		</div>
																	</div>
																	<div class="col-sm-2">
																		<div class="form-group">
																			{!! Html::decode(Form::label('discount', __('label.form.invoice.discount')." <small>*</small>")) !!}
																			{!! Form::select('discount[]', ['0'=>'0%', '0.05'=>'5%', '0.1'=>'10%', '0.15'=>'15%', '0.2'=>'20%', '0.25'=>'25%', '0.3'=>'30%', '0.35'=>'35%', '0.4'=>'40%', '0.45'=>'45%', '0.5'=>'50%', '0.55'=>'55%', '0.6'=>'60%', '0.65'=>'65%', '0.7'=>'70%', '0.75'=>'75%', '0.8'=>'80%', '0.85'=>'85%', '0.9'=>'90%', '0.95'=>'95%', '1'=>'100%'], '0', ['class' => 'form-control select2', 'id'=>'input-discount-${ id }','required']) !!}
																		</div>
																	</div>
																	<div class="col-sm-2">
																		<div class="form-group">
																			{!! Html::decode(Form::label('price', __('label.form.invoice.price')."($) <small>*</small>")) !!}
																			{!! Form::text('price[]', '', ['class' => 'form-control', 'id'=>'input-price-${ id }','placeholder' => 'price','required']) !!}
																		</div>
																	</div>
																	<div class="col-sm-3">
																		<div class="form-group">
																			{!! Html::decode(Form::label('description', __('label.form.description')." <small>*</small>")) !!}
																			{!! Form::textarea('description[]', '', ['class' => 'form-control', 'id'=>'input-description-${ id }','placeholder' => 'description','style' => 'height: 38px','required']) !!}
																		</div>
																	</div>
																	<div class="col-sm-1">
																		<div class="form-group">
																			{!! Html::decode(Form::label('', __('label.buttons.remove'))) !!}
																			<div>
																				<button class="btn btn-danger btn-flat btn-block btn-prevent-submit" onclick="removeItem(${ id })"><i class="fa fa-trash-alt"></i></button>
																			</div>
																		</div>
																	</div>
																</div>
															</div>`);

			Swal.fire({
				icon: 'success',
				title: "{{ __('alert.swal.result.title.success') }}",
				confirmButtonText: "{{ __('alert.swal.button.yes') }}",
				timer: 1500
			})
			$('[name="item_service_id"]').val('').trigger('change');
			$('[name="item_discount"]').val('0').trigger('change');
			$('[name="item_price"]').val('');
			$('[name="item_description"]').val('');

			$('#input-service_id-'+id).val(service_id);
			$('#input-discount-'+id).val(discount);
			$('#input-price-'+id).val(price);
			$('#input-description-'+id).val(description);
			$('.service_add').off().change(function () {
				if ($(this).val()!='') {
					var service_id = $(this).val();
					var id = $(this).data('id');
					$.ajax({
						url: "{{ route('service.getDetail') }}",
						method: 'post',
						data: {
								id: service_id,
						},
						success: function(data){
							$('#input-price-'+ id).val( data.service.price );
							$('#input-description-'+ id).val( data.service.name );
						}
					});
					
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

	function removeItem(id) {
		$('#'+id).remove();
	}

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
						$('.service').append('<option value="'+ data.service.id  +'">'+ data.service.name +'</option>');
						
						$('.service').select2({
							theme: 'bootstrap4',
						});
						
						$('#create_service_modal').modal('hide');
						// reloadSelectService(data.service.id)
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
				// $('#item_service_id').val(id).trigger('change');

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

	$('#input-service_id-first-item').change(function () {
		console.log($(this).val());
		if ($(this).val()!='') {
			var service_id = $(this).val();
			var id = $(this).data('id');
			$.ajax({
				url: "{{ route('service.getDetail') }}",
				method: 'post',
				data: {
						id: service_id,
				},
				success: function(data){
					// var id = $(this).val();
					// console.log(id);
					$('#input-price-'+ id).val( data.service.price );
					$('#input-description-'+ id).val( data.service.name );
				}
			});
			
		}
	});

	$('[name="item_service_id"]').change(function () {
		console.log($(this).val());
		if ($(this).val()!='') {
			var service_id = $(this).val();
			var id = $(this).data('id');
			$.ajax({
				url: "{{ route('service.getDetail') }}",
				method: 'post',
				data: {
						id: service_id,
				},
				success: function(data){
					$('[name="item_price"]').val( data.service.price );
					$('[name="item_description"]').val( data.service.name );
				}
			});
			
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