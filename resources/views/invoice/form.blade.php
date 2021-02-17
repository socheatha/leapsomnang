
  <div class="row">
    <div class="col-sm-6">
      <div class="row">
        <div class="col-sm-6">
          <div class="form-group">
            {!! Form::hidden('date_hidden', '',) !!}
            {!! Html::decode(Form::label('date', __('label.form.date')."(YYYY-MM-DD) <small>*</small>")) !!}
            {!! Form::text('date', ((isset($invoice->date))? $invoice->date :  date('Y-m-d') ), ['class' => 'form-control datetimepicker-input '. (($errors->has("date"))? "is-invalid" : ""), 'id' => 'date_picker', 'data-toggle' => 'datetimepicker', 'data-target' => '#date_picker', 'placeholder' => 'date', 'autocomplete' => 'off', 'required']) !!}
            {!! $errors->first('date', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('inv_number', __('label.form.invoice.inv_number')." <small>*</small>")) !!}
            {!! Form::text('inv_number', ((isset($invoice->inv_number))? str_pad($invoice->inv_number, 6, "0", STR_PAD_LEFT) : str_pad($inv_number, 6, "0", STR_PAD_LEFT) ), ['class' => 'form-control is_integer '. (($errors->has("inv_number"))? "is-invalid" : ""), 'placeholder' => 'invoice number', 'autocomplete' => 'off', 'readonly'=>'readonly', 'required']) !!}
            {!! $errors->first('inv_number', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>

        <div class="col-sm-8">
          <div class="form-group">
            {!! Html::decode(Form::label('exchange_rate', __('label.form.invoice.exchange_rate')." <small>*</small>")) !!}
            {!! Form::text('exchange_rate', ((isset($invoice->rate))? $invoice->rate : '4000' ), ['class' => 'form-control is_integer '. (($errors->has("exchange_rate"))? "is-invalid" : ""), 'placeholder' => 'exchange rate', 'autocomplete' => 'off','required']) !!}
            {!! $errors->first('exchange_rate', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        <div class="col-sm-4">
          <div class="form-group text-center">
            {!! Html::decode(Form::label('status', __('label.form.invoice.status'))) !!}
            <div class="togglebutton mt-1">
              <label>
                {!! Form::checkbox('status',((isset($invoice->status))? $invoice->status : 1 ), ((isset($invoice->status))? (($invoice->status==1)? true : false ) : true)) !!}
                <span class="toggle toggle-success"></span>
              </label>
            </div>
          </div>
        </div>
        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_diagnosis', __('label.form.echoes.pt_diagnosis'))) !!}
            {!! Form::text('pt_diagnosis', ((isset($invoice->pt_diagnosis))? $invoice->pt_diagnosis : '' ), ['class' => 'form-control '. (($errors->has("pt_diagnosis"))? "is-invalid" : ""),'placeholder' => 'diagnosis']) !!}
            {!! $errors->first('pt_diagnosis', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>

        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('remark', __('label.form.remark'))) !!}
            {!! Form::textarea('remark', ((isset($invoice->remark))? $invoice->remark : '' ), ['class' => 'form-control '. (($errors->has("remark"))? "is-invalid" : ""),'style' => 'height: 121px;', 'placeholder' => 'remark']) !!}
          </div>
        </div>
    
      </div>
      
    </div>
    <div class="col-sm-6">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('patient_id', __('label.form.invoice.patient'))) !!}
            {!! Form::select('patient_id', [], ((isset($invoice->patient_id))? $invoice->patient_id : '' ), ['class' => 'form-control select2_pagination patient_id','placeholder' => __('label.form.choose')]) !!}
          </div>
        </div>
        
        <div class="col-sm-4">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_no', __('label.form.invoice.pt_no')." <small>*</small>")) !!}
            {!! Form::text('pt_no', ((isset($invoice->pt_no))? $invoice->pt_no : '' ), ['class' => 'form-control '. (($errors->has("pt_no"))? "is-invalid" : ""),'placeholder' => 'ptient number','required']) !!}
            {!! $errors->first('pt_no', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        
        <div class="col-sm-8">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_name', __('label.form.invoice.pt_name')." <small>*</small>")) !!}
            {!! Form::text('pt_name', ((isset($invoice->pt_name))? $invoice->pt_name : '' ), ['class' => 'form-control '. (($errors->has("pt_name"))? "is-invalid" : ""),'placeholder' => 'patient full name','required']) !!}
            {!! $errors->first('pt_name', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>


        <div class="col-sm-3">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_age', __('label.form.invoice.pt_age'))) !!}
            {!! Form::text('pt_age', ((isset($invoice->pt_age))? $invoice->pt_age : '' ), ['class' => 'form-control '. (($errors->has("pt_age"))? "is-invalid" : ""),'placeholder' => 'patient age']) !!}
            {!! $errors->first('pt_age', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        
        <div class="col-sm-3">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_gender', __('label.form.invoice.pt_gender'))) !!}
            {!! Form::select('pt_gender', ['ប្រុស' => 'ប្រុស', 'ស្រី' => 'ស្រី'], ((isset($invoice->pt_gender))? $invoice->pt_gender : '' ), ['class' => 'form-control custom-select']) !!}
            {!! $errors->first('pt_gender', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_phone', __('label.form.invoice.pt_phone'))) !!}
            {!! Form::text('pt_phone', ((isset($invoice->pt_phone))? $invoice->pt_phone : '' ), ['class' => 'form-control '. (($errors->has("pt_phone"))? "is-invalid" : ""),'placeholder' => 'patient phone']) !!}
            {!! $errors->first('pt_phone', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>

        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('province_id', __('label.form.patient.province'))) !!}
            {!! Form::select('pt_province_id', $provinces, ((isset($invoice->pt_province_id))? $invoice->pt_province_id : '' ), ['class' => 'form-control select2 province_id', 'data-width'=>'100%', 'placeholder' => __('label.form.choose')]) !!}
          </div>
        </div>
        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('district_id', __('label.form.patient.district'))) !!}
            {!! Form::select('pt_district_id', $districts, ((isset($invoice->pt_district_id))? $invoice->pt_district_id : '' ), ['class' => 'form-control select2 district_id','data-width'=>'100%', 'placeholder' => __('label.form.choose'), (($districts==[])? 'disabled' : '' )]) !!}
          </div>
        </div>
  
        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_commune', __('label.form.patient.commune'))) !!}
            {!! Form::text('pt_commune', ((isset($invoice->pt_commune))? $invoice->pt_commune : '' ), ['class' => 'form-control '. (($errors->has("pt_commune"))? "is-invalid" : ""),'placeholder' => 'commune']) !!}
            {!! $errors->first('pt_commune', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
  
        <div class="col-sm-6">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_village', __('label.form.patient.village'))) !!}
            {!! Form::text('pt_village', ((isset($invoice->pt_village))? $invoice->pt_village : '' ), ['class' => 'form-control '. (($errors->has("pt_village"))? "is-invalid" : ""),'placeholder' => 'village']) !!}
            {!! $errors->first('pt_village', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        {{-- <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_address', __('label.form.invoice.pt_address'))) !!}
            {!! Form::text('pt_address', ((isset($invoice->pt_address))? $invoice->pt_address : '' ), ['class' => 'form-control '. (($errors->has("pt_address"))? "is-invalid" : ""),'placeholder' => 'patient address']) !!}
            {!! $errors->first('pt_address', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div> --}}

      </div>
    </div>
  </div>



