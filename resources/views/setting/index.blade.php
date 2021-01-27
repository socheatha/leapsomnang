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
		{!! Form::hidden('_method', 'PUT') !!}

		<div class="card-body">
			
			<div class="row">

				<div class="col-sm-8">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								{!! Html::decode(Form::label('clinic_name_kh', __('label.form.setting.clinic_name_kh'))) !!}
								{!! Form::text('clinic_name_kh', Auth::user()->setting()->clinic_name_kh, ['class' => 'form-control '. (($errors->has("clinic_name_kh"))? "is-invalid" : ""),'placeholder' => 'clinic name in khmer']) !!}
								{!! $errors->first('clinic_name_kh', '<div class="invalid-feedback">:message</div>') !!}
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								{!! Html::decode(Form::label('clinic_name_en', __('label.form.setting.clinic_name_en'))) !!}
								{!! Form::text('clinic_name_en', Auth::user()->setting()->clinic_name_en, ['class' => 'form-control '. (($errors->has("clinic_name_en"))? "is-invalid" : ""),'placeholder' => 'clinic name in english']) !!}
								{!! $errors->first('clinic_name_en', '<div class="invalid-feedback">:message</div>') !!}
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group">
								{!! Html::decode(Form::label('phone', __('label.form.phone'))) !!}
								{!! Form::text('phone', Auth::user()->setting()->phone, ['class' => 'form-control '. (($errors->has("phone"))? "is-invalid" : ""),'placeholder' => 'commune']) !!}
								{!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
							</div>
						</div>
						<div class="col-sm-9">
							<div class="form-group">
								{!! Html::decode(Form::label('address', __('label.form.address'))) !!}
								{!! Form::text('address', Auth::user()->setting()->address, ['class' => 'form-control '. (($errors->has("address"))? "is-invalid" : ""),'placeholder' => 'commune']) !!}
								{!! $errors->first('address', '<div class="invalid-feedback">:message</div>') !!}
							</div>
						</div>
						<div class="col-sm-9">
							<div class="form-group">
								{!! Html::decode(Form::label('navbar_color', __('label.form.setting.navbar_color'))) !!}
								{!! Form::select('navbar_color', ['navbar-dark navbar-primary'=>'Primary', 'navbar-dark navbar-secondary'=>'Secondary', 'navbar-dark navbar-info'=>'Info', 'navbar-dark navbar-purple'=>'Purple', 'navbar-dark navbar-success'=>'Success', 'navbar-light navbar-dark'=>'Dark'], Auth::user()->setting()->navbar_color, ['class' => 'form-control select2','data-width'=>'100%', 'placeholder' => __('label.form.choose')]) !!}
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group text-center">
								{!! Html::decode(Form::label('sidebar_color', __('label.form.setting.sidebar_color'))) !!}
								<div class="togglebutton mt-1">
									<label>
										{!! Form::checkbox('sidebar_color', 0, Auth::user()->setting()->sidebar_color) !!}
										<span class="toggle toggle-success"></span>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-4 text-center">
					<div class="fileinput fileinput-new" data-provides="fileinput">
						<div class="fileinput-new img-thumbnail" style="max-width: 248px;">
							<img data-src="" src="/images/setting/{{ Auth::user()->setting()->logo }}" alt="{{ Auth::user()->setting()->logo }}">
						</div>
						<div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 248px;"></div>
						<div class="mt-2">
							<span class="btn btn-outline-secondary btn-file">
								<span class="fileinput-new">{{ __('label.buttons.select') }}</span>
								<span class="fileinput-exists">{{ __('label.buttons.change') }}</span>
								<input type="file" name="logo" />
							</span>
							<a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">{{ __('label.buttons.remove') }}</a>
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
		$('[name="navbar_color"]').change(function () {
			$('.main-header').attr('class', 'main-header navbar navbar-expand ' + $(this).val())
		});

		// $('[name="sidebar_color"]').change(function () {
		// 	$('.main-sidebar').attr('class', 'main-sidebar elevation-4 ' + $(this).val())
		// });

		$('#sidebar_color').change(function () {
			if ($(this).val()=='0') {
				$('.main-sidebar').attr('class', 'main-sidebar elevation-4 sidebar-dark-success')
			}else{
				$('.main-sidebar').attr('class', 'main-sidebar elevation-4 sidebar-light-success')
			}
		});
	</script>
@endsection