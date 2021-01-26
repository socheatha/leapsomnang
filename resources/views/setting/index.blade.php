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

				<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
			</div>

			<!-- Error Message -->
			@component('components.crud_alert')
			@endcomponent

		</div>

		{!! Form::open(['url' => route('setting.update'), 'method'=>'post', 'enctype'=>'multipart/form-data','class' => 'mt-3', 'autocomplete'=>'off']) !!}

		<div class="card-body">
			
			<div class="row">

				<div class="col-sm-8">
					<div class="form-group">
						{!! Html::decode(Form::label('clinic_name', __('label.form.setting.clinic_name'))) !!}
						{!! Form::text('clinic_name', Auth::user()->setting()->clinic_name, ['class' => 'form-control '. (($errors->has("clinic_name"))? "is-invalid" : ""),'placeholder' => 'commune']) !!}
						{!! $errors->first('clinic_name', '<div class="invalid-feedback">:message</div>') !!}
					</div>
					<div class="form-group">
						{!! Html::decode(Form::label('navbar_top_color', __('label.form.setting.navbar_top_color'))) !!}
						{!! Form::select('navbar_top_color', ['navbar-dark navbar-primary'=>'Primary', 'navbar-dark navbar-secondary'=>'Secondary', 'navbar-dark navbar-info'=>'Info', 'navbar-dark navbar-purple'=>'Purple', 'navbar-dark navbar-success'=>'Success', 'navbar-light navbar-dark'=>'Dark'], Auth::user()->setting()->theme, ['class' => 'form-control','placeholder' => __('label.form.choose')]) !!}
					</div>
					<div class="form-group">
						{!! Html::decode(Form::label('asidebar_color', __('label.form.setting.asidebar_color'))) !!}
						{!! Form::select('asidebar_color', ['sidebar-dark-primary'=>'Sidebar Dark Primary', 'sidebar-light-primary'=>'Sidebar Light Primary', 'sidebar-dark-success'=>'Sidebar Dark Success', 'sidebar-light-success'=>'Sidebar Light Success', 'sidebar-dark-info'=>'Sidebar Dark Info', 'sidebar-light-info'=>'Sidebar Light Info', 'sidebar-dark-warning'=>'Sidebar Dark Warning', 'sidebar-light-warning'=>'Sidebar Light Warning'], Auth::user()->setting()->theme, ['class' => 'form-control','placeholder' => __('label.form.choose')]) !!}
					</div>
				</div>
				<div class="col-sm-4 text-center">
					<div class="fileinput fileinput-new" data-provides="fileinput">
						<div class="fileinput-new img-thumbnail" style="max-width: 248px;">
							<img data-src="" src="/images/setting/{{ Auth::user()->setting()->logo }}" alt="{{ Auth::user()->setting()->logo }}">
						</div>
						<div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 248px;"></div>
						<div class="mt-2">
							<span class="btn btn-outline-secondary btn-file"><span
									class="fileinput-new">{{ __('label.buttons.select') }}</span><span
									class="fileinput-exists">{{ __('label.buttons.change') }}</span><input type="file"
									name="image" /></span>
							<a href="#" class="btn btn-outline-secondary fileinput-exists"
								data-dismiss="fileinput">{{ __('label.buttons.remove') }}</a>
						</div>
					</div>
				</div>
			</div>
			{{-- / .row --}}

		</div>

		<div class="card-footer text-muted text-center">
			@include('components.submit')
		</div>
		{{ Form::close() }}

	</div>
@endsection

@section('js')
	<script type="text/javascript">
		$('[name="navbar_top_color"]').change(function () {
			$('.main-header').attr('class', 'main-header navbar navbar-expand ' + $(this).val())
		});
		$('[name="asidebar_color"]').change(function () {
			$('.main-sidebar').attr('class', 'main-sidebar elevation-4 ' + $(this).val())
		});
	</script>
@endsection