
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
            {!! Html::decode(Form::label('patient_id', __('label.form.echoes.patient')." <small>*</small>")) !!}
            {!! Form::select('patient_id', [], ((isset($echoes->patient_id))? $echoes->patient_id : '' ), ['class' => 'form-control select2_pagination patient_id','placeholder' => __('label.form.choose'),'required']) !!}
          </div>
        </div>
        
        <div class="col-sm-4">
          <div class="form-group">
            {!! Html::decode(Form::label('pt_no', __('label.form.echoes.pt_no')." <small>*</small>")) !!}
            {!! Form::text('pt_no', ((isset($echoes->pt_no))? $echoes->pt_no : '' ), ['class' => 'form-control '. (($errors->has("pt_no"))? "is-invalid" : ""),'placeholder' => 'ptient number','required']) !!}
            {!! $errors->first('pt_no', '<div class="invalid-feedback">:message</div>') !!}
          </div>
        </div>
        
        <div class="col-sm-8">
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
            {!! Form::text('pt_gender', ((isset($echoes->pt_gender))? $echoes->pt_gender : '' ), ['class' => 'form-control '. (($errors->has("pt_gender"))? "is-invalid" : ""),'placeholder' => 'patient gender']) !!}
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



