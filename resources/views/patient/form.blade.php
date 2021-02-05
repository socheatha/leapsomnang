<div class="row">

	<div class="col-sm-6">
		<div class="row">
			<div class="col-sm-12">
				<div class="form-group">
					{!! Html::decode(Form::label('name', __('label.form.name') .'<small>*</small>')) !!}
					{!! Form::text('name', ((isset($patient->name))? $patient->name : '' ), ['class' => 'form-control '. (($errors->has("name"))? "is-invalid" : ""),'placeholder' => 'name','required']) !!}
					{!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					{!! Html::decode(Form::label('age', __('label.form.patient.age')." <small>*</small>")) !!}
					{!! Form::text('age', ((isset($patient->age))? $patient->age : '' ), ['class' => 'form-control is_integer '. (($errors->has("age"))? "is-invalid" : ""),'placeholder' => 'age']) !!}
					{!! $errors->first('age', '<div class="invalid-feedback">:message</div>') !!}
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					{!! Html::decode(Form::label('gender', __('label.form.gender')." <small>*</small>")) !!}
					<div class="px-3 pt-2">
						<div class="row">
							<div class="col-sm-6">
								<div class="icheck-primary d-inline">
									<input type="radio" value="1" name="gender" id="male" {{ ((isset($patient->gender) && $patient->gender == 2 )? '' : 'checked' ) }}>
									<label for="male">
									</label>
								</div>
								{!! Html::decode(Form::label('male', __('label.form.male'))) !!}
							</div>
							<div class="col-sm-6">
								<div class="icheck-primary d-inline">
									<input type="radio" value="2" name="gender" id="female" {{ ((isset($patient->gender) && $patient->gender == 2 )? 'checked' : '' ) }}>
									<label for="female">
									</label>
								</div>
								{!! Html::decode(Form::label('female', __('label.form.female'))) !!}
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-12 col-md-12 col-lg-4">
				<div class="form-group">
					{!! Html::decode(Form::label('id_card', __('label.form.patient.id_card'))) !!}
					{!! Form::text('id_card', ((isset($patient->id_card))? $patient->id_card : '' ), ['class' => 'form-control '. (($errors->has("id_card"))? "is-invalid" : ""),'placeholder' => 'id card']) !!}
					{!! $errors->first('id_card', '<div class="invalid-feedback">:message</div>') !!}
				</div>
			</div>

			<div class="col-sm-12 col-md-12 col-lg-4">
				<div class="form-group">
					{!! Html::decode(Form::label('phone', __('label.form.phone'))) !!}
					{!! Form::text('phone', ((isset($patient->phone))? $patient->phone : '' ), ['class' => 'form-control '. (($errors->has("phone"))? "is-invalid" : ""),'placeholder' => 'phone']) !!}
					{!! $errors->first('phone', '<div class="invalid-feedback">:message</div>') !!}
				</div>
			</div>

			<div class="col-sm-12 col-md-12 col-lg-4">
				<div class="form-group">
					{!! Html::decode(Form::label('email', __('label.form.email'))) !!}
					{!! Form::email('email', ((isset($patient->email))? $patient->email : '' ), ['class' => 'form-control '. (($errors->has("email"))? "is-invalid" : ""),'placeholder' => 'email']) !!}
					{!! $errors->first('email', '<div class="invalid-feedback">:message</div>') !!}
				</div>
			</div>

			<div class="col-sm-12">
				<div class="form-group">
					{!! Html::decode(Form::label('full_address', __('label.form.patient.full_address'))) !!}
					{!! Form::text('full_address', ((isset($patient->full_address))? $patient->full_address : '' ), ['class' => 'form-control '. (($errors->has("full_address"))? "is-invalid" : ""),'placeholder' => 'full address']) !!}
					{!! $errors->first('full_address', '<div class="invalid-feedback">:message</div>') !!}
				</div>
			</div>
			

		</div>

	</div>
	{{-- / .col --}}

	<div class="col-sm-6">
		<div class="row">
			<div class="col-sm-6">
				<div class="form-group">
					{!! Html::decode(Form::label('province_id', __('label.form.patient.province'))) !!}
					{!! Form::select('address_province_id', $provinces, ((isset($patient->address_province_id))? $patient->address_province_id : '' ), ['class' => 'form-control select2 province_id', 'data-width'=>'100%', 'placeholder' => __('label.form.choose')]) !!}
				</div>
			</div>
			<div class="col-sm-6">
				<div class="form-group">
					{!! Html::decode(Form::label('district_id', __('label.form.patient.district'))) !!}
					{!! Form::select('address_district_id', $districts, ((isset($patient->address_district_id))? $patient->address_district_id : '' ), ['class' => 'form-control select2 district_id','data-width'=>'100%', 'placeholder' => __('label.form.choose'), (($districts==[])? 'disabled' : '' )]) !!}
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					{!! Html::decode(Form::label('address_commune', __('label.form.patient.commune'))) !!}
					{!! Form::text('address_commune', ((isset($patient->address_commune))? $patient->address_commune : '' ), ['class' => 'form-control '. (($errors->has("address_commune"))? "is-invalid" : ""),'placeholder' => 'commune']) !!}
					{!! $errors->first('address_commune', '<div class="invalid-feedback">:message</div>') !!}
				</div>
			</div>

			<div class="col-sm-6">
				<div class="form-group">
					{!! Html::decode(Form::label('address_village', __('label.form.patient.village'))) !!}
					{!! Form::text('address_village', ((isset($patient->address_village))? $patient->address_village : '' ), ['class' => 'form-control '. (($errors->has("address_village"))? "is-invalid" : ""),'placeholder' => 'village']) !!}
					{!! $errors->first('address_village', '<div class="invalid-feedback">:message</div>') !!}
				</div>
			</div>
			<div class="col-sm-12">
				<div class="form-group">
					{!! Html::decode(Form::label('description', __('label.form.remark'))) !!}
					{!! Form::textarea('description', ((isset($patient->description))? $patient->description : '' ), ['class' => 'form-control ','style' => 'height: 121px;','placeholder' => 'remark']) !!}
				</div>
			</div>

		</div>

	</div>
	{{-- / .col --}}

</div>
{{-- / .row --}}

