@extends('layouts.app')

@section('css')
	<style class="text/css">

	</style>
@endsection

@section('content')

	<div class="card">
		<div class="card-header">
			<b>{!! Auth::user()->subModule() !!}</b>
			
			<div class="card-tools">

        {{-- Action Dropdown --}}
        @component('components.action')
          @slot('otherBTN')
            <a href="{{route('doctor.index')}}" class="dropdown-item text-danger"><i class="fa fa-arrow-left"></i> &nbsp;{{ __('label.buttons.back') }}</a>
          @endslot
				@endcomponent
				
				<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
					<i class="fas fa-minus"></i></button>
				{{-- <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove"><i class="fas fa-times"></i></button> --}}
			</div>

			<!-- Error Message -->
			@component('components.crud_alert')
			@endcomponent

		</div>


		{!! Form::open(['url' => route('doctor.update', [$doctor->id, 'edit']),'method' => 'post','autocomplete'=>'off']) !!}
		{!! Form::hidden('_method', 'PUT') !!}

		<div class="card-body">

			@include('doctor.form')

		</div>
		<!-- ./card-body -->
		
		<div class="card-footer text-muted text-center">
			@include('components.submit')
		</div>
		<!-- ./card-Footer -->
		{{ Form::close() }}

	</div>
@endsection

@section('js')
	<script type="text/javascript">

		$('[name="address_province_id"]').change( function(e){
			if ($(this).val() != '') {
				$.ajax({
					url: "{{ route('province.getSelectDistrict') }}",
					method: 'post',
					data: {
						id: $(this).val(),
					},
					success: function (data) {
						$('[name="address_district_id"]').attr({"disabled":false});
						$('[name="address_district_id"]').html(data);
					}
				});
			}else{
				$('[name="address_district_id"]').attr({"disabled":true});
				$('[name="address_district_id"]').html('<option value="">{{ __("label.form.choose") }}</option>');
				
			}
		});


	</script>
@endsection