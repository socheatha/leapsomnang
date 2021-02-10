@extends('layouts.app')

@section('css')
	<style type="text/css">
		.item_list{
			padding: 20px;
			margin-top: 10px;
			background: #f1f1f1;
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
			<button type="button" class="btn btn-success btn-sm btn-flat" id="btn_add_item"><i class="fa fa-plus"></i> &nbsp; {!! __('label.buttons.add_item') !!}</button>
			<a href="{{route('prescription.index')}}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-table"></i> &nbsp;{{ __('label.buttons.back_to_list', [ 'name' => Auth::user()->module() ]) }}</a>
		</div>

		<!-- Error Message -->
		@component('components.crud_alert')
		@endcomponent

	</div>

	{!! Form::open(['url' => route('prescription.store'),'method' => 'post','class' => 'mt-3']) !!}
	<div class="card-body">
		@include('prescription.form')

		<div class="item_list">
			<div class="prescription_item" id="first-item">
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							{!! Html::decode(Form::label('medicine_name', __('label.form.prescription.medicine_name')."<small>*</small>")) !!}
							{!! Form::text('medicine_name[]', '', ['class' => 'form-control','placeholder' => 'name','required']) !!}
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							{!! Html::decode(Form::label('morning', __('label.form.prescription.morning')."<small>*</small>")) !!}
							{!! Form::number('morning[]', '0', ['class' => 'form-control is_number','min' => '1','placeholder' => 'morning','required']) !!}
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							{!! Html::decode(Form::label('afternoon', __('label.form.prescription.afternoon')."<small>*</small>")) !!}
							{!! Form::number('afternoon[]', '0', ['class' => 'form-control is_number','min' => '1','placeholder' => 'afternoon','required']) !!}
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							{!! Html::decode(Form::label('evening', __('label.form.prescription.evening')." <small>*</small>")) !!}
							{!! Form::number('evening[]', '0', ['class' => 'form-control is_number','min' => '1','placeholder' => 'evening','required']) !!}
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							{!! Html::decode(Form::label('night', __('label.form.prescription.night')." <small>*</small>")) !!}
							{!! Form::number('night[]', '0', ['class' => 'form-control is_number','min' => '1','placeholder' => 'night','required']) !!}
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							{!! Html::decode(Form::label('medicine_usage', __('label.form.prescription.medicine_usage')."<small>*</small>")) !!}
							{!! Form::text('medicine_usage[]', '', ['class' => 'form-control','placeholder' => 'usage','required']) !!}
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							{!! Html::decode(Form::label('description', __('label.form.description'))) !!}
							{!! Form::textarea('description[]', '', ['class' => 'form-control','placeholder' => 'description','style' => 'height: 38px']) !!}
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							{!! Html::decode(Form::label('', __('label.buttons.remove'))) !!}
							<div>
								<button class="btn btn-danger btn-flat btn-block" onclick="removeItem('first-item')"><i class="fa fa-trash-alt"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

	</div>
	<!-- ./card-body -->
	
	<div class="card-footer text-muted text-center">
		@include('components.submit')
	</div>
	<!-- ./card-Footer -->
	{{ Form::close() }}

</div>

@include('prescription.modal')

@endsection

@section('js')
<script type="text/javascript">


	
	$('#btn_add_item').click(function () {

	var id = Math.floor(Math.random() * 1000);

	$('.item_list').append(`
		<div class="prescription_item" id="${ id }">
			<div class="row">
				<div class="col-sm-3">
					<div class="form-group">
						{!! Html::decode(Form::label('medicine_name', __('label.form.prescription.medicine_name')."<small>*</small>")) !!}
						{!! Form::text('medicine_name[]', '', ['class' => 'form-control','placeholder' => 'name','required']) !!}
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						{!! Html::decode(Form::label('morning', __('label.form.prescription.morning')."<small>*</small>")) !!}
						{!! Form::number('morning[]', '0', ['class' => 'form-control is_number','min' => '1','placeholder' => 'morning','required']) !!}
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						{!! Html::decode(Form::label('afternoon', __('label.form.prescription.afternoon')."<small>*</small>")) !!}
						{!! Form::number('afternoon[]', '0', ['class' => 'form-control is_number','min' => '1','placeholder' => 'afternoon','required']) !!}
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						{!! Html::decode(Form::label('evening', __('label.form.prescription.evening')." <small>*</small>")) !!}
						{!! Form::number('evening[]', '0', ['class' => 'form-control is_number','min' => '1','placeholder' => 'evening','required']) !!}
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						{!! Html::decode(Form::label('night', __('label.form.prescription.night')." <small>*</small>")) !!}
						{!! Form::number('night[]', '0', ['class' => 'form-control is_number','min' => '1','placeholder' => 'night','required']) !!}
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						{!! Html::decode(Form::label('medicine_usage', __('label.form.prescription.medicine_usage')."<small>*</small>")) !!}
						{!! Form::text('medicine_usage[]', '', ['class' => 'form-control','placeholder' => 'usage','required']) !!}
					</div>
				</div>
				<div class="col-sm-2">
					<div class="form-group">
						{!! Html::decode(Form::label('description', __('label.form.description'))) !!}
						{!! Form::textarea('description[]', '', ['class' => 'form-control','placeholder' => 'description','style' => 'height: 38px']) !!}
					</div>
				</div>
				<div class="col-sm-1">
					<div class="form-group">
						{!! Html::decode(Form::label('', __('label.buttons.remove'))) !!}
						<div>
							<button class="btn btn-danger btn-flat btn-block" onclick="removeItem(${ id })"><i class="fa fa-trash-alt"></i></button>
						</div>
					</div>
				</div>
			</div>
		</div>`);
	});

	function removeItem(id) {
		$('#'+id).remove();
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
	// 				$('[name="item_medicine_name"]').val( data.medicine.name );
	// 				$('[name="item_medicine_usage"]').val( data.medicine.usage.name );
	// 			}
	// 		});
			
	// 	}
	// });

	
	// $('#btn_add_item').click(function () {

	// 	if ($('[name="item_medicine_id"]').val() !='' && $('[name="item_medicine_name"]').val() !='' && $('[name="item_medicine_usage"]').val() !='' && $('[name="item_morning"]').val() !='' && $('[name="item_afternoon"]').val() !='' && $('[name="item_evening"]').val() !='' && $('[name="item_night"]').val() !='') {	
	// 		var id = Math.floor(Math.random() * 1000);
	// 		$('.todo-list').append(	`<li class="${ id }">
	// 															<input type="hidden" name="medicine_id[]" value="${ $('[name="item_medicine_id"]').val() }" />
	// 															<input type="hidden" name="medicine_name[]" value="${ $('[name="item_medicine_name"]').val() }" />
	// 															<input type="hidden" name="medicine_usage[]" value="${ $('[name="item_medicine_usage"]').val() }" />
	// 															<input type="hidden" name="morning[]" value="${ $('[name="item_morning"]').val() }" />
	// 															<input type="hidden" name="afternoon[]" value="${ $('[name="item_afternoon"]').val() }" />
	// 															<input type="hidden" name="evening[]" value="${ $('[name="item_evening"]').val() }" />
	// 															<input type="hidden" name="night[]" value="${ $('[name="item_night"]').val() }" />
	// 															<input type="hidden" name="description[]" value="${ $('[name="item_description"]').val() }" />
	// 															<!-- drag handle -->
	// 															<span class="handle">
	// 																<i class="fas fa-ellipsis-v"></i>
	// 																<i class="fas fa-ellipsis-v"></i>
	// 															</span>
	// 															<span class="text">${ $('[name="item_medicine_name"]').val() }</span>
	// 															<small class="badge badge-info">${ $('[name="item_medicine_usage"]').val() }</small>
	// 															<small class="badge badge-danger">morning:${ $('[name="item_morning"]').val() }, afternoon:${ $('[name="item_afternoon"]').val() }, evening:${ $('[name="item_evening"]').val() }, night:${ $('[name="item_night"]').val() }</small>
	// 															<div class="tools">
	// 																<i class="fa fa-times text-danger btn_remove_item" data-id="${ id }"></i>
	// 															</div>
	// 														</li>`);
	// 		$('[name="item_medicine_id"]').val('').trigger('change');
	// 		$('[name="item_medicine_name"]').val( '' );
	// 		$('[name="item_medicine_usage"]').val( '' );
	// 		$('[name="item_morning"]').val( '0' );
	// 		$('[name="item_afternoon"]').val( '0' );
	// 		$('[name="item_evening"]').val( '0' );
	// 		$('[name="item_night"]').val( '0' );
	// 		$('[name="item_description"]').val( '' );
	// 		$('#create_prescription_item_modal').modal('hide');

	// 		$('.btn_remove_item').click( function () {
	// 			$('.'+ $(this).data('id')).remove();
	// 		});

	// 	}else{
	// 		Swal.fire({
	// 			icon: 'warning',
	// 			title: "{{ __('alert.swal.title.empty_field') }}",
	// 			text: "{{ __('alert.swal.text.empty_field') }}",
	// 			confirmButtonText: "{{ __('alert.swal.button.yes') }}",
	// 		})
	// 	}
	// });

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