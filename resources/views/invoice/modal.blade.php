<!-- New Invoice Item Modal -->
<div class="modal add fade" id="create_invoice_item_modal">
	<div class="modal-dialog modal-xl">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title" id="myModalLabel">{{ __('alert.modal.title.add_item') }}</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-6">
						<div class="row">
							{{-- <div class="col-sm-5">
								<div class="form-group">
									{!! Html::decode(Form::label('item_type', __('label.form.invoice.item_type')." <small>*</small>")) !!}
									<div>
										<div class="btn-group btn-group-toggle" data-toggle="buttons">
											<label class="btn btn-secondary active">
												<input type="radio" name="item_type" id="option_a1" value="1" autocomplete="off" checked> {{ __('label.form.invoice.service') }}
											</label>
											<label class="btn btn-secondary">
												<input type="radio" name="item_type" id="option_a2" value="2" autocomplete="off"> {{ __('label.form.invoice.medicine') }}
											</label>
										</div>
									</div>
								</div>
							</div> --}}
							<div class="col-sm-12 item_type_select_option">
								<div class="form-group">
									{!! Html::decode(Form::label('item_service_id', __('label.form.invoice.service')." <small>*</small>")) !!}
									<div class="input-group mb-3">
										{!! Form::select('item_service_id', $services, '', ['class' => 'form-control select2 service','placeholder' => __('label.form.choose'),'required']) !!}
										<div class="input-group-append">
											<span class="input-group-text bg-success" style="cursor: pointer;" data-toggle="modal" data-target="#create_service_modal"><i class="fas fa-plus"></i></span>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
					<div class="col-sm-6">
						<div class="row">
							<div class="col-sm-6">
								<div class="form-group">
									{!! Html::decode(Form::label('item_discount', __('label.form.invoice.discount')." <small>*</small>")) !!}
									{!! Form::select('item_discount', ['0'=>'0%', '0.05'=>'5%', '0.1'=>'10%', '0.15'=>'15%', '0.2'=>'20%', '0.25'=>'25%', '0.3'=>'30%', '0.35'=>'35%', '0.4'=>'40%', '0.45'=>'45%', '0.5'=>'50%', '0.55'=>'55%', '0.6'=>'60%', '0.65'=>'65%', '0.7'=>'70%', '0.75'=>'75%', '0.8'=>'80%', '0.85'=>'85%', '0.9'=>'90%', '0.95'=>'95%', '1'=>'100%'], '0', ['class' => 'form-control select2','required']) !!}
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									{!! Html::decode(Form::label('item_price', __('label.form.invoice.price')."($) <small>*</small>")) !!}
									{!! Form::text('item_price', '', ['class' => 'form-control','placeholder' => 'price','required']) !!}
								</div>
							</div>
							<div class="col-sm-3">
								<div class="form-group">
									{!! Html::decode(Form::label('item_qty', __('label.form.invoice.qty')." <small>*</small>")) !!}
									{!! Form::text('item_qty', '', ['class' => 'form-control','placeholder' => 'qauntity','required']) !!}
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-12">
						<div class="form-group">
							{!! Html::decode(Form::label('item_description', __('label.form.description')." <small>*</small>")) !!}
							{!! Form::textarea('item_description', '', ['class' => 'form-control','placeholder' => 'description','rows' => '2','required']) !!}
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


<!-- New Invoice Item Modal -->
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
