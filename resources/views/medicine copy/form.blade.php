<div class="row">

	<div class="col-sm-6">
		<div class="form-group">
			{!! Html::decode(Form::label('name', __('label.form.name') .' <small>*</small>')) !!}
			{!! Form::text('name', ((isset($usage->name))? $usage->name : '' ), ['class' => 'form-control '. (($errors->has("name"))? "is-invalid" : ""),'placeholder' => 'name', 'required']) !!}
			{!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
		</div>
	</div>

	<div class="col-sm-6">
		<div class="form-group">
			{!! Html::decode(Form::label('code', __('label.form.usage.code'))) !!}
			{!! Form::text('code', ((isset($usage->code))? $usage->code : '' ), ['class' => 'form-control '. (($errors->has("code"))? "is-invalid" : ""),'placeholder' => 'code']) !!}
			{!! $errors->first('code', '<div class="invalid-feedback">:message</div>') !!}
		</div>
	</div>

	<div class="col-sm-12">
		<div class="form-group">
			{!! Html::decode(Form::label('description', __('label.form.remark'))) !!}
			{!! Form::textarea('description', ((isset($usage->description))? $usage->description : '' ), ['class' => 'form-control ','style' => 'height: 121px;','placeholder' => 'remark']) !!}
		</div>
	</div>
	{{-- / .col --}}

</div>
{{-- / .row --}}

