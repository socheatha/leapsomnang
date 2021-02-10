@extends('layouts.app')

@section('css')
	{{ Html::style('/css/invoice-print-style.css') }}
	<style type="text/css">
		.btn-print-prescription{
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
			<button type="button" class="btn btn-flat btn-success" data-toggle="modal" data-target="#create_prescription_item_modal"><i class="fa fa-plus"></i> {!! __('label.buttons.add_item') !!}</button>
			{{-- <button type="button" class="btn btn-success btn-flat btn-sm" data-toggle="modal" data-target="#edit_prescription_detail_modal"><i class="fa fa-list"></i> &nbsp; {!! __('label.buttons.prescription_detail') !!}</button> --}}
			<a href="{{route('prescription.index')}}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-table"></i> &nbsp;{{ __('label.buttons.back_to_list', [ 'name' => Auth::user()->module() ]) }}</a>
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


<div class="item_list my-4">
	@foreach ($prescription->prescription_details as $order => $prescription_detail)
		<div class="prescription_item" id="{{ $prescription_detail->id }}">
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						{!! Html::decode(Form::label('medicine_name', __('label.form.prescription.medicine_name')."<small>*</small>")) !!}
						{!! Form::text('show_medicine_name', $prescription_detail->medicine_name, ['class' => 'form-control', 'id' => 'input-medicine_name-'. $prescription_detail->id,'placeholder' => 'name','readonly']) !!}
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						{!! Html::decode(Form::label('morning', __('label.form.prescription.morning')."<small>*</small>")) !!}
						{!! Form::number('show_morning', $prescription_detail->morning, ['class' => 'form-control is_number', 'id' => 'input-morning-'. $prescription_detail->id,'min' => '0','placeholder' => 'morning','readonly']) !!}
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						{!! Html::decode(Form::label('afternoon', __('label.form.prescription.afternoon')."<small>*</small>")) !!}
						{!! Form::number('show_afternoon', $prescription_detail->afternoon, ['class' => 'form-control is_number', 'id' => 'input-afternoon-'. $prescription_detail->id,'min' => '0','placeholder' => 'afternoon','readonly']) !!}
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						{!! Html::decode(Form::label('evening', __('label.form.prescription.evening')." <small>*</small>")) !!}
						{!! Form::number('show_evening', $prescription_detail->evening, ['class' => 'form-control is_number', 'id' => 'input-evening-'. $prescription_detail->id,'min' => '0','placeholder' => 'evening','readonly']) !!}
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						{!! Html::decode(Form::label('night', __('label.form.prescription.night')." <small>*</small>")) !!}
						{!! Form::number('show_night', $prescription_detail->night, ['class' => 'form-control is_number', 'id' => 'input-night-'. $prescription_detail->id,'min' => '0','placeholder' => 'night','readonly']) !!}
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						{!! Html::decode(Form::label('medicine_usage', __('label.form.prescription.medicine_usage')."<small>*</small>")) !!}
						{!! Form::text('show_medicine_usage', $prescription_detail->medicine_usage, ['class' => 'form-control', 'id' => 'input-medicine_usage-'. $prescription_detail->id,'placeholder' => 'usage','readonly']) !!}
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						{!! Html::decode(Form::label('description', __('label.form.description'))) !!}
						{!! Form::textarea('show_description', $prescription_detail->description, ['class' => 'form-control', 'id' => 'input-description-'. $prescription_detail->id,'placeholder' => 'description','style' => 'height: 38px','readonly']) !!}
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						{!! Html::decode(Form::label('', __('label.buttons.action'))) !!}
						<div>
							<button class="btn btn-info btn-flat" onclick="editPrescriptionDetail('{{ $prescription_detail->id }}')"><i class="fa fa-pencil-alt"></i></button>
							<button class="btn btn-danger btn-flat" onclick="deletePrescriptionDetail({{ $prescription_detail->id }})"><i class="fa fa-trash-alt"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	@endforeach
</div>

<div class="position-relative">
	@can("Prescription Print")
		<button type="button" class="btn btn-flat btn-success position-absolute mr-9 mt-5 btn-print-prescription" data-url="{{ route('prescription.print', $prescription->id) }}"><i class="fa fa-print"></i> {{ __("label.buttons.print") }}</button>
	@endCan
</div>

<div class="pb-2 print-preview">
	{!! $prescription_preview !!}
</div>

{{-- <!--Prescription Detail Modal -->
<div class="modal fade" id="edit_prescription_detail_modal">
	<div class="modal-dialog mw-100" style="width: 98%;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">{{ __('alert.modal.title.prescription_detail') }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			
			<div class="modal-body">

				<div class="item_list">
					@foreach ($prescription->prescription_details as $order => $prescription_detail)
						<div class="prescription_item" id="{{ $prescription_detail->id }}">
							<div class="row">
								<div class="col-sm-3">
									<div class="form-group">
										{!! Html::decode(Form::label('medicine_name', __('label.form.prescription.medicine_name')."<small>*</small>")) !!}
										{!! Form::text('show_medicine_name', $prescription_detail->medicine_name, ['class' => 'form-control', 'id' => 'input-medicine_name-'. $prescription_detail->id,'placeholder' => 'name','readonly']) !!}
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										{!! Html::decode(Form::label('morning', __('label.form.prescription.morning')."<small>*</small>")) !!}
										{!! Form::number('show_morning', $prescription_detail->morning, ['class' => 'form-control is_number', 'id' => 'input-morning-'. $prescription_detail->id,'min' => '0','placeholder' => 'morning','readonly']) !!}
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										{!! Html::decode(Form::label('afternoon', __('label.form.prescription.afternoon')."<small>*</small>")) !!}
										{!! Form::number('show_afternoon', $prescription_detail->afternoon, ['class' => 'form-control is_number', 'id' => 'input-afternoon-'. $prescription_detail->id,'min' => '0','placeholder' => 'afternoon','readonly']) !!}
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										{!! Html::decode(Form::label('evening', __('label.form.prescription.evening')." <small>*</small>")) !!}
										{!! Form::number('show_evening', $prescription_detail->evening, ['class' => 'form-control is_number', 'id' => 'input-evening-'. $prescription_detail->id,'min' => '0','placeholder' => 'evening','readonly']) !!}
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										{!! Html::decode(Form::label('night', __('label.form.prescription.night')." <small>*</small>")) !!}
										{!! Form::number('show_night', $prescription_detail->night, ['class' => 'form-control is_number', 'id' => 'input-night-'. $prescription_detail->id,'min' => '0','placeholder' => 'night','readonly']) !!}
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										{!! Html::decode(Form::label('medicine_usage', __('label.form.prescription.medicine_usage')."<small>*</small>")) !!}
										{!! Form::text('show_medicine_usage', $prescription_detail->medicine_usage, ['class' => 'form-control', 'id' => 'input-medicine_usage-'. $prescription_detail->id,'placeholder' => 'usage','readonly']) !!}
									</div>
								</div>
								<div class="col-sm-2">
									<div class="form-group">
										{!! Html::decode(Form::label('description', __('label.form.description'))) !!}
										{!! Form::textarea('show_description', $prescription_detail->description, ['class' => 'form-control', 'id' => 'input-description-'. $prescription_detail->id,'placeholder' => 'description','style' => 'height: 38px','readonly']) !!}
									</div>
								</div>
								<div class="col-sm-1">
									<div class="form-group">
										{!! Html::decode(Form::label('', __('label.buttons.action'))) !!}
										<div>
											<button class="btn btn-info btn-flat" onclick="editPrescriptionDetail('{{ $prescription_detail->id }}')"><i class="fa fa-pencil-alt"></i></button>
											<button class="btn btn-danger btn-flat" onclick="deletePrescriptionDetail({{ $prescription_detail->id }})"><i class="fa fa-trash-alt"></i></button>
										</div>
									</div>
								</div>
							</div>
						</div>
					@endforeach

					@if (count($prescription->prescription_details) == 0)
						<div class="text-muted text-center empty_data_list mb-4">
							{!! __('alert.modal.title.empty_data') !!}
						</div>
					@endif

				</div>
					
					
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
</div> --}}

<!-- Edit Prescription Item Modal -->
<div class="modal add fade" id="edit_prescription_item_modal">
	<div class="modal-dialog mw-100" style="width: 80%;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">{{ __('alert.modal.title.edit_item') }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				{!! Form::hidden('edit_item_id', '') !!}
				
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							{!! Html::decode(Form::label('edit_item_medicine_name', __('label.form.prescription.medicine_name')."<small>*</small>")) !!}
							{!! Form::text('edit_item_medicine_name', '', ['class' => 'form-control','placeholder' => 'name','required']) !!}
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							{!! Html::decode(Form::label('edit_item_morning', __('label.form.prescription.morning')."<small>*</small>")) !!}
							{!! Form::number('edit_item_morning', '0', ['class' => 'form-control is_number','min' => '0','placeholder' => 'morning','required']) !!}
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							{!! Html::decode(Form::label('edit_item_afternoon', __('label.form.prescription.afternoon')."<small>*</small>")) !!}
							{!! Form::number('edit_item_afternoon', '0', ['class' => 'form-control is_number','min' => '0','placeholder' => 'afternoon','required']) !!}
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							{!! Html::decode(Form::label('edit_item_evening', __('label.form.prescription.evening')." <small>*</small>")) !!}
							{!! Form::number('edit_item_evening', '0', ['class' => 'form-control is_number','min' => '0','placeholder' => 'evening','required']) !!}
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							{!! Html::decode(Form::label('edit_item_night', __('label.form.prescription.night')." <small>*</small>")) !!}
							{!! Form::number('edit_item_night', '0', ['class' => 'form-control is_number','min' => '0','placeholder' => 'night','required']) !!}
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							{!! Html::decode(Form::label('edit_item_medicine_usage', __('label.form.prescription.medicine_usage')."<small>*</small>")) !!}
							{!! Form::text('edit_item_medicine_usage', '', ['class' => 'form-control','placeholder' => 'usage','required']) !!}
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							{!! Html::decode(Form::label('edit_item_description', __('label.form.description'))) !!}
							{!! Form::textarea('edit_item_description', '', ['class' => 'form-control','placeholder' => 'description','style' => 'height: 38px']) !!}
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
			data.push({id:'{{ $prescription->patient_id }}', text:'PT-{{ str_pad($prescription->patient_id, 6, "0", STR_PAD_LEFT) }} :: {{ (($prescription->patient_id != '')? $prescription->patient->name : '' )}}'});
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
	// $('.todo-list').sortable({
	// 	update: function( ) {
	// 		var order = new Array();
	// 		var order_origin = new Array();
	// 		var i = 0;
	// 		$( ".todo-list li" ).each(function( index ) {
	// 			order.push(++i);
	// 			order_origin.push($(this).data('order'));
	// 		});
	// 		console.log(order);
	// 		var compare = isArrayEqual(order, order_origin);
	// 		if ( compare === "False" ) {
	// 			$('.save_order_block').html('<button type="button" class="btn btn-flat btn-primary btn_save_order"><i class="fa fa-save"></i> {{ __("label.buttons.save_order") }}</button>');
	// 			save_order()
	// 		}else{
	// 			$('.save_order_block').html('');
	// 		}
	// 	}
	// });
	
	// function save_order() {
      
	// 	$('.btn_save_order').click(function () {

	// 		const swalWithBootstrapButtons = Swal.mixin({
	// 			customClass: {
	// 				confirmButton: 'btn btn-success btn-flat ml-2 py-2 px-3',
	// 				cancelButton: 'btn btn-danger btn-flat mr-2 py-2 px-3'
	// 			},
	// 			buttonsStyling: false
	// 		})

	// 		swalWithBootstrapButtons.fire({
	// 			title: '{{ __("alert.swal.title.save") }}',
	// 			text: '{{ __("alert.swal.text.save") }}',
	// 			icon: 'warning',
	// 			showCancelButton: true,
	// 			confirmButtonText: '{{ __("alert.swal.button.yes") }}',
	// 			cancelButtonText: '{{ __("alert.swal.button.no") }}',
	// 			reverseButtons: true
	// 		}).then((result) => {
	// 			if (result.value) {
	// 				var order = new Array();
	// 				var ids = new Array();
	// 				var i = 0;
	// 				$( ".todo-list li" ).each(function( index ) {
	// 					order.push(++i);
	// 					ids.push($(this).data('id'));
	// 				});
	// 				$( "#save_order_form [name='item_ids']" ).val(ids);
	// 				$( "#save_order_form [name='order_ids']" ).val(order);
	// 				$( "#save_order_form form" ).submit();
	// 			}
	// 		})
	// 	});
	// }


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
	
	function editPrescriptionDetail(id) {
		$.ajax({
			url: "{{ route('prescription.prescription_detail.getDetail') }}",
			type: 'post',
			data: {
				id: id
			},
		})
		.done(function( result ) {
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
	

	function deletePrescriptionDetail(id) {
		
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
					url: "{{ route('prescription.prescription_detail.deletePrescriptionDetail') }}",
					type: 'post',
					data: {
						id: id
					},
					success: function(data){
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
				$('.print-preview').html(data.prescription_preview);
				$("#input-medicine_name-"+ data.prescription_detail.id).val(data.prescription_detail.medicine_name);
				$("#input-medicine_usage-"+ data.prescription_detail.id).val(data.prescription_detail.medicine_usage);
				$("#input-morning-"+ data.prescription_detail.id).val(data.prescription_detail.morning);
				$("#input-afternoon-"+ data.prescription_detail.id).val(data.prescription_detail.afternoon);
				$("#input-evening-"+ data.prescription_detail.id).val(data.prescription_detail.evening);
				$("#input-night-"+ data.prescription_detail.id).val(data.prescription_detail.night);
				$("#input-description-"+ data.prescription_detail.id).val(data.prescription_detail.description);
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
		if ($('[name="item_medicine_name"]').val() !='' && $('[name="item_medicine_usage"]').val() !='' && $('[name="item_morning"]').val() !='' && $('[name="item_afternoon"]').val() !='' && $('[name="item_evening"]').val() !='' && $('[name="item_night"]').val() !='') {
		
			$.ajax({
				url: "{{ route('prescription.prescription_detail.store') }}",
				method: 'post',
				data: {
						prescription_id: '{{ $prescription->id }}',
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
					console.log(data.prescription_detail.description);

					$('.item_list').append(	`<div class="prescription_item" id="${ data.prescription_detail.id }">
																			<div class="row">
																				<div class="col-sm-3">
																					<div class="form-group">
																						{!! Html::decode(Form::label('medicine_name', __('label.form.prescription.medicine_name')."<small>*</small>")) !!}
																						<input name="show_medicine_name" class="form-control" id="input-medicine_name-${ data.prescription_detail.id }" value="${ data.prescription_detail.medicine_name }" placeholder="name" readonly="" />
																					</div>
																				</div>
																				<div class="col-sm-1">
																					<div class="form-group">
																						{!! Html::decode(Form::label('morning', __('label.form.prescription.morning')."<small>*</small>")) !!}
																						<input name="show_morning" class="form-control" min="0" id="input-morning-${ data.prescription_detail.id }" value="${ data.prescription_detail.morning }" placeholder="morning" readonly="" />
																					</div>
																				</div>
																				<div class="col-sm-1">
																					<div class="form-group">
																						{!! Html::decode(Form::label('afternoon', __('label.form.prescription.afternoon')."<small>*</small>")) !!}
																						<input name="show_afternoon" class="form-control" min="0" id="input-afternoon-${ data.prescription_detail.id }" value="${ data.prescription_detail.afternoon }" placeholder="afternoon" readonly="" />
																					</div>
																				</div>
																				<div class="col-sm-1">
																					<div class="form-group">
																						{!! Html::decode(Form::label('evening', __('label.form.prescription.evening')." <small>*</small>")) !!}
																						<input name="show_evening" class="form-control is_number" min="0" id="input-evening-${ data.prescription_detail.id }" value="${ data.prescription_detail.evening }" placeholder="evening" readonly="" />
																					</div>
																				</div>
																				<div class="col-sm-1">
																					<div class="form-group">
																						{!! Html::decode(Form::label('night', __('label.form.prescription.night')." <small>*</small>")) !!}
																						<input name="show_night" class="form-control is_number" min="0" id="input-night-${ data.prescription_detail.id }" value="${ data.prescription_detail.night }" placeholder="night" readonly="" />
																					</div>
																				</div>
																				<div class="col-sm-2">
																					<div class="form-group">
																						{!! Html::decode(Form::label('medicine_usage', __('label.form.prescription.medicine_usage')."<small>*</small>")) !!}
																						<input name="show_medicine_usage" class="form-control" id="input-medicine_usage-${ data.prescription_detail.id }" value="${ data.prescription_detail.medicine_usage }" placeholder="usage" readonly="" />
																					</div>
																				</div>
																				<div class="col-sm-2">
																					<div class="form-group">
																						{!! Html::decode(Form::label('description', __('label.form.description'))) !!}
																						<textarea name="show_description" class="form-control is_number" min="0" id="input-night-${ data.prescription_detail.id }" style="height: 38px" placeholder="description" readonly="" >${ ((data.prescription_detail.description=='null' || data.prescription_detail.description==null || data.prescription_detail.description=='')? '' : data.prescription_detail.description) }</textarea>
																					</div>
																				</div>
																				<div class="col-sm-1">
																					<div class="form-group">
																						{!! Html::decode(Form::label('', __('label.buttons.action'))) !!}
																						<div>
																							<button class="btn btn-info btn-flat" onclick="editPrescriptionDetail('${ data.prescription_detail.id }')"><i class="fa fa-pencil-alt"></i></button>
																							<button class="btn btn-danger btn-flat" onclick="deletePrescriptionDetail(${ data.prescription_detail.id })"><i class="fa fa-trash-alt"></i></button>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>`);

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
						timer: 1500
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