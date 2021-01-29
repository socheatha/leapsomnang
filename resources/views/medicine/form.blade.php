<div class="row">

	<div class="col-sm-6">
		<div class="form-group">
			{!! Html::decode(Form::label('name', __('label.form.name') .' <small>*</small>')) !!}
			{!! Form::text('name', ((isset($medicine->name))? $medicine->name : '' ), ['class' => 'form-control '. (($errors->has("name"))? "is-invalid" : ""),'placeholder' => 'name', 'required']) !!}
			{!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
		</div>
	</div>

	<div class="col-sm-3">
		<div class="form-group">
			{!! Html::decode(Form::label('code', __('label.form.medicine.code'))) !!}
			{!! Form::text('code', ((isset($medicine->code))? $medicine->code : '' ), ['class' => 'form-control '. (($errors->has("code"))? "is-invalid" : ""),'placeholder' => 'code']) !!}
			{!! $errors->first('code', '<div class="invalid-feedback">:message</div>') !!}
		</div>
	</div>
	<div class="col-sm-3">
		<div class="form-group">
			{!! Html::decode(Form::label('usage_id', __('label.form.medicine.usage'))) !!}
			{!! Form::select('usage_id', $usages, ((isset($medicine->usage_id))? $medicine->usage_id : '' ), ['class' => 'form-control select2 usage_id','placeholder' => __('label.form.choose')]) !!}
		</div>
	</div>

	<div class="col-sm-12">
		<div class="form-group">
			{!! Html::decode(Form::label('description', __('label.form.remark'))) !!}
			{!! Form::textarea('description', ((isset($medicine->description))? $medicine->description : '' ), ['class' => 'form-control ','style' => 'height: 121px;','placeholder' => 'remark']) !!}
		</div>
	</div>
	{{-- / .col --}}

</div>
{{-- / .row --}}

