<!-- New Labor Item Modal -->
<div class="modal add fade" id="create_labor_item_modal">
	<div class="modal-dialog mw-100" style="width: 70%;">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">{{ __('alert.modal.title.add_item') }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row justify-content-center">
					<div class="col-sm-5">
						<div class="form-group">
							{!! Html::decode(Form::label('category_id', __('label.form.labor_service.category') .' <small>*</small>')) !!}
							{!! Form::select('category_id', $categories, '', ['class' => 'form-control select2 category_id', 'required']) !!}
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-5">
						<div class="form-group">
							{!! Html::decode(Form::label('item_service_name', __('label.form.labor.service')." <small>*</small>")) !!}
							<div class="input-group mb-3">
								{!! Form::text('item_service_name', '', ['class' => 'form-control','placeholder' => __('label.form.labor.service'),'required', 'list' => 'service_list']) !!}
							</div>
						</div>
					</div>
					<div class="col-sm-2">
						<div class="form-group">
							{!! Html::decode(Form::label('item_price', __('label.form.labor.price')."($) <small>*</small>")) !!}
							{!! Form::text('item_price', '', ['class' => 'form-control','placeholder' => 'price','required']) !!}
						</div>
					</div>
					<div class="col-sm-5">
						<div class="form-group">
							{!! Html::decode(Form::label('item_description', __('label.form.description'))) !!}
							{!! Form::textarea('item_description', '', ['class' => 'form-control','placeholder' => 'description','style' => 'height: 38px','required']) !!}
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-flat btn-danger" data-dismiss="modal">{{ __('alert.swal.button.no') }}</button>
				<button type="button" class="btn btn-flat btn btn-success" id="btn_add_item">{{ __('alert.swal.button.yes') }}</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- New Labor Item Modal -->
<div class="modal add fade" id="create_service_modal">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">{{ __('alert.modal.title.create_service') }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">

					<div class="col-sm-6">
						<div class="form-group service-name">
							{!! Html::decode(Form::label('service_name', __('label.form.name') .' <small>*</small>')) !!}
							{!! Form::text('service_name', '', ['class' => 'form-control ','placeholder' => 'name', 'required']) !!}
							{!! $errors->first('name', '<div class="invalid-feedback">:message</div>') !!}
						</div>
					</div>
				
					<div class="col-sm-6">
						<div class="form-group service-price">
							{!! Html::decode(Form::label('service_price', __('label.form.service.price') .'($) <small>*</small>')) !!}
							{!! Form::text('service_price', '', ['class' => 'form-control is_number ','placeholder' => 'price', 'required']) !!}
							{!! $errors->first('price', '<div class="invalid-feedback">:message</div>') !!}
						</div>
					</div>
				
					<div class="col-sm-12">
						<div class="form-group service-description">
							{!! Html::decode(Form::label('service_description', __('label.form.description'))) !!}
							{!! Form::textarea('service_description', '', ['class' => 'form-control ','style' => 'height: 121px;','placeholder' => 'description']) !!}
						</div>
					</div>
					{{-- / .col --}}
				
				</div>
				{{-- / .row --}}				
			</div>
			<div class="modal-footer justify-content-between">
				<button type="button" class="btn btn-flat btn-danger" data-dismiss="modal">{{ __('alert.swal.button.no') }}</button>
				<button type="button" class="btn btn-flat btn btn-success" id="btn_save_service">{{ __('alert.swal.button.yes') }}</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
