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
			<a href="{{route('prescription.index')}}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-table"></i> &nbsp;{{ __('label.buttons.back_to_list', [ 'name' => Auth::user()->module() ]) }}</a>
		</div>

		<!-- Error Message -->
		@component('components.crud_alert')
		@endcomponent

	</div>

	{!! Form::open(['url' => route('prescription.store'),'method' => 'post','class' => 'mt-3', 'autocomplete' => 'off']) !!}
	<div class="card-body">
		@include('prescription.form')

		<div class="card card-outline card-primary mt-4">
			<div class="card-header">
				<h3 class="card-title">
					<i class="fas fa-list"></i>&nbsp;
					{{ __('alert.modal.title.prescription_detail') }}
				</h3>
				<div class="card-tools">
					<button type="button" class="btn btn-success btn-sm btn-flat" id="btn_add_item"><i class="fa fa-plus"></i> &nbsp; {!! __('label.buttons.add_medicine') !!}</button>
				</div>
			</div>
			<!-- /.card-header -->
			<div class="card-body item_list">
				<div class="mb-2" id="first-item">
					<div class="row">
						<div class="col-sm-3">
							<div class="form-group">
								{!! Html::decode(Form::label('medicine_name', __('label.form.prescription.medicine_name')."<small>*</small>")) !!}
								{!! Form::text('medicine_name[]', '', ['class' => 'form-control','placeholder' => 'name','required', 'list' => 'medicine_list']) !!}
							</div>
						</div>
						<div class="col-sm-1">
							<div class="form-group">
								{!! Html::decode(Form::label('morning', __('label.form.prescription.morning'))) !!}
								{!! Form::text('morning[]', '', ['class' => 'form-control is_number','placeholder' => 'morning']) !!}
							</div>
						</div>
						<div class="col-sm-1">
							<div class="form-group">
								{!! Html::decode(Form::label('afternoon', __('label.form.prescription.afternoon'))) !!}
								{!! Form::text('afternoon[]', '', ['class' => 'form-control is_number','placeholder' => 'afternoon']) !!}
							</div>
						</div>
						<div class="col-sm-1">
							<div class="form-group">
								{!! Html::decode(Form::label('evening', __('label.form.prescription.evening'))) !!}
								{!! Form::text('evening[]', '', ['class' => 'form-control is_number','placeholder' => 'evening']) !!}
							</div>
						</div>
						<div class="col-sm-1">
							<div class="form-group">
								{!! Html::decode(Form::label('night', __('label.form.prescription.night'))) !!}
								{!! Form::text('night[]', '', ['class' => 'form-control is_number','placeholder' => 'night']) !!}
							</div>
						</div>
						<div class="col-sm-2">
							<div class="form-group">
								{!! Html::decode(Form::label('medicine_usage', __('label.form.prescription.medicine_usage')."<small>*</small>")) !!}
								{!! Form::text('medicine_usage[]', '', ['class' => 'form-control','placeholder' => 'usage','required', 'list' => 'usage_list']) !!}
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
@include('prescription.modal')

@endsection

@section('js')
<script type="text/javascript">
	var endLoad = function () { }
	$('[name="pt_province_id"]').change( function(e){
		if ($(this).val() != '') {
			$.ajax({
				url: "{{ route('province.getSelectDistrict') }}",
				method: 'post',
				data: {
					id: $(this).val(),
				},
				success: function (data) {
					$('[name="pt_district_id"]').attr({"disabled":false});
					$('[name="pt_district_id"]').html(data);
					endLoad(); endLoad = function () { };
				}
			});
		}else{
			$('[name="pt_district_id"]').attr({"disabled":true});
			$('[name="pt_district_id"]').html('<option value="">{{ __("label.form.choose") }}</option>');
			
		}
	});


	$('.btn-prevent-submit').click(function (event) {
		event.preventDefault();
	});
	
	$('#btn_add_item').click(function (event) {
		event.preventDefault();
		var id = Math.floor(Math.random() * 1000);
		$('.item_list').append(`<div class="prescription_item" id="${ id }">
															<div class="row">
																<div class="col-sm-3">
																	<div class="form-group">
																		{!! Html::decode(Form::label('medicine_name', __('label.form.prescription.medicine_name')."<small>*</small>")) !!}
																		{!! Form::text('medicine_name[]', '', ['class' => 'form-control','placeholder' => 'name','required', 'list' => 'medicine_list']) !!}
																	</div>
																</div>
																<div class="col-sm-1">
																	<div class="form-group">
																		{!! Html::decode(Form::label('morning', __('label.form.prescription.morning'))) !!}
																		{!! Form::text('morning[]', '', ['class' => 'form-control is_number','placeholder' => 'morning']) !!}
																	</div>
																</div>
																<div class="col-sm-1">
																	<div class="form-group">
																		{!! Html::decode(Form::label('afternoon', __('label.form.prescription.afternoon'))) !!}
																		{!! Form::text('afternoon[]', '', ['class' => 'form-control is_number','placeholder' => 'afternoon']) !!}
																	</div>
																</div>
																<div class="col-sm-1">
																	<div class="form-group">
																		{!! Html::decode(Form::label('evening', __('label.form.prescription.evening'))) !!}
																		{!! Form::text('evening[]', '', ['class' => 'form-control is_number','placeholder' => 'evening']) !!}
																	</div>
																</div>
																<div class="col-sm-1">
																	<div class="form-group">
																		{!! Html::decode(Form::label('night', __('label.form.prescription.night'))) !!}
																		{!! Form::text('night[]', '', ['class' => 'form-control is_number','placeholder' => 'night']) !!}
																	</div>
																</div>
																<div class="col-sm-2">
																	<div class="form-group">
																		{!! Html::decode(Form::label('medicine_usage', __('label.form.prescription.medicine_usage')."<small>*</small>")) !!}
																		{!! Form::text('medicine_usage[]', '', ['class' => 'form-control','placeholder' => 'usage','required', 'list' => 'usage_list']) !!}
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
																			<button class="btn btn-danger btn-flat btn-block btn-prevent-submit" onclick="removeItem(${ id })"><i class="fa fa-trash-alt"></i></button>
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
				// $('[name="pt_no"]').val(result.patient.no);
				$('[name="pt_name"]').val(result.patient.name);
				$('[name="pt_phone"]').val(result.patient.phone);
				$('[name="pt_age"]').val(result.patient.age);
				$('[name="pt_gender"]').val(result.patient.pt_gender);
				$('[name="pt_village"]').val(result.patient.address_village);
				$('[name="pt_commune"]').val(result.patient.address_commune);
				
				endLoad = function () { $('[name="pt_district_id"]').val(result.patient.address_district_id).trigger('change'); }
				$('[name="pt_province_id"]').val(result.patient.address_province_id).trigger('change');
			});
		}
		
	});



</script>
@endsection