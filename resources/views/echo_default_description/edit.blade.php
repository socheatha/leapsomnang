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
            <a href="{{route('echo_default_description.index')}}" class="dropdown-item text-danger"><i class="fa fa-arrow-left"></i> &nbsp;{{ __('label.buttons.back') }}</a>
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


		{!! Form::open(['url' => route('echo_default_description.update', [$echo_default_description->id, 'edit']),'method' => 'post','autocomplete'=>'off']) !!}
		{!! Form::hidden('_method', 'PUT') !!}

		<div class="card-body">

			@include('echo_default_description.form')

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
	<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
	<script type="text/javascript">

		$('.my-editor').each(function (e) {
			CKEDITOR.replace(this.id, {
				height: '250',
				font_names: 'Calibrib Bold; Calibri Italic; Calibri; Roboto Regular; Roboto Bold; Khmer OS Battambang; Khmer OS Muol Light; Khmer OS Content; Khmer OS Kuolen;'
			});
		});

	</script>
@endsection