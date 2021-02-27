<div class="row">

	<div class="col-sm-3">
		<div class="form-group">
			{!! Html::decode(Form::label('name', __('label.form.name') .' <small>*</small>')) !!}
			{!! Form::text('name', ((isset($labor_service->name))? $labor_service->name : '' ), ['class' => 'form-control '. (($errors->has("name"))? "is-invalid" : ""),'placeholder' => 'name', 'required']) !!}
			{!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
		</div>
	</div>

	<div class="col-sm-3">
		<div class="form-group">
			{!! Html::decode(Form::label('category_id', __('label.form.labor_service.category') .' <small>*</small>')) !!}
			{!! Form::select('category_id', $categories, ((isset($labor_service->category_id))? $labor_service->category_id : '' ), ['class' => 'form-control select2 category_id','placeholder' => __('label.form.choose'), 'required']) !!}
		</div>
	</div>

	<div class="col-sm-3">
		<div class="form-group">
			{!! Html::decode(Form::label('unit', __('label.form.labor_service.unit'))) !!}
			{!! Form::text('unit', ((isset($labor_service->unit))? $labor_service->unit : '' ), ['class' => 'form-control '. (($errors->has("unit"))? "is-invalid" : ""),'placeholder' => 'unit']) !!}
			{!! $errors->first('unit', '<div class="invalid-feedback">:message</div>') !!}
		</div>
	</div>

	<div class="col-sm-3">
		<div class="form-group">
			{!! Html::decode(Form::label('reference', __('label.form.labor_service.reference'))) !!}
			{!! Form::text('reference', ((isset($labor_service->reference))? $labor_service->reference : '' ), ['class' => 'form-control '. (($errors->has("reference"))? "is-invalid" : ""),'placeholder' => 'reference']) !!}
			{!! $errors->first('reference', '<div class="invalid-feedback">:message</div>') !!}
		</div>
	</div>

	<div class="col-sm-12">
		<div class="form-group">
			{!! Html::decode(Form::label('description', __('label.form.description'))) !!}
			{!! Form::textarea('description', ((isset($labor_service->description))? $labor_service->description : '' ), ['class' => 'form-control ','style' => 'height: 121px;','placeholder' => 'description']) !!}
		</div>
	</div>
	{{-- / .col --}}

</div>
{{-- / .row --}}

