<!-- New Prescription Item Modal -->
<div class="modal add fade" id="create_prescription_item_modal">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">{{ __('alert.modal.title.add_prescription_item') }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-3">
						<div class="form-group">
							{!! Html::decode(Form::label('item_medicine_name', __('label.form.prescription.medicine_name')."<small>*</small>")) !!}
							{!! Form::text('item_medicine_name', '', ['class' => 'form-control','placeholder' => 'name','required', 'list' => 'medicine_list']) !!}
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							{!! Html::decode(Form::label('item_morning', __('label.form.prescription.morning'))) !!}
							{!! Form::text('item_morning', '', ['class' => 'form-control is_number','placeholder' => 'morning']) !!}
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							{!! Html::decode(Form::label('item_afternoon', __('label.form.prescription.afternoon'))) !!}
							{!! Form::text('item_afternoon', '', ['class' => 'form-control is_number','placeholder' => 'afternoon']) !!}
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							{!! Html::decode(Form::label('item_evening', __('label.form.prescription.evening'))) !!}
							{!! Form::text('item_evening', '', ['class' => 'form-control is_number','placeholder' => 'evening']) !!}
						</div>
					</div>
					<div class="col-sm-1">
						<div class="form-group">
							{!! Html::decode(Form::label('item_night', __('label.form.prescription.night'))) !!}
							{!! Form::text('item_night', '', ['class' => 'form-control is_number','placeholder' => 'night']) !!}
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							{!! Html::decode(Form::label('item_medicine_usage', __('label.form.prescription.medicine_usage')."<small>*</small>")) !!}
							{!! Form::text('item_medicine_usage', '', ['class' => 'form-control','placeholder' => 'usage','required', 'list' => 'usage_list']) !!}
						</div>
					</div>
					<div class="col-sm-3">
						<div class="form-group">
							{!! Html::decode(Form::label('item_description', __('label.form.description'))) !!}
							{!! Form::textarea('item_description', '', ['class' => 'form-control','placeholder' => 'description','style' => 'height: 38px']) !!}
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-flat btn-danger" data-dismiss="modal">{{ __('alert.swal.button.no') }}</button>
				<button type="button" class="btn btn-flat btn btn-success" id="btn_add_item" data-dismiss="modal">{{ __('alert.swal.button.yes') }}</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->