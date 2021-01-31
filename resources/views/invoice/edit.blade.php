@extends('layouts.app')

@section('css')
	{{ Html::style('/css/invoice-print-style.css') }}
	<style type="text/css">
		.btn-print-invoice{
			top: -30px;
			right: 55px;
		}

	</style>
@endsection

@section('content')

<div class="card">
	<div class="card-header">
		<b>{!! Auth::user()->subModule() !!}</b>
		
		<div class="card-tools">
			<button type="button" class="btn btn-flat btn-success btn-sm" data-toggle="modal" data-target="#edit_invoice_detail_modal"><i class="fa fa-list-ol"></i> &nbsp; {!! __('label.buttons.invoice_detail') !!}</button>

			{{-- Action Dropdown --}}
			@component('components.action')
				@slot('otherBTN')
					<a href="{{route('invoice.index')}}" class="dropdown-item text-danger"><i class="fa fa-arrow-left"></i> &nbsp;{{ __('label.buttons.back') }}</a>
				@endslot
			@endcomponent

			<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fas fa-minus"></i></button>
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

<div class="position-relative">
	@can("Invoice Print")
		<button type="button" class="btn btn-flat btn-success position-absolute mr-9 mt-5 btn-print-invoice" data-url="{{ route('invoice.print', $invoice->id) }}"><i class="fa fa-print"></i> {{ __("label.buttons.print") }}</button>
	@endCan
</div>

<div class="pb-2 print-preview">
	{!! $invoice_preview !!}
</div>

<!--Invoice Detail Modal -->
<div class="modal fade" id="edit_invoice_detail_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">{{ __('alert.modal.title.invoice_detail') }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
					<ul class="todo-list" data-widget="todo-list">
						@foreach ($invoice->invoice_details as $order => $invoice_detail)
						
							<li class="{{ $invoice_detail->id }}" data-id="{{ $invoice_detail->id }}" data-order="{{ ++$order }}">
								<!-- drag handle -->
								<span class="handle">
									<i class="fas fa-ellipsis-v"></i>
									<i class="fas fa-ellipsis-v"></i>
								</span>
								<!-- todo text -->
								<span class="text">{!! $invoice_detail->description !!}</span>
								<!-- Emphasis label -->
								<small class="badge badge-danger"><i class="fa fa-dollar-sign"></i> {{ number_format(($invoice_detail->amount * $invoice_detail->qty), 2) }}</small>
								<!-- General tools such as edit or delete-->
								<div class="tools">
									<i class="fa fa-edit text-info btn_edit_item" onclick="editInvoiceDetail({{ $invoice_detail->id }})"></i>
									<button type="button" class="not-btn text-danger mr-2" onclick="DeleteInvoiceDetail({{ $invoice_detail->id }})"><i class="fa fa-trash-alt"></i></button>
									{{ Form::open(['url'=>route('invoice.invoice_detail.destroy', $invoice_detail->id), 'id' => 'form-item-'.$invoice_detail->id, 'class' => 'sr-only']) }}
									{{ Form::hidden('_method','DELETE') }}
									{{ Form::close() }}
								</div>
							</li>
						@endforeach
					</ul>
					
					@if (count($invoice->invoice_details) == 0)
						<div class="text-muted text-center empty_data_list mb-4">
							{!! __('alert.modal.title.empty_data') !!}
						</div>
					@endif
					
				<div id="save_order_form" class="sr-only">
					{!! Form::open(['url' => route('invoice.invoice_detail.save_order', $invoice->id),'method' => 'post','class' => 'mt-3', 'autocomplete'=>'off']) !!}
					{!! Form::hidden('_method', 'PUT') !!}
						{!! Form::hidden('item_ids', '') !!}
						{!! Form::hidden('order_ids', '') !!}
					{!! Form::close() !!}
				</div>
			</div>
			<div class="modal-footer">
				<span class="save_order_block"></span>
				<button type="button" class="btn btn-flat btn-success" data-toggle="modal" data-target="#create_invoice_item_modal"><i class="fa fa-plus"></i> {!! __('label.buttons.add') !!}</button>
			</div>
		</div>
	</div>
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
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group invoice_item_service_id">
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
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									{!! Html::decode(Form::label('edit_item_discount', __('label.form.invoice.discount')." <small>*</small>")) !!}
									{!! Form::select('edit_item_discount', ['0'=>'0%', '0.05'=>'5%', '0.1'=>'10%', '0.15'=>'15%', '0.2'=>'20%', '0.25'=>'25%', '0.3'=>'30%', '0.35'=>'35%', '0.4'=>'40%', '0.45'=>'45%', '0.5'=>'50%', '0.55'=>'55%', '0.6'=>'60%', '0.65'=>'65%', '0.7'=>'70%', '0.75'=>'75%', '0.8'=>'80%', '0.85'=>'85%', '0.9'=>'90%', '0.95'=>'95%', '1'=>'100%'], '0', ['class' => 'form-control select2','required']) !!}
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group invoice_item_price">
									{!! Html::decode(Form::label('edit_item_price', __('label.form.invoice.price')." <small>*</small>")) !!}
									{!! Form::text('edit_item_price', '', ['class' => 'form-control','placeholder' => 'price','required']) !!}
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group invoice_item_qty">
									{!! Html::decode(Form::label('edit_item_qty', __('label.form.invoice.qty')." <small>*</small>")) !!}
									{!! Form::text('edit_item_qty', '', ['class' => 'form-control','placeholder' => 'qauntity','required']) !!}
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group invoice_item_description">
							{!! Html::decode(Form::label('edit_item_description', __('label.form.description')." <small>*</small>")) !!}
							{!! Form::textarea('edit_item_description', '', ['class' => 'form-control','placeholder' => 'description','rows' => '2','required']) !!}
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

	// jQuery UI sortable for the todo list
	$('.todo-list').sortable({
		update: function( ) {
			var order = new Array();
			var order_origin = new Array();
			var i = 0;
			$( ".todo-list li" ).each(function( index ) {
				order.push(++i);
				order_origin.push($(this).data('order'));
			});
			console.log(order);
			var compare = isArrayEqual(order, order_origin);
			if ( compare === "False" ) {
				$('.save_order_block').html('<button type="button" class="btn btn-flat btn-primary btn_save_order"><i class="fa fa-save"></i> {{ __("label.buttons.save_order") }}</button>');
				save_order()
			}else{
				$('.save_order_block').html('');
			}
		}
	});
	
	function save_order() {
      
		$('.btn_save_order').click(function () {

			const swalWithBootstrapButtons = Swal.mixin({
				customClass: {
					confirmButton: 'btn btn-success btn-flat ml-2 py-2 px-3',
					cancelButton: 'btn btn-danger btn-flat mr-2 py-2 px-3'
				},
				buttonsStyling: false
			})

			swalWithBootstrapButtons.fire({
				title: '{{ __("alert.swal.title.save") }}',
				text: '{{ __("alert.swal.text.save") }}',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: '{{ __("alert.swal.button.yes") }}',
				cancelButtonText: '{{ __("alert.swal.button.no") }}',
				reverseButtons: true
			}).then((result) => {
				if (result.value) {
					var order = new Array();
					var ids = new Array();
					var i = 0;
					$( ".todo-list li" ).each(function( index ) {
						order.push(++i);
						ids.push($(this).data('id'));
					});
					$( "#save_order_form [name='item_ids']" ).val(ids);
					$( "#save_order_form [name='order_ids']" ).val(order);
					$( "#save_order_form form" ).submit();
				}
			})
		});
	}


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
			$('[name="edit_item_qty"]').val(result.invoice_detail.qty);
			$('[name="edit_item_description"]').val(result.invoice_detail.description);
			$('[name="edit_item_id"]').val(result.invoice_detail.id);
			$('#edit_invoice_item_modal').modal('show');
		});
	};
	

	function DeleteInvoiceDetail(id) {
		$('#item_id').val(id);
		$('#modal_confirm_delete').modal();
	};
	
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


	$('#btn_update_item').click(function () {
		$.ajax({
			url: "{{ route('invoice.invoice_detail.update') }}",
			type: 'post',
			data: {
				id: $('[name="edit_item_id"]').val(),
				qty: $('[name="edit_item_qty"]').val(),
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
				$('[name="edit_item_qty"]').val('');
				$('[name="edit_item_description"]').val('');
				$('[name="edit_item_id"]').val('');
				$('.print-preview').html(data.invoice_preview);
				$(".todo-list li."+ data.invoice_detail.id).html(`<span class="handle">
																														<i class="fas fa-ellipsis-v"></i>
																														<i class="fas fa-ellipsis-v"></i>
																													</span>
																													<span class="text">${ data.invoice_detail.description }</span>
																													<small class="badge badge-danger"><i class="fa fa-dollar-sign"></i> ${ data.invoice_detail.amount * data.invoice_detail.qty }</small>
																													<div class="tools">
																														<i class="fa fa-edit text-info btn_edit_item" onclick="editInvoiceDetail(${ data.invoice_detail.id })"></i>
																														<button type="button" class="not-btn text-danger mr-2 BtnDelete" onclick="DeleteInvoiceDetail(${ data.invoice_detail.id })"><i class="fa fa-trash-alt"></i></button>
																														<form action="/invoice/invoice_detail/${ data.invoice_detail.id }/delete" method="post" accept-charset="UTF-8" id="form-item-${ data.invoice_detail.id }" class="sr-only">
																															@csrf
																															<input type="hidden" name="_method" value="DELETE" />
																														</form>
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
		if ($('[name="item_service_id"]').val() !='' && $('[name="item_price"]').val() !='' && $('[name="item_qty"]').val() !='' && $('[name="item_description"]').val() !='') {
		
			$.ajax({
				url: "{{ route('invoice.invoice_detail.store') }}",
				method: 'post',
				data: {
						invoice_id: '{{ $invoice->id }}',
						service_id: $('[name="item_service_id"]').val(),
						price: $('[name="item_price"]').val(),
						qty: $('[name="item_qty"]').val(),
						description: $('[name="item_description"]').val(),
				},
				success: function(data){
					$('.print-preview').html(data.invoice_preview);
					var order = 1;
					$( ".todo-list li" ).each(function( index ) {
						order++;
					});

					$('.todo-list').append(	`<li data-id="${ data.invoice_detail.id }" data-order="${ order }" id="${ data.invoice_detail.id }">
																		<span class="handle">
																			<i class="fas fa-ellipsis-v"></i>
																			<i class="fas fa-ellipsis-v"></i>
																		</span>
																		<span class="text">${ data.invoice_detail.description }</span>
																		<small class="badge badge-danger"><i class="fa fa-dollar-sign"></i> ${ data.invoice_detail.amount * data.invoice_detail.qty }</small>
																		<div class="tools">
																			<i class="fa fa-edit text-info btn_edit_item" onclick="editInvoiceDetail(${ data.invoice_detail.id })"></i>
																			<button type="button" class="not-btn text-danger mr-2 BtnDelete" onclick="DeleteInvoiceDetail(${ data.invoice_detail.id })"><i class="fa fa-trash-alt"></i></button>
																			<form action="/invoice/invoice_detail/${ data.invoice_detail.id }/delete" method="post" accept-charset="UTF-8" id="form-item-${ data.invoice_detail.id }" class="sr-only">
																				@csrf
																				<input type="hidden" name="_method" value="DELETE" />
																			</form>
																		</div>
																	</li>`);
					$('[name="item_service_id"]').val('').trigger('change');
					$('[name="item_discount"]').val('0').trigger('change');
					$('[name="item_price"]').val( '' );
					$('[name="item_qty"]').val( '' );
					$('[name="item_description"]').val( '' );
					$('#create_invoice_item_modal').modal('hide');
					
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
				url: "{{ route('patient.getDetail') }}",
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