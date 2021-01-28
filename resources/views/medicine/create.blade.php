@extends('layouts.app')

@section('css')
	<style class="text/css">
		label[for="father_status1"],
		label[for="father_status0"],
		label[for="mother_status1"],
		label[for="mother_status0"] {
			cursor: pointer;
		}
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
            <a href="{{route('medicine.index')}}" class="dropdown-item text-danger"><i class="fa fa-arrow-left"></i> &nbsp;{{ __('label.buttons.back') }}</a>
          @endslot
        @endcomponent

				<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
			</div>

			<!-- Error Message -->
			@component('components.crud_alert')
			@endcomponent

		</div>


		{!! Form::open(['url' => route('medicine.store'),'method' => 'post','autocomplete'=>'off']) !!}

		<div class="card-body">
			@include('medicine.form')
		</div>
		<!-- ./card-body -->
		
		<div class="card-footer text-muted text-center">
			@include('components.submit')
		</div>
		<!-- ./card-Footer -->
		{{ Form::close() }}

	</div>

	<br/>
	<br/>
	<br/>
	<br/>

@endsection

@section('js')
	<script type="text/javascript">


	</script>
@endsection