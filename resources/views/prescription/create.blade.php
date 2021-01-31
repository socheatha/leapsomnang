@extends('layouts.app')

@section('css')
	{{ Html::style('/css/prescription-print-style.css') }}
	<style type="text/css">
	
	</style>
@endsection

@section('content')
<div class="card">
	<div class="card-header">
		<b>{!! Auth::user()->subModule() !!}</b>
		<div class="card-tools">
			<button type="button" class="btn btn-success btn-sm btn-flat"  data-toggle="modal" data-target="#create_prescription_item_modal"><i class="fa fa-plus"></i> &nbsp; {!! __('label.buttons.add_item') !!}</button>
			{{-- Action Dropdown --}}
			@component('components.action')
				@slot('otherBTN')
					<a href="{{route('prescription.index')}}" class="dropdown-item text-danger"><i class="fa fa-arrow-left"></i> &nbsp;{{ __('label.buttons.back') }}</a>
				@endslot
			@endcomponent

			<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fas fa-minus"></i></button>
		</div>

		<!-- Error Message -->
		@component('components.crud_alert')
		@endcomponent

	</div>

	{!! Form::open(['url' => route('prescription.store'),'method' => 'post','class' => 'mt-3']) !!}
	<div class="card-body">
		@include('prescription.form')

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

@include('prescription.modal')

@endsection

@section('js')
<script type="text/javascript">


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

	
	$('#btn_add_item').click(function () {

		if ($('[name="item_medicine_id"]').val() !='' && $('[name="item_medicine_name"]').val() !='' && $('[name="item_medicine_usage"]').val() !='' && $('[name="item_morning"]').val() !='' && $('[name="item_afternoon"]').val() !='' && $('[name="item_evening"]').val() !='' && $('[name="item_night"]').val() !='') {	
			var id = Math.floor(Math.random() * 1000);
			$('.todo-list').append(	`<li class="${ id }">
																<input type="hidden" name="medicine_id[]" value="${ $('[name="item_medicine_id"]').val() }" />
																<input type="hidden" name="medicine_name[]" value="${ $('[name="item_medicine_name"]').val() }" />
																<input type="hidden" name="medicine_usage[]" value="${ $('[name="item_medicine_usage"]').val() }" />
																<input type="hidden" name="morning[]" value="${ $('[name="item_morning"]').val() }" />
																<input type="hidden" name="afternoon[]" value="${ $('[name="item_afternoon"]').val() }" />
																<input type="hidden" name="evening[]" value="${ $('[name="item_evening"]').val() }" />
																<input type="hidden" name="night[]" value="${ $('[name="item_night"]').val() }" />
																<input type="hidden" name="description[]" value="${ $('[name="item_description"]').val() }" />
																<!-- drag handle -->
																<span class="handle">
																	<i class="fas fa-ellipsis-v"></i>
																	<i class="fas fa-ellipsis-v"></i>
																</span>
																<span class="text">${ $('[name="item_medicine_name"]').val() }</span>
																<small class="badge badge-info">${ $('[name="item_medicine_usage"]').val() }</small>
																<small class="badge badge-danger">morning:${ $('[name="item_morning"]').val() }, afternoon:${ $('[name="item_afternoon"]').val() }, evening:${ $('[name="item_evening"]').val() }, night:${ $('[name="item_night"]').val() }</small>
																<div class="tools">
																	<i class="fa fa-times text-danger btn_remove_item" data-id="${ id }"></i>
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

			$('.btn_remove_item').click( function () {
				$('.'+ $(this).data('id')).remove();
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