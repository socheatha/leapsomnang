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
            <a href="{{route('user.index')}}" class="dropdown-item text-danger"><i class="fa fa-arrow-left"></i> &nbsp;{{ __('label.buttons.back') }}</a>
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


		{!! Form::open(['url' => route('user.update', [$user->id, 'edit']),'method' => 'post','autocomplete'=>'off']) !!}
		{!! Form::hidden('_method', 'PUT') !!}

		<div class="card-body">
			<div class="row">
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								{!! Html::decode(Form::label('first_name', __('label.form.user.first_name')." <small>*</small>")) !!}
								{!! Form::text('first_name', ((isset($user->first_name))? $user->first_name : '' ), ['class' => 'form-control '. (($errors->has("first_name"))? "is-invalid" : ""),'placeholder' =>
								'first name','required']) !!}
								{!! $errors->first('first_name', '<span class="invalid-feedback">:message</span>') !!}
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								{!! Html::decode(Form::label('last_name', __('label.form.user.last_name')." <small>*</small>")) !!}
								{!! Form::text('last_name', ((isset($user->last_name))? $user->last_name : '' ), ['class' => 'form-control '. (($errors->has("last_name"))? "is-invalid" : ""),'placeholder' =>
								'last name','required']) !!}
								{!! $errors->first('last_name', '<span class="invalid-feedback">:message</span>') !!}
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-9">
							<div class="form-group">
								{!! Html::decode(Form::label('gender', __('label.form.user.gender')." <small>*</small>")) !!}
								{!! Form::select('gender', ['1'=>__('label.form.male'),'2'=>__('label.form.female'),'3'=>__('label.form.other')], ((isset($user->gender))? $user->gender : '' ), ['class' => 'form-control custom-select '. (($errors->has("gender"))? "is-invalid" : ""),'placeholder' =>
								__('label.form.choose'),'required']) !!}
								{!! $errors->first('gender', '<span class="invalid-feedback">:message</span>') !!}
							</div>
						</div>
						<div class="col-sm-3">
							<div class="form-group text-center">
								{!! Html::decode(Form::label('status', __('label.form.user.status'))) !!}
								<div class="togglebutton mt-1">
									<label>
										{!! Form::checkbox('status',((isset($user->status))? $user->status : 1 ), ((isset($user->status))? (($user->status==1)? true : false ) : true)) !!}
										<span class="toggle toggle-success"></span>
									</label>
								</div>
							</div>
						</div>
					</div>
				</div>
				{{-- / .col --}}
	
				<div class="col-sm-6">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								{!! Html::decode(Form::label('phone', __('label.form.user.phone'))) !!}
								{!! Form::text('phone', ((isset($user->phone))? $user->phone : '' ), ['class' => 'form-control '. (($errors->has("phone"))? "is-invalid" : ""),'placeholder' => 'phone']) !!}
								{!! $errors->first('phone', '<span class="invalid-feedback">:message</span>') !!}
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								{!! Html::decode(Form::label('language', __('label.form.user.language')." <small>*</small>")) !!}
								{!! Form::select('language', [ 'kh' => __('label.lang.khmer'), 'en' => __('label.lang.english') ],
								((isset($user->language))? $user->language : '' ), ['class' => 'form-control custom-select '. (($errors->has("language"))? "is-invalid" : ""),'required']) !!}
							</div>
						</div>
					</div>
					<div class="form-group">
						{!! Html::decode(Form::label('position', __('label.form.user.position')." <small>*</small>")) !!}
						{!! Form::select('position', ['Team Tax'=>'Team Tax', 'Team Bookkeeping'=>'Team Bookkeeping', 'Office Assistant'=>'Office Assistant', 'Tax Supervisor'=>'Tax Supervisor','Operation Manager'=>'Operation Manager', 'Web Developer'=>'Web Developer', 'Director'=>'Director', 'Other'=>'Other'], ((isset($user->position))? $user->position : '' ), ['class' => 'form-control custom-select '. (($errors->has("position"))? "is-invalid" : ""),'placeholder' => __('label.form.choose'),'required']) !!}
						{!! $errors->first('position', '<span class="invalid-feedback">:message</span>') !!}
					</div>
				</div>
		
			</div>
			{{-- / .row --}}
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

	</script>
@endsection