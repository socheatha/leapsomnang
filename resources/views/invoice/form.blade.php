
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
            {!! Html::decode(Form::label('remark', __('label.form.remark'))) !!}
            {!! Form::text('remark', ((isset($invoice->remark))? $invoice->remark : '' ), ['class' => 'form-control '. (($errors->has("remark"))? "is-invalid" : ""),'placeholder' => 'remark']) !!}
          </div>
        </div>
    
      </div>
      
    </div>
    <div class="col-sm-6">
      <div class="row">
        <div class="col-sm-12">
          <div class="form-group">
            {!! Html::decode(Form::label('patient_id', __('label.form.invoice.patient'))) !!}
            {!! Form::select('patient_id', $patients, ((isset($invoice->patient_id))? $invoice->patient_id : '' ), ['class' => 'form-control select2 patient_id','placeholder' => __('label.form.choose')]) !!}
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
            {!! Form::text('pt_gender', ((isset($invoice->pt_gender))? $invoice->pt_gender : '' ), ['class' => 'form-control '. (($errors->has("pt_gender"))? "is-invalid" : ""),'placeholder' => 'patient gender']) !!}
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

      </div>
    </div>
  </div>



