@extends('layouts.app')

@section('css')
	{{ Html::style('/css/invoice-print-style.css') }}
	<style type="text/css">
		.btn-print-invoice{
			top: -30px;
			right: 55px;
		}

		.item_list{
			padding: 20px;
			margin-top: 10px;
			background: #fff;
		}
		.prescription_item{
			margin-top: 10px;
		}
	</style>
@endsection

@section('content')

<div class="card">
	<div class="card-header">
		<b>{!! Auth::user()->subModule() !!}</b>
		
		<div class="card-tools">
			{{-- <button type="button" class="btn btn-flat btn-success btn-sm" data-toggle="modal" data-target="#edit_invoice_detail_modal"><i class="fa fa-list-ol"></i> &nbsp; {!! __('label.buttons.invoice_detail') !!}</button> --}}
			<button type="button" class="btn btn-flat btn-success" data-toggle="modal" data-target="#create_invoice_item_modal"><i class="fa fa-plus"></i> {!! __('label.buttons.add') !!}</button>
			<a href="{{route('invoice.index')}}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-table"></i> &nbsp;{{ __('label.buttons.back_to_list', [ 'name' => Auth::user()->module() ]) }}</a>
		</div>
{{-- 
		<!-- Error Message -->
		@component('components.crud_alert')
		@endcomponent --}}

	</div>

	{!! Form::open(['url' => route('invoice.update', $invoice->id),'method' => 'post','class' => 'mt-3']) !!}
	{!! Form::hidden('_method', 'PUT') !!}

	<div class="card-body">
		@include('invoice.form')
	</div>
	<!-- ./card-body -->
	
	<div class="card-footer text-muted text-center">
		@include('components.submit')
	</div>
	<!-- ./card-Footer -->
	{{ Form::close() }}

</div>


<div class="item_list my-4">
	@foreach ($invoice->invoice_details as $order => $invoice_detail)
		<div class="prescription_item" id="{{ $invoice_detail->id }}">
			<div class="row">
				<div class="col-sm-7">
					<div class="form-group">
						{!! Html::decode(Form::label('show_description', __('label.form.description')." <small>*</small>")) !!}
						{!! Form::text('show_description', $invoice_detail->description, ['class' => 'form-control','placeholder' => 'description','style' => 'height: 38px','id' => 'input-description-'. $invoice_detail->id ,'readonly']) !!}
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						{!! Html::decode(Form::label('show_discount', __('label.form.invoice.discount')." <small>*</small>")) !!}
						{!! Form::text('show_discount', ($invoice_detail->discount*100).'%', ['class' => 'form-control','placeholder' => 'discount','id' => 'input-discount-'. $invoice_detail->id ,'readonly']) !!}
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						{!! Html::decode(Form::label('show_price', __('label.form.invoice.price')."($) <small>*</small>")) !!}
						{!! Form::text('show_price', $invoice_detail->amount, ['class' => 'form-control','placeholder' => 'price','id' => 'input-amount-'. $invoice_detail->id ,'readonly']) !!}
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						{!! Html::decode(Form::label('', __('label.buttons.action'))) !!}
						<div>
							<button class="btn btn-info btn-flat" onclick="editInvoiceDetail('{{ $invoice_detail->id }}')"><i class="fa fa-pencil-alt"></i></button>
							<button class="btn btn-danger btn-flat" onclick="deleteInvoiceDetail({{ $invoice_detail->id }})"><i class="fa fa-trash-alt"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</div>

<div class="position-relative">
	@can("Invoice Print")
		<button type="button" class="btn btn-flat btn-success position-absolute mr-9 mt-5 btn-print-invoice" data-url="{{ route('invoice.print', $invoice->id) }}"><i class="fa fa-print"></i> {{ __("label.buttons.print") }}</button>
	@endCan
</div>

<div class="pb-2 print-preview">
	{!! $invoice_preview !!}
</div>

<!-- Edit Invoice Item Modal -->
<div class="modal add fade" id="edit_invoice_item_modal">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">{{ __('alert.modal.title.edit_item') }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							{!! Form::hidden('edit_item_id', '') !!}
							{!! Html::decode(Form::label('edit_item_service_id', __('label.form.invoice.service')." <small>*</small>")) !!}
							<div class="input-group">
								{!! Form::select('edit_item_service_id', $services, '', ['class' => 'form-control select2 service','placeholder' => __('label.form.choose'),'required']) !!}
								<div class="input-group-append">
									<button type="button" class="btn btn-flat btn-info add_service"><i class="fa fa-plus-circle"></i></button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							{!! Html::decode(Form::label('edit_item_discount', __('label.form.invoice.discount')." <small>*</small>")) !!}
							{!! Form::select('edit_item_discount', ['0'=>'0%', '0.05'=>'5%', '0.1'=>'10%', '0.15'=>'15%', '0.2'=>'20%', '0.25'=>'25%', '0.3'=>'30%', '0.35'=>'35%', '0.4'=>'40%', '0.45'=>'45%', '0.5'=>'50%', '0.55'=>'55%', '0.6'=>'60%', '0.65'=>'65%', '0.7'=>'70%', '0.75'=>'75%', '0.8'=>'80%', '0.85'=>'85%', '0.9'=>'90%', '0.95'=>'95%', '1'=>'100%'], '0', ['class' => 'form-control select2','required']) !!}
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group invoice_item_price">
							{!! Html::decode(Form::label('edit_item_price', __('label.form.invoice.price')." <small>*</small>")) !!}
							{!! Form::text('edit_item_price', '', ['class' => 'form-control','placeholder' => 'price','required']) !!}
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group invoice_item_description">
							{!! Html::decode(Form::label('edit_item_description', __('label.form.description')." <small>*</small>")) !!}
							{!! Form::textarea('edit_item_description', '', ['class' => 'form-control','placeholder' => 'description','style' => 'height: 38px','required']) !!}
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-flat btn-danger" data-dismiss="modal">{{ __('alert.swal.button.no') }}</button>
				<button type="button" class="btn btn-flat btn btn-success" id="btn_update_item" data-dismiss="modal">{{ __('alert.swal.button.yes') }}</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

@include('components.confirm_password')

@include('invoice.modal')
<span class="sr-only" id="deleteAlert" data-title="{{ __('alert.swal.title.delete', ['name' => Auth::user()->module()]) }}" data-text="{{ __('alert.swal.text.unrevertible') }}" data-btnyes="{{ __('alert.swal.button.yes') }}" data-btnno="{{ __('alert.swal.button.no') }}" data-rstitle="{{ __('alert.swal.result.title.success') }}" data-rstext="{{ __('alert.swal.result.text.delete') }}"> Delete Message </span>


@endsection

@section('js')
<script type="text/javascript">


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
					$('#item_service_id').val(id).trigger('change');

				}
			});
		}

	function select2_search (term) {
		$(".select2_pagination").select2('open');
		var $search = $(".select2_pagination").data('select2').dropdown.$search || $(".select2_pagination").data('select2').selection.$search;
		$search.val(term);
		$search.trigger('keyup');
	}

	$( document ).ready(function() {

		setTimeout(() => {
			$(".select2_pagination").val("{{ $invoice->patient_id }}").trigger("change");
				
			setTimeout(() => {
				$("[name='pt_no']").val("{{ $invoice->pt_no }}");
				$("[name='pt_name']").val("{{ $invoice->pt_name }}");
				$("[name='pt_age']").val("{{ $invoice->pt_age }}");
				$("[name='pt_gender']").val("{{ $invoice->pt_gender }}");
				$("[name='pt_phone']").val("{{ $invoice->pt_phone }}");
			}, 200);
		}, 100);

		var data = [];
		$(".select2_pagination").each(function () {
			data.push({id:'{{ $invoice->patient_id }}', text:'PT-{{ str_pad($invoice->patient_id, 6, "0", STR_PAD_LEFT) }} :: {{ (($invoice->patient_id != '')? $invoice->patient->name : '' )}}'});
		});
		$(".select2_pagination").select2({
			theme: 'bootstrap4',
			placeholder: "{{ __('label.form.choose') }}",
			allowClear: true,
			data: data,
			ajax: {
				url: "{{ route('patient.getSelect2Items') }}",
				method: 'post',
				dataType: 'json',
				data: function(params) {
					return {
							term: params.term || '{{ $invoice->patient_id }}',
							page: params.page || 1
					}
				},
				cache: true
			}
		});
	});


	$(function(){
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
			$(".btn-print-invoice").on("click", function (e) {
				var myUrl = $(this).attr('data-url');
				// alert(myUrl);
				e.preventDefault();
				openPrintWindow(myUrl, "to_print");
			});
		});
	});

	$('[name="item_service_id"]').change(function () {
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
					$('[name="item_description"]').val( data.service.name );
				}
			});
			
		}
	});
	

	$('[name="edit_item_service_id"]').change(function () {
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
					$('[name="edit_item_price"]').val( data.service.price );
					$('[name="edit_item_description"]').val( data.service.name );
				}
			});
			
		}
	});
	
	function editInvoiceDetail(id) {
		$.ajax({
			url: "{{ route('invoice.invoice_detail.getDetail') }}",
			type: 'post',
			data: {
				id: id
			},
		})
		.done(function( result ) {
			$('[name="edit_item_service_id"]').val(result.invoice_detail.service_id).trigger('change');
			$('[name="edit_item_price"]').val(result.invoice_detail.amount);
			$('[name="edit_item_discount"]').val(result.invoice_detail.discount).trigger('change');
			$('[name="edit_item_description"]').val(result.invoice_detail.description);
			$('[name="edit_item_id"]').val(result.invoice_detail.id);
			$('#edit_invoice_item_modal').modal('show');
		});
	};
	

	function deleteInvoiceDetail(id) {
		
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success btn-flat ml-2 py-2 px-3',
				cancelButton: 'btn btn-danger btn-flat mr-2 py-2 px-3'
			},
			buttonsStyling: false
		})
		swalWithBootstrapButtons.fire({
			title: "{{ __('alert.swal.title.delete') }}",
			text: "{{ __('alert.swal.text.unrevertible') }}",
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: "{{ __('alert.swal.button.yes') }}",
			cancelButtonText: "{{ __('alert.swal.button.no') }}",
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: "{{ route('invoice.invoice_detail.deleteInvoiceDetail') }}",
					type: 'post',
					data: {
						id: id
					},
					success: function(data){
						$('.print-preview').html(data.invoice_preview);
						Swal.fire({
							icon: 'success',
							title: "{{ __('alert.swal.result.title.save') }}",
							confirmButtonText: "{{ __('alert.swal.button.yes') }}",
							timer: 2500
						})
						$('#'+ id).remove();
					}
				})
			}
		})
	};

	$('#btn_update_item').click(function () {
		$.ajax({
			url: "{{ route('invoice.invoice_detail.update') }}",
			type: 'post',
			data: {
				id: $('[name="edit_item_id"]').val(),
				price: $('[name="edit_item_price"]').val(),
				discount: $('[name="edit_item_discount"]').val(),
				service_id: $('[name="edit_item_service_id"]').val(),
				description: $('[name="edit_item_description"]').val()
			},
		})
		.done(function( data ) {
			
			$('#edit_invoice_item_modal .invalid-feedback').remove();
			$('#edit_invoice_item_modal .form-control').removeClass('is-invalid');
			if (data.errors) {
				$.each(data.errors, function(key, value){
					$('#edit_invoice_item_modal .invoice_item_'+key+' input').addClass('is-invalid');
					$('#edit_invoice_item_modal .invoice_item_'+key).append('<span class="invalid-feedback">'+value+'</span>');
				});
				Swal.fire({
					icon: 'error',
					title: "{{ __('alert.swal.result.title.error') }}",
					confirmButtonText: "{{ __('alert.swal.button.yes') }}",
					timer: 1500
				})
			}
			if (data.success) {
				$('[name="edit_item_service_id"]').val('').trigger('change');
				$('[name="edit_item_price"]').val('');
				$('[name="edit_item_discount"]').val('').trigger('change');
				$('[name="edit_item_description"]').val('');
				$('[name="edit_item_id"]').val('');
				$('.print-preview').html(data.invoice_preview);
				$("#"+ data.invoice_detail.id ).html(`<div class="row">
																									<div class="col-sm-7">
																										<div class="form-group">
																											{!! Html::decode(Form::label('show_description', __('label.form.description')." <small>*</small>")) !!}
																											<input name="show_description" class="form-control" style="height: 38px;" id="input-description-${ data.invoice_detail.id }" value="${ data.invoice_detail.description }" placeholder="description" readonly="" />
																										</div>
																									</div>
																									<div class="col-sm-2">
																										<div class="form-group">
																											{!! Html::decode(Form::label('show_discount', __('label.form.invoice.discount')." <small>*</small>")) !!}
																											<input name="show_discount" class="form-control" id="input-discount-${ data.invoice_detail.id }" value="${ data.invoice_detail.discount * 100 }%" placeholder="discount" readonly="" />
																										</div>
																									</div>
																									<div class="col-sm-2">
																										<div class="form-group">
																											{!! Html::decode(Form::label('show_price', __('label.form.invoice.price')."($) <small>*</small>")) !!}
																											<input name="show_price" class="form-control" id="input-price-${ data.invoice_detail.id }" value="${ data.invoice_detail.amount }" placeholder="price" readonly="" />
																										</div>
																									</div>
																									<div class="col-sm-1">
																										<div class="form-group">
																											{!! Html::decode(Form::label('', __('label.buttons.action'))) !!}
																											<div>
																												<button class="btn btn-info btn-flat" onclick="editInvoiceDetail('${ data.invoice_detail.id }')"><i class="fa fa-pencil-alt"></i></button>
																												<button class="btn btn-danger btn-flat" onclick="deleteInvoiceDetail(${ data.invoice_detail.id })"><i class="fa fa-trash-alt"></i></button>
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
				$('#modal_add_service').modal('hide');
			}
		});
	});

	$('#btn_add_item').click(function () {
		if ($('[name="item_service_id"]').val() !='' && $('[name="item_price"]').val() !='' && $('[name="item_description"]').val() !='') {
		
			$.ajax({
				url: "{{ route('invoice.invoice_detail.store') }}",
				method: 'post',
				data: {
						invoice_id: '{{ $invoice->id }}',
						medicine_id: (($('[name="item_medicine_id"]'))? $('[name="item_medicine_id"]').val() : ''),
						service_id: (($('[name="item_service_id"]'))? $('[name="item_service_id"]').val() : ''),
						discount: $('[name="item_discount"]').val(),
						price: $('[name="item_price"]').val(),
						description: $('[name="item_description"]').val(),
				},
				success: function(data){
					$('.print-preview').html(data.invoice_preview);
					$('[name="item_medicine_id"]').val('').trigger('change');
					$('[name="item_service_id"]').val('').trigger('change');
					$('[name="item_discount"]').val('0').trigger('change');
					$('[name="item_price"]').val( '' );
					$('[name="item_description"]').val( '' );
					$('#create_invoice_item_modal').modal('hide');
					
					$(".item_list").append(`<div class="prescription_item" id="${ data.invoice_detail.id }">
																		<div class="row">
																			<div class="col-sm-7">
																				<div class="form-group">
																					{!! Html::decode(Form::label('show_description', __('label.form.description')." <small>*</small>")) !!}
																					<input name="show_description" class="form-control" style="height: 38px;" id="input-description-${ data.invoice_detail.id }" value="${ data.invoice_detail.description }" placeholder="description" readonly="" />
																				</div>
																			</div>
																			<div class="col-sm-2">
																				<div class="form-group">
																					{!! Html::decode(Form::label('show_discount', __('label.form.invoice.discount')." <small>*</small>")) !!}
																					<input name="show_discount" class="form-control" id="input-discount-${ data.invoice_detail.id }" value="${ parseFloat(data.invoice_detail.discount) * 100 }%" placeholder="discount" readonly="" />
																				</div>
																			</div>
																			<div class="col-sm-2">
																				<div class="form-group">
																					{!! Html::decode(Form::label('show_price', __('label.form.invoice.price')."($) <small>*</small>")) !!}
																					<input name="show_price" class="form-control" id="input-price-${ data.invoice_detail.id }" value="${ data.invoice_detail.amount }" placeholder="price" readonly="" />
																				</div>
																			</div>
																			<div class="col-sm-1">
																				<div class="form-group">
																					{!! Html::decode(Form::label('', __('label.buttons.action'))) !!}
																					<div>
																						<button class="btn btn-info btn-flat" onclick="editInvoiceDetail('${ data.invoice_detail.id }')"><i class="fa fa-pencil-alt"></i></button>
																						<button class="btn btn-danger btn-flat" onclick="deleteInvoiceDetail(${ data.invoice_detail.id })"><i class="fa fa-trash-alt"></i></button>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>`);
					
					Swal.fire({
						icon: 'success',
						title: "{{ __('alert.swal.result.title.save') }}",
						confirmButtonText: "{{ __('alert.swal.button.yes') }}",
					})
					
					$('.empty_data_list').remove();

					$('.btn_remove_item').click( function () {
						$('.'+ $(this).data('id')).remove();
					});
					
				}
			});

		}else{
			Swal.fire({
				icon: 'warning',
				title: "{{ __('alert.swal.title.empty_field') }}",
				text: "{{ __('alert.swal.text.empty_field') }}",
				confirmButtonText: "{{ __('alert.swal.button.yes') }}",
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