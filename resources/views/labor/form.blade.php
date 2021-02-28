
  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            {!! Form::hidden('date_hidden', '',) !!}
            {!! Html::decode(Form::label('date', __('label.form.date')."(YYYY-MM-DD) <small>*</small>")) !!}
            {!! Form::text('date', ((isset($labor->date))? $labor->date :  date('Y-m-d') ), ['class' => 'form-control datetimepicker-input '. (($errors->has("date"))? "is-invalid" : ""), 'id' => 'date_picker', 'data-toggle' => 'datetimepicker', 'data-target' => '#date_picker', 'placeholder' => 'date', 'autocomplete' => 'off', 'required']) !!}
            {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('labor_number', __('label.form.labor.labor_number')." <small>*</small>")) !!}
            {!! Form::text('labor_number', ((isset($labor->labor_number))? str_pad($labor->labor_number, 6, "0", STR_PAD_LEFT) : str_pad($labor_number, 6, "0", STR_PAD_LEFT) ), ['class' => 'form-control is_integer '. (($errors->has("labor_number"))? "is-invalid" : ""), 'placeholder' => 'labor number', 'autocomplete' => 'off', 'readonly'=>'readonly', 'required']) !!}
            {!! $errors->first('labor_number', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>

        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('remark', __('label.form.remark'))) !!}
            {!! Form::textarea('remark', ((isset($labor->remark))? $labor->remark : '' ), ['class' => 'form-control '. (($errors->has("remark"))? "is-invalid" : ""),'style' => 'height: 121px;', 'placeholder' => 'remark']) !!}
          </div>
        </div>
    
      </div>
      
    </div>
    <div class="col-sm-6">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('patient_id', __('label.form.labor.patient'))) !!}
            {!! Form::select('patient_id', [], ((isset($labor->patient_id))? $labor->patient_id : '' ), ['class' => 'form-control select2_pagination patient_id','placeholder' => __('label.form.choose')]) !!}
          </div>
        </div>
        
        <!-- <div class="col-sm-4">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_no', __('label.form.labor.pt_no')." <small>*</small>")) !!}
            {!! Form::text('pt_no', ((isset($labor->pt_no))? $labor->pt_no : '' ), ['class' => 'form-control '. (($errors->has("pt_no"))? "is-invalid" : ""),'placeholder' => 'ptient number','required']) !!}
            {!! $errors->first('pt_no', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div> -->
        
        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_name', __('label.form.labor.pt_name')." <small>*</small>")) !!}
            {!! Form::text('pt_name', ((isset($labor->pt_name))? $labor->pt_name : '' ), ['class' => 'form-control '. (($errors->has("pt_name"))? "is-invalid" : ""),'placeholder' => 'patient full name','required']) !!}
            {!! $errors->first('pt_name', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>


        <div class="col-sm-3">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_age', __('label.form.labor.pt_age'))) !!}
            {!! Form::text('pt_age', ((isset($labor->pt_age))? $labor->pt_age : '' ), ['class' => 'form-control '. (($errors->has("pt_age"))? "is-invalid" : ""),'placeholder' => 'patient age']) !!}
            {!! $errors->first('pt_age', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_gender', __('label.form.labor.pt_gender'))) !!}
            {!! Form::select('pt_gender', ['ប្រុស' => 'ប្រុស', 'ស្រី' => 'ស្រី'], ((isset($labor->pt_gender))? $labor->pt_gender : '' ), ['class' => 'form-control custom-select']) !!}
            {!! $errors->first('pt_gender', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_phone', __('label.form.labor.pt_phone'))) !!}
            {!! Form::text('pt_phone', ((isset($labor->pt_phone))? $labor->pt_phone : '' ), ['class' => 'form-control '. (($errors->has("pt_phone"))? "is-invalid" : ""),'placeholder' => 'patient phone']) !!}
            {!! $errors->first('pt_phone', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('province_id', __('label.form.patient.province'))) !!}
            {!! Form::select('pt_province_id', $provinces, ((isset($labor->pt_province_id))? $labor->pt_province_id : '' ), ['class' => 'form-control select2 province_id', 'data-width'=>'100%', 'placeholder' => __('label.form.choose')]) !!}
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('district_id', __('label.form.patient.district'))) !!}
            {!! Form::select('pt_district_id', $districts, ((isset($labor->pt_district_id))? $labor->pt_district_id : '' ), ['class' => 'form-control select2 district_id','data-width'=>'100%', 'placeholder' => __('label.form.choose'), (($districts==[])? 'disabled' : '' )]) !!}
          </div>
        </div>
  
        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_commune', __('label.form.patient.commune'))) !!}
            {!! Form::text('pt_commune', ((isset($labor->pt_commune))? $labor->pt_commune : '' ), ['class' => 'form-control '. (($errors->has("pt_commune"))? "is-invalid" : ""),'placeholder' => 'commune']) !!}
            {!! $errors->first('pt_commune', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
  
        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_village', __('label.form.patient.village'))) !!}
            {!! Form::text('pt_village', ((isset($labor->pt_village))? $labor->pt_village : '' ), ['class' => 'form-control '. (($errors->has("pt_village"))? "is-invalid" : ""),'placeholder' => 'village']) !!}
            {!! $errors->first('pt_village', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        {{-- <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_address', __('label.form.labor.pt_address'))) !!}
            {!! Form::text('pt_address', ((isset($labor->pt_address))? $labor->pt_address : '' ), ['class' => 'form-control '. (($errors->has("pt_address"))? "is-invalid" : ""),'placeholder' => 'patient address']) !!}
            {!! $errors->first('pt_address', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div> --}}

      </div>
    </div>
  </div>
  <datalist id="service_list">
    @foreach ($services as $m)
      <option data-price="{!! $m->price !!}" data-description="{!! $m->description !!}" value="{!! $m->name !!}">
    @endforeach
  </datalist>



