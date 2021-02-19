
  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            {!! Form::hidden('date_hidden', '',) !!}
            {!! Html::decode(Form::label('date', __('label.form.date')."(YYYY-MM-DD) <small>*</small>")) !!}
            {!! Form::text('date', ((isset($prescription->date))? $prescription->date : date('Y-m-d') ), ['class' => 'form-control datetimepicker-input '. (($errors->has("date"))? "is-invalid" : ""), 'id' => 'date_picker', 'data-toggle' => 'datetimepicker', 'data-target' => '#date_picker', 'placeholder' => 'date', 'autocomplete' => 'off', 'required']) !!}
            {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('code', __('label.form.prescription.code')." <small>*</small>")) !!}
            {!! Form::text('code', ((isset($prescription->code))? str_pad($prescription->code, 6, "0", STR_PAD_LEFT) : str_pad($code, 6, "0", STR_PAD_LEFT) ), ['class' => 'form-control is_integer '. (($errors->has("code"))? "is-invalid" : ""), 'placeholder' => 'prescription number', 'autocomplete' => 'off', 'readonly'=>'readonly', 'required']) !!}
            {!! $errors->first('code', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_diagnosis', __('label.form.echoes.pt_diagnosis'))) !!}
            {!! Form::text('pt_diagnosis', ((isset($prescription->pt_diagnosis))? $prescription->pt_diagnosis : '' ), ['class' => 'form-control '. (($errors->has("pt_diagnosis"))? "is-invalid" : ""),'placeholder' => 'diagnosis']) !!}
            {!! $errors->first('pt_diagnosis', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        
        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('remark', __('label.form.remark'))) !!}
            {!! Form::textarea('remark', ((isset($prescription->remark))? $prescription->remark : '' ), ['class' => 'form-control ','style' => 'height: 121px;','placeholder' => 'remark']) !!}
          </div>
        </div>
    
      </div>
      
    </div>
    <div class="col-sm-6">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('patient_id', __('label.form.prescription.patient'))) !!}
            {!! Form::select('patient_id', [], ((isset($prescription->patient_id))? $prescription->patient_id : '' ), ['class' => 'form-control select2_pagination patient_id','placeholder' => __('label.form.choose')]) !!}
          </div>
        </div>
<!--         
        <div class="col-sm-4">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_no', __('label.form.prescription.pt_no')." <small>*</small>")) !!}
            {!! Form::text('pt_no', ((isset($prescription->pt_no))? $prescription->pt_no : '' ), ['class' => 'form-control '. (($errors->has("pt_no"))? "is-invalid" : ""),'placeholder' => 'ptient number','required']) !!}
            {!! $errors->first('pt_no', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div> -->
        
        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_name', __('label.form.prescription.pt_name')." <small>*</small>")) !!}
            {!! Form::text('pt_name', ((isset($prescription->pt_name))? $prescription->pt_name : '' ), ['class' => 'form-control '. (($errors->has("pt_name"))? "is-invalid" : ""),'placeholder' => 'patient full name','required']) !!}
            {!! $errors->first('pt_name', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>


        <div class="col-sm-3">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_age', __('label.form.prescription.pt_age'))) !!}
            {!! Form::text('pt_age', ((isset($prescription->pt_age))? $prescription->pt_age : '' ), ['class' => 'form-control '. (($errors->has("pt_age"))? "is-invalid" : ""),'placeholder' => 'patient age']) !!}
            {!! $errors->first('pt_age', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_gender', __('label.form.prescription.pt_gender'))) !!}
            {!! Form::select('pt_gender', ['ប្រុស' => 'ប្រុស', 'ស្រី' => 'ស្រី'], ((isset($prescription->pt_gender))? $prescription->pt_gender : '' ), ['class' => 'form-control custom-select']) !!}
            {!! $errors->first('pt_gender', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_phone', __('label.form.prescription.pt_phone'))) !!}
            {!! Form::text('pt_phone', ((isset($prescription->pt_phone))? $prescription->pt_phone : '' ), ['class' => 'form-control '. (($errors->has("pt_phone"))? "is-invalid" : ""),'placeholder' => 'patient phone']) !!}
            {!! $errors->first('pt_phone', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>


        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('province_id', __('label.form.patient.province'))) !!}
            {!! Form::select('pt_province_id', $provinces, ((isset($prescription->pt_province_id))? $prescription->pt_province_id : '' ), ['class' => 'form-control select2 province_id', 'data-width'=>'100%', 'placeholder' => __('label.form.choose')]) !!}
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('district_id', __('label.form.patient.district'))) !!}
            {!! Form::select('pt_district_id', $districts, ((isset($prescription->pt_district_id))? $prescription->pt_district_id : '' ), ['class' => 'form-control select2 district_id','data-width'=>'100%', 'placeholder' => __('label.form.choose'), (($districts==[])? 'disabled' : '' )]) !!}
          </div>
        </div>
  
        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_commune', __('label.form.patient.commune'))) !!}
            {!! Form::text('pt_commune', ((isset($prescription->pt_commune))? $prescription->pt_commune : '' ), ['class' => 'form-control '. (($errors->has("pt_commune"))? "is-invalid" : ""),'placeholder' => 'commune']) !!}
            {!! $errors->first('pt_commune', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
  
        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_village', __('label.form.patient.village'))) !!}
            {!! Form::text('pt_village', ((isset($prescription->pt_village))? $prescription->pt_village : '' ), ['class' => 'form-control '. (($errors->has("pt_village"))? "is-invalid" : ""),'placeholder' => 'village']) !!}
            {!! $errors->first('pt_village', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>

      </div>
    </div>
  </div>
  <datalist id="medicine_list">
    @foreach ($medicines as $m)
      <option value="{!! $m !!}">
    @endforeach
  </datalist>



