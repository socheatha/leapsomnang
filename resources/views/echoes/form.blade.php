
  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::hidden('date_hidden', '',) !!}
            {!! Html::decode(Form::label('date', __('label.form.date')."(YYYY-MM-DD) <small>*</small>")) !!}
            {!! Form::text('date', ((isset($echoes->date))? $echoes->date :  date('Y-m-d') ), ['class' => 'form-control datetimepicker-input '. (($errors->has("date"))? "is-invalid" : ""), 'id' => 'date_picker', 'data-toggle' => 'datetimepicker', 'data-target' => '#date_picker', 'placeholder' => 'date', 'autocomplete' => 'off', 'required']) !!}
            {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('patient_id', __('label.form.echoes.patient'))) !!}
            {!! Form::select('patient_id', [], ((isset($echoes->patient_id))? $echoes->patient_id : '' ), ['class' => 'form-control select2_pagination patient_id','placeholder' => __('label.form.choose')]) !!}
          </div>
        </div>
        
        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_name', __('label.form.echoes.pt_name')." <small>*</small>")) !!}
            {!! Form::text('pt_name', ((isset($echoes->pt_name))? $echoes->pt_name : '' ), ['class' => 'form-control '. (($errors->has("pt_name"))? "is-invalid" : ""),'placeholder' => 'patient full name','required']) !!}
            {!! $errors->first('pt_name', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>


        <div class="col-sm-3">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_age', __('label.form.echoes.pt_age'))) !!}
            {!! Form::text('pt_age', ((isset($echoes->pt_age))? $echoes->pt_age : '' ), ['class' => 'form-control '. (($errors->has("pt_age"))? "is-invalid" : ""),'placeholder' => 'patient age']) !!}
            {!! $errors->first('pt_age', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_gender', __('label.form.echoes.pt_gender'))) !!}
            {!! Form::select('pt_gender', ['ប្រុស' => 'ប្រុស', 'ស្រី' => 'ស្រី'], ((isset($invoice->pt_gender))? $invoice->pt_gender : '' ), ['class' => 'form-control custom-select']) !!}
            {{-- {!! Form::text('pt_gender', ((isset($echoes->pt_gender))? $echoes->pt_gender : '' ), ['class' => 'form-control '. (($errors->has("pt_gender"))? "is-invalid" : ""),'placeholder' => 'patient gender']) !!} --}}
            {!! $errors->first('pt_gender', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_phone', __('label.form.echoes.pt_phone'))) !!}
            {!! Form::text('pt_phone', ((isset($echoes->pt_phone))? $echoes->pt_phone : '' ), ['class' => 'form-control '. (($errors->has("pt_phone"))? "is-invalid" : ""),'placeholder' => 'patient phone']) !!}
            {!! $errors->first('pt_phone', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>


        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('province_id', __('label.form.patient.province'))) !!}
            {!! Form::select('pt_province_id', $provinces, ((isset($echoes->pt_province_id))? $echoes->pt_province_id : '' ), ['class' => 'form-control select2 province_id', 'data-width'=>'100%', 'placeholder' => __('label.form.choose')]) !!}
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('district_id', __('label.form.patient.district'))) !!}
            {!! Form::select('pt_district_id', $districts, ((isset($echoes->pt_district_id))? $echoes->pt_district_id : '' ), ['class' => 'form-control select2 district_id','data-width'=>'100%', 'placeholder' => __('label.form.choose'), (($districts==[])? 'disabled' : '' )]) !!}
          </div>
        </div>
  
        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_commune', __('label.form.patient.commune'))) !!}
            {!! Form::text('pt_commune', ((isset($echoes->pt_commune))? $echoes->pt_commune : '' ), ['class' => 'form-control '. (($errors->has("pt_commune"))? "is-invalid" : ""),'placeholder' => 'commune']) !!}
            {!! $errors->first('pt_commune', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
  
        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_village', __('label.form.patient.village'))) !!}
            {!! Form::text('pt_village', ((isset($echoes->pt_village))? $echoes->pt_village : '' ), ['class' => 'form-control '. (($errors->has("pt_village"))? "is-invalid" : ""),'placeholder' => 'village']) !!}
            {!! $errors->first('pt_village', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>

        @if ($type != 'letter-form-the-hospital')
        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_diagnosis', __('label.form.echoes.pt_diagnosis'))) !!}
            {!! Form::text('pt_diagnosis', ((isset($echoes->pt_diagnosis))? $echoes->pt_diagnosis : '' ), ['class' => 'form-control '. (($errors->has("pt_diagnosis"))? "is-invalid" : ""),'placeholder' => 'patient diagnosis']) !!}
            {!! $errors->first('pt_diagnosis', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        @endif
        
      </div>
      
    </div>
    <div class="col-sm-6">
      @if ($type != 'letter-form-the-hospital')
        <div class="row">
          <div class="col-sm-12">
            <div class="row justify-content-center">
              <div class="col-sm-4 text-center">
                <div class="fileinput fileinput-new" data-provides="fileinput">
                  <div class="fileinput-new img-thumbnail" style="max-width: 100%;">
                    <img data-src="" src="/images/echoes/{{ ((isset($echoes->image))? $echoes->image : 'default.png' ) }}" alt="{{ Auth::user()->name }}">
                  </div>
                  <div class="fileinput-preview fileinput-exists img-thumbnail" style="max-width: 248px;"></div>
                  <div class="mt-2">
                    <span class="btn btn-outline-secondary btn-file">
                      <span class="fileinput-new">{{ __('label.buttons.select') }}</span>
                      <span class="fileinput-exists">{{ __('label.buttons.change') }}</span>
                      <input type="file" name="image" />
                    </span>
                    <a href="#" class="btn btn-outline-secondary fileinput-exists" data-dismiss="fileinput">{{ __('label.buttons.remove') }}</a>
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
              <br />
            </div>
          </div>
        </div>
      @endif
    </div>

    <div class="col-sm-12">
      <div class="form-group">
        {!! Html::decode(Form::label('description', __('label.form.description') .'<small>*</small>')) !!}
      {!! Form::textarea('description', ((isset($echoes->description))? $echoes->description : $echo_default_description->description ), ['class' => 'form-control ','style' => 'height: 121px;', 'placeholder' => 'description', 'id' => 'my-editor', 'required']) !!}
      </div>
    </div>
    {{-- / .col --}}
  </div>



