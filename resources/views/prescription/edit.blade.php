@extends('layouts.app')

@section('css')
	{{ Html::style('/css/invoice-print-style.css') }}
	<style type="text/css">
		.btn-print-prescription{
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
			
			<button type="button" class="btn btn-success btn-flat btn-sm" data-toggle="modal" data-target="#edit_prescription_detail_modal"><i class="fa fa-list-ol"></i> &nbsp; {!! __('label.buttons.prescription_detail') !!}</button>
			{{-- Action Dropdown --}}
			@component('components.action')
				@slot('otherBTN')
					<a href="{{route('prescription.index')}}" class="dropdown-item text-danger"><i class="fa fa-arrow-left"></i> &nbsp;{{ __('label.buttons.back') }}</a>
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

	{!! Form::open(['url' => route('prescription.update', $prescription->id),'method' => 'post','class' => 'mt-3']) !!}
	{!! Form::hidden('_method', 'PUT') !!}

	<div class="card-body">
		@include('prescription.form')
	</div>
	<!-- ./card-body -->
	
	<div class="card-footer text-muted text-center">
		@include('components.submit')
	</div>
	<!-- ./card-Footer -->
	{{ Form::close() }}

</div>

<div class="position-relative">
	@can("Prescription Print")
		<button type="button" class="btn btn-flat btn-success position-absolute mr-9 mt-5 btn-print-prescription" data-url="{{ route('prescription.print', $prescription->id) }}"><i class="fa fa-print"></i> {{ __("label.buttons.print") }}</button>
	@endCan
</div>

<div class="pb-2 print-preview">
	{!! $prescription_preview !!}
</div>

<!--Prescription Detail Modal -->
<div class="modal fade" id="edit_prescription_detail_modal">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">{{ __('alert.modal.title.prescription_detail') }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">
					<ul class="todo-list" data-widget="todo-list">
						@foreach ($prescription->prescription_details as $order => $prescription_detail)
						
							<li class="{{ $prescription_detail->id }}" data-id="{{ $prescription_detail->id }}" data-order="{{ ++$order }}">
								<!-- drag handle -->
								<span class="handle">
									<i class="fas fa-ellipsis-v"></i>
									<i class="fas fa-ellipsis-v"></i>
								</span>
								<!-- todo text -->
								<span class="text">{!! $prescription_detail->medicine_name !!}</span>
								<!-- Emphasis label -->
								<small class="badge badge-info">{!! $prescription_detail->medicine_usage !!}</small>
								<small class="badge badge-danger">morning:{!! $prescription_detail->morning !!}, afternoon:{!! $prescription_detail->afternoon !!}, evening:{!! $prescription_detail->evening !!}, night:{!! $prescription_detail->night !!}</small>
								<!-- General tools such as edit or delete-->
								<div class="tools">
									<i class="fa fa-edit text-info btn_edit_item" onclick="editPrescriptionDetail({{ $prescription_detail->id }})"></i>
									<button type="button" class="not-btn text-danger mr-2" onclick="DeletePrescriptionDetail({{ $prescription_detail->id }})"><i class="fa fa-trash-alt"></i></button>
									{{ Form::open(['url'=>route('prescription.prescription_detail.destroy', $prescription_detail->id), 'id' => 'form-item-'.$prescription_detail->id, 'class' => 'sr-only']) }}
									{{ Form::hidden('_method','DELETE') }}
									{{ Form::close() }}
								</div>
							</li>
						@endforeach
					</ul>
					
					@if (count($prescription->prescription_details) == 0)
						<div class="text-muted text-center empty_data_list mb-4">
							{!! __('alert.modal.title.empty_data') !!}
						</div>
					@endif
					
				<div id="save_order_form" class="sr-only">
					{!! Form::open(['url' => route('prescription.prescription_detail.save_order', $prescription->id),'method' => 'post','class' => 'mt-3', 'autocomplete'=>'off']) !!}
					{!! Form::hidden('_method', 'PUT') !!}
						{!! Form::hidden('item_ids', '') !!}
						{!! Form::hidden('order_ids', '') !!}
					{!! Form::close() !!}
				</div>
			</div>
			<div class="modal-footer">
				<span class="save_order_block"></span>
				<button type="button" class="btn btn-flat btn-success" data-toggle="modal" data-target="#create_prescription_item_modal"><i class="fa fa-plus"></i> {!! __('label.buttons.add') !!}</button>
			</div>
		</div>
	</div>
</div>

<!-- Edit Prescription Item Modal -->
<div class="modal add fade" id="edit_prescription_item_modal">
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
								<div class="form-group prescription_item_medicine_id">
									{!! Form::hidden('edit_item_id', '') !!}
									{!! Html::decode(Form::label('edit_item_medicine_id', __('label.form.prescription.medicine')." <small>*</small>")) !!}
									{!! Form::select('edit_item_medicine_id', $medicines, '', ['class' => 'form-control select2 medicine','placeholder' => __('label.form.choose'),'required']) !!}
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group prescription_item_medicine_name">
									{!! Html::decode(Form::label('edit_item_medicine_name', __('label.form.prescription.medicine_name')."<small>*</small>")) !!}
									{!! Form::text('edit_item_medicine_name', '', ['class' => 'form-control','placeholder' => 'name','required']) !!}
								</div>
							</div>
							<div class="col-sm-6">
								<div class="form-group prescription_item_medicine_usage">
									{!! Html::decode(Form::label('edit_item_medicine_usage', __('label.form.prescription.medicine_usage')."<small>*</small>")) !!}
									{!! Form::text('edit_item_medicine_usage', '', ['class' => 'form-control','placeholder' => 'usage','required']) !!}
								</div>
							</div>
						</div>
					</div>

					<div class="col-sm-3">
						<div class="form-group prescription_item_morning">
							{!! Html::decode(Form::label('edit_item_morning', __('label.form.prescription.morning')."<small>*</small>")) !!}
							{!! Form::number('edit_item_morning', '0', ['class' => 'form-control is_number','min' => '0','placeholder' => 'morning','required']) !!}
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group prescription_item_afternoon">
							{!! Html::decode(Form::label('edit_item_afternoon', __('label.form.prescription.afternoon')."<small>*</small>")) !!}
							{!! Form::number('edit_item_afternoon', '0', ['class' => 'form-control is_number','min' => '0','placeholder' => 'afternoon','required']) !!}
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group prescription_item_evening">
							{!! Html::decode(Form::label('edit_item_evening', __('label.form.prescription.evening')." <small>*</small>")) !!}
							{!! Form::number('edit_item_evening', '0', ['class' => 'form-control is_number','min' => '0','placeholder' => 'qauntity','required']) !!}
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group prescription_item_night">
							{!! Html::decode(Form::label('edit_item_night', __('label.form.prescription.night')." <small>*</small>")) !!}
							{!! Form::number('edit_item_night', '0', ['class' => 'form-control is_number','min' => '0','placeholder' => 'qauntity','required']) !!}
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group prescription_item_description">
							{!! Html::decode(Form::label('edit_item_description', __('label.form.description'))) !!}
							{!! Form::textarea('edit_item_description', '', ['class' => 'form-control','placeholder' => 'description','rows' => '2']) !!}
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

@include('prescription.modal')
<span class="sr-only" id="deleteAlert" data-title="{{ __('alert.swal.title.delete', ['name' => Auth::user()->module()]) }}" data-text="{{ __('alert.swal.text.unrevertible') }}" data-btnyes="{{ __('alert.swal.button.yes') }}" data-btnno="{{ __('alert.swal.button.no') }}" data-rstitle="{{ __('alert.swal.result.title.success') }}" data-rstext="{{ __('alert.swal.result.text.delete') }}"> Delete Message </span>


@endsection

@section('js')
<script type="text/javascript">

	function select2_search (term) {
		$(".select2_pagination").select2('open');
		var $search = $(".select2_pagination").data('select2').dropdown.$search || $(".select2_pagination").data('select2').selection.$search;
		$search.val(term);
		$search.trigger('keyup');
	}

	$( document ).ready(function() {

		setTimeout(() => {
			$(".select2_pagination").val("{{ $prescription->patient_id }}").trigger("change");
		}, 100);

		var data = [];
		$(".select2_pagination").each(function () {
			data.push({id:'{{ $prescription->patient_id }}', text:'PT-{{ str_pad($prescription->patient_id, 6, "0", STR_PAD_LEFT) }} :: {{ $prescription->patient->name }}'});
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
							term: params.term || '{{ $prescription->patient_id }}',
							page: params.page || 1
					}
				},
				cache: true
			}
		});
	});

	$('.select2_pagination').val('{{ $prescription->id }}').trigger('change')

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
			$(".btn-print-prescription").on("click", function (e) {
				var myUrl = $(this).attr('data-url');
				// alert(myUrl);
				e.preventDefault();
				openPrintWindow(myUrl, "to_print");
			});
		});
	});

	$('.medicine').change(function () {
		if ($(this).val()!='') {
			var medicine_id = $(this).val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: "{{ route('medicine.getDetail') }}",
				method: 'post',
				data: {
						id: medicine_id,
				},
				success: function(data){
					$('[name="item_medicine_name"]').val( data.medicine.name );
					$('[name="item_medicine_usage"]').val( data.medicine.usage.name );
				}
			});
			
		}
	});

	
	function editPrescriptionDetail(id) {
		$.ajax({
			url: "{{ route('prescription.prescription_detail.getDetail') }}",
			type: 'post',
			data: {
				id: id
			},
		})
		.done(function( result ) {
			$('[name="edit_item_medicine_id"]').val(result.prescription_detail.medicine_id).trigger('change');
			$('[name="edit_item_medicine_name"]').val(result.prescription_detail.medicine_name);
			$('[name="edit_item_medicine_usage"]').val(result.prescription_detail.medicine_usage);
			$('[name="edit_item_morning"]').val(result.prescription_detail.morning);
			$('[name="edit_item_afternoon"]').val(result.prescription_detail.afternoon);
			$('[name="edit_item_evening"]').val(result.prescription_detail.evening);
			$('[name="edit_item_night"]').val(result.prescription_detail.night);
			$('[name="edit_item_description"]').val(result.prescription_detail.description);
			$('[name="edit_item_id"]').val(result.prescription_detail.id);
			$('#edit_prescription_item_modal').modal('show');
		});
	};
	

	function DeletePrescriptionDetail(id) {
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
			url: "{{ route('prescription.prescription_detail.update') }}",
			type: 'post',
			data: {
				id: $('[name="edit_item_id"]').val(),
				medicine_name: $('[name="edit_item_medicine_name"]').val(),
				medicine_usage: $('[name="edit_item_medicine_usage"]').val(),
				morning: $('[name="edit_item_morning"]').val(),
				afternoon: $('[name="edit_item_afternoon"]').val(),
				evening: $('[name="edit_item_evening"]').val(),
				night: $('[name="edit_item_night"]').val(),
				description: $('[name="edit_item_description"]').val(),
				medicine_id: $('[name="edit_item_medicine_id"]').val(),
				description: $('[name="edit_item_description"]').val()
			},
		})
		.done(function( data ) {
			
			$('#edit_prescription_item_modal .invalid-feedback').remove();
			$('#edit_prescription_item_modal .form-control').removeClass('is-invalid');
			if (data.errors) {
				$.each(data.errors, function(key, value){
					$('#edit_prescription_item_modal .prescription_item_'+key+' input').addClass('is-invalid');
					$('#edit_prescription_item_modal .prescription_item_'+key).append('<span class="invalid-feedback">'+value+'</span>');
				});
				Swal.fire({
					icon: 'error',
					title: "{{ __('alert.swal.result.title.error') }}",
					confirmButtonText: "{{ __('alert.swal.button.yes') }}",
					timer: 1500
				})
				.then((result) => {
					if (result.value) {
						$('#edit_prescription_item_modal').modal('show');
					}
				})
			}
			if (data.success) {
				$('[name="edit_item_medicine_name"]').val('');
				$('[name="edit_item_medicine_usage"]').val('');
				$('[name="edit_item_morning"]').val('');
				$('[name="edit_item_afternoon"]').val('');
				$('[name="edit_item_evening"]').val('');
				$('[name="edit_item_night"]').val('');
				$('[name="edit_item_description"]').val('');
				$('[name="edit_item_medicine_id"]').val('').trigger('change');
				$('.print-preview').html(data.prescription_preview);
				$(".todo-list li."+ data.prescription_detail.id).html(`<span class="handle">
																														<i class="fas fa-ellipsis-v"></i>
																														<i class="fas fa-ellipsis-v"></i>
																													</span>
																													<span class="text">${ data.prescription_detail.medicine_name }</span>
																													<small class="badge badge-info">${ data.prescription_detail.medicine_usage }</small>
																													<small class="badge badge-danger">morning:${ data.prescription_detail.morning }, afternoon:${ data.prescription_detail.afternoon }, evening:${ data.prescription_detail.evening }, night:${ data.prescription_detail.night }</small>
																													<div class="tools">
																														<i class="fa fa-edit text-info btn_edit_item" onclick="editPrescriptionDetail(${ data.prescription_detail.id })"></i>
																														<button type="button" class="not-btn text-danger mr-2 BtnDelete" onclick="DeletePrescriptionDetail(${ data.prescription_detail.id })"><i class="fa fa-trash-alt"></i></button>
																														<form action="/prescription/prescription_detail/${ data.prescription_detail.id }/delete" method="post" accept-charset="UTF-8" id="form-item-${ data.prescription_detail.id }" class="sr-only">
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
				$('#modal_add_medicine').modal('hide');
			}
		});
	});

	$('#btn_add_item').click(function () {
		if ($('[name="item_medicine_id"]').val() !='' && $('[name="item_medicine_name"]').val() !='' && $('[name="item_medicine_usage"]').val() !='' && $('[name="item_morning"]').val() !='' && $('[name="item_afternoon"]').val() !='' && $('[name="item_evening"]').val() !='' && $('[name="item_night"]').val() !='') {
		
			$.ajax({
				url: "{{ route('prescription.prescription_detail.store') }}",
				method: 'post',
				data: {
						prescription_id: '{{ $prescription->id }}',
						medicine_id: $('[name="item_medicine_id"]').val(),
						medicine_id: $('[name="item_medicine_id"]').val(),
						medicine_name: $('[name="item_medicine_name"]').val(),
						medicine_usage: $('[name="item_medicine_usage"]').val(),
						morning: $('[name="item_morning"]').val(),
						afternoon: $('[name="item_afternoon"]').val(),
						evening: $('[name="item_evening"]').val(),
						night: $('[name="item_night"]').val(),
						description: $('[name="item_description"]').val(),
				},
				success: function(data){
					$('.print-preview').html(data.prescription_preview);
					var order = 1;
					$( ".todo-list li" ).each(function( index ) {
						order++;
					});

					$('.todo-list').append(	`<li data-id="${ data.prescription_detail.id }" data-order="${ order }" id="${ data.prescription_detail.id }">
																		<span class="handle">
																			<i class="fas fa-ellipsis-v"></i>
																			<i class="fas fa-ellipsis-v"></i>
																		</span>
																		<span class="text">${ data.prescription_detail.medicine_name }</span>
																		<small class="badge badge-info">${ data.prescription_detail.medicine_usage }</small>
																		<small class="badge badge-danger">morning:${ data.prescription_detail.morning }, afternoon:${ data.prescription_detail.afternoon }, evening:${ data.prescription_detail.evening }, night:${ data.prescription_detail.night }</small>

																		<div class="tools">
																			<i class="fa fa-edit text-info btn_edit_item" onclick="editPrescriptionDetail(${ data.prescription_detail.id })"></i>
																			<button type="button" class="not-btn text-danger mr-2 BtnDelete" onclick="DeletePrescriptionDetail(${ data.prescription_detail.id })"><i class="fa fa-trash-alt"></i></button>
																			<form action="/prescription/prescription_detail/${ data.prescription_detail.id }/delete" method="post" accept-charset="UTF-8" id="form-item-${ data.prescription_detail.id }" class="sr-only">
																				@csrf
																				<input type="hidden" name="_method" value="DELETE" />
																			</form>
																		</div>
																	</li>`);
					$('[name="item_medicine_id"]').val('').trigger('change');
					$('[name="item_medicine_name"]').val( '' );
					$('[name="item_medicine_usage"]').val( '' );
					$('[name="item_morning"]').val( '0' );
					$('[name="item_afternoon"]').val( '0' );
					$('[name="item_evening"]').val( '0' );
					$('[name="item_night"]').val( '0' );
					$('[name="item_description"]').val( '' );
					$('#create_prescription_item_modal').modal('hide');
					
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