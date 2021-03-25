@extends('layouts.app')

@section('css')
	{{ Html::style('/css/invoice-print-style.css') }}
	<style type="text/css">
		.btn-print-labor{
			top: -30px;
			right: 55px;
		}
		.mt---5{
			margin-top: -45px;
		}
		#ck_result table, #ck_result table tr, #ck_result table th, #ck_result table td{
			border-width: 0px!important;
		}
		.table td{
			vertical-align: middle;
		}
	</style>
@endsection

@section('content')

<div class="card">
	<div class="card-header">
		<b>{!! Auth::user()->subModule() !!}</b>
		
		<div class="card-tools">
			@can('Labor Report')
			<a href="{{route('labor.report')}}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-file-alt"></i> &nbsp;{{ __('label.buttons.report', [ 'name' => Auth::user()->module() ]) }}</a>
			@endcan
			@can('Invoice Index')
			<a href="{{route('labor.index')}}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-table"></i> &nbsp;{{ __('label.buttons.back_to_list', [ 'name' => Auth::user()->module() ]) }}</a>
			@endcan
		</div>

	</div>

	{!! Form::open(['url' => route('labor.update', [$type, $labor->id]),'id' => 'submitForm','method' => 'post','class' => 'mt-3']) !!}
	{!! Form::hidden('_method', 'PUT') !!}

	<div class="card-body">
		@include('labor.form')
		@if(in_array($labor_type, [1, 2]))
			<div class="card card-outline card-primary mt-4">
				<div class="card-header">
					<h3 class="card-title">
						<i class="fas fa-list"></i>&nbsp;
						{{ __('alert.modal.title.labor_detail') }}
					</h3>
					@if($labor_type == 1)
					<div class="card-tools">
						<button type="button" class="btn btn-flat btn-sm btn-success btn-prevent-submit" id="btn_add_service"><i class="fa fa-plus"></i> {!! __('label.buttons.add_item') !!}</button>
					</div>
					@endif
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<?php
						$HEMATOLOGIE = '';
						$OTHER = '';

						foreach ($labor->labor_details as $order => $labor_detail) {

							$reference = $labor_detail->service->ref_from .'-'.  $labor_detail->service->ref_to;
							if ($labor_detail->service->ref_from == '' && $labor_detail->service->ref_to == '') {
								$reference = '';
							}
							
							
							if ($labor_detail->service->category->name === 'HEMATOLOGIE') {
								$HEMATOLOGIE .= '<tr class="labor_item" id="'.$labor_detail->result .'">
																	<td class="text-center">'.++$order .'</td>
																	<td>
																		<input type="hidden" name="labor_detail_ids[]" value="'.$labor_detail->id .'">
																		'.$labor_detail->name .'
																	</td>
																	<td class="text-center">
																		<input type="text" name="result[]" value="'.$labor_detail->result .'" class="form-control"/>
																	</td>
																	<td class="text-center">
																		<input type="hidden" name="unit[]" value="">
																		'.$labor_detail->service->unit .'
																	</td>
																	<td class="text-center">
																		'. $reference .'
																	</td>
																	<td class="text-center sr-only">
																		<button type="button" onclick="deleteLaborDetail(\''.$labor_detail->id .'\')" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
																	</td>
																</tr>';
							} else {
								$OTHER .= '<tr class="labor_item" id="'.$labor_detail->result .'\">
																	<td class="text-center">'.++$order .'</td>
																	<td>
																		<input type="hidden" name="labor_detail_ids[]" value="'.$labor_detail->id .'">
																		'.$labor_detail->name .'
																	</td>
																	<td class="text-center">
																		<input type="text" name="result[]" value="'.$labor_detail->result .'" class="form-control"/>
																	</td>
																	<td class="text-center">
																		<input type="hidden" name="unit[]" value="">
																		'.$labor_detail->service->unit .'
																	</td>
																	<td class="text-center">
																		'. $reference .'
																	</td>
																	<td class="text-center sr-only">
																		<button type="button" onclick="deleteLaborDetail(\''.$labor_detail->id .'\')" class="btn btn-sm btn-flat btn-danger"><i class="fa fa-trash-alt"></i></button>
																	</td>
																</tr>';
							}
							
						}

					?>
					<div class="row">
						<div class="col-sm-6">
							<table class="table table-bordered" width="100%">
								<thead>
									<tr>
										<th width="60px">{!! __('module.table.no') !!}</th>
										<th>{!! __('module.table.name') !!}</th>
										<th width="200px">{!! __('module.table.labor.result') !!}</th>
										<th width="200px">{!! __('module.table.labor_service.unit') !!}</th>
										<th width="200px">{!! __('module.table.labor_service.reference') !!}</th>
										<th width="90px" class="sr-only">{!! __('module.table.action') !!}</th>
									</tr>
								</thead>
								<tbody class="item_list">
									{!! $HEMATOLOGIE !!}
								</tbody>
							</table>
						</div>
						<div class="col-sm-6">
							<table class="table table-bordered" width="100%">
								<thead>
									<tr>
										<th width="60px">{!! __('module.table.no') !!}</th>
										<th>{!! __('module.table.name') !!}</th>
										<th width="200px">{!! __('module.table.labor.result') !!}</th>
										<th width="200px">{!! __('module.table.labor_service.unit') !!}</th>
										<th width="200px">{!! __('module.table.labor_service.reference') !!}</th>
										<th width="90px" class="sr-only">{!! __('module.table.action') !!}</th>
									</tr>
								</thead>
								<tbody class="item_list">
									{!! $OTHER !!}
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- /.card-body -->
			</div>
		@endif
	</div>
	<!-- ./card-body -->
	
	<div class="card-footer text-muted text-center">
		@include('components.submit')
	</div>
	<!-- ./card-Footer -->
	{{ Form::close() }}

</div>

<div class="position-relative">
	@can("Labor Print")
		<button type="button" class="btn btn-flat btn-success position-absolute mr-9 mt-5 btn-print-labor" data-url="{{ route('labor.print', $labor->id) }}"><i class="fa fa-print"></i> {{ __("label.buttons.print") }}</button>
	@endCan
</div>

<div class="pb-2 print-preview">
	{!! $labor_preview !!}
</div>


@include('components.confirm_password')

@include('labor.modal')
<span class="sr-only" id="deleteAlert" data-title="{{ __('alert.swal.title.delete', ['name' => Auth::user()->module()]) }}" data-text="{{ __('alert.swal.text.unrevertible') }}" data-btnyes="{{ __('alert.swal.button.yes') }}" data-btnno="{{ __('alert.swal.button.no') }}" data-rstitle="{{ __('alert.swal.result.title.success') }}" data-rstext="{{ __('alert.swal.result.text.delete') }}"> Delete Message </span>


@endsection

@section('js')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
	var firstLoadPatient = true;
	var endLoadPatientChnaged = function() {}
	var endLoadProvinceChanged = function() {}

	$('#btn_add_service').click(function () {
		$('#create_labor_item_modal').modal();
		$('#category_id').val('1').trigger('change');
	});

	$('#category_id').change(function () {
		if ($(this).val() != '') {
			$('#check_all_service').iCheck('uncheck');
			$.ajax({
				url: "{{ route('labor.getLaborServiceCheckList') }}",
				method: 'post',
				data: {
					id: $(this).val(),
				},
				success: function (data) {
					$('.service_check_list').html(data.service_check_list);
					
					$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
						checkboxClass: 'icheckbox_minimal-blue',
						radioClass   : 'iradio_minimal-blue'
					})
					$('#check_all_service').on('ifChecked', function (event) {
						$('.chb_service').iCheck('check');
						triggeredByChild = false;
					});
					$('#check_all_service').on('ifUnchecked', function (event) {
						if (!triggeredByChild) {
							$('.chb_service').iCheck('uncheck');
						}
						triggeredByChild = false;
					});
					// Removed the checked state from "All" if any checkbox is unchecked
					$('.chb_service').on('ifUnchecked', function (event) {
						triggeredByChild = true;
						$('#check_all_service').iCheck('uncheck');
					});
					$('.chb_service').on('ifChecked', function (event) {
						if ($('.chb_service').filter(':checked').length == $('.chb_service').length) {
							$('#check_all_service').iCheck('check');
						}
					});
				}
			});
		}else{
			$('.service_check_list').html('');
		}
	});
	
	$('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
		checkboxClass: 'icheckbox_minimal-blue',
		radioClass   : 'iradio_minimal-blue'
	})
	$('#check_all_service').on('ifChecked', function (event) {
		$('.chb_service').iCheck('check');
		triggeredByChild = false;
	});
	$('#check_all_service').on('ifUnchecked', function (event) {
		if (!triggeredByChild) {
			$('.chb_service').iCheck('uncheck');
		}
		triggeredByChild = false;
	});
	// Removed the checked state from "All" if any checkbox is unchecked
	$('.chb_service').on('ifUnchecked', function (event) {
		triggeredByChild = true;
		$('#check_all_service').iCheck('uncheck');
	});
	$('.chb_service').on('ifChecked', function (event) {
		if ($('.chb_service').filter(':checked').length == $('.chb_service').length) {
			$('#check_all_service').iCheck('check');
		}
	});

	$('[name="pt_province_id"]').change( function(e){
		if ($(this).val() != '') {
			$.ajax({
				url: "{{ route('province.getSelectDistrict') }}",
				method: 'post',
				data: {
					id: $(this).val(),
				},
				success: function (data) {
					$('[name="pt_district_id"]').attr({"disabled":false});
					$('[name="pt_district_id"]').html(data);
					endLoadProvinceChanged(); endLoadProvinceChanged = function () {};
				}
			});
		}else{
			$('[name="pt_district_id"]').attr({"disabled":true});
			$('[name="pt_district_id"]').html('<option value="">{{ __("label.form.choose") }}</option>');
			
		}
	});

	$('.btn-prevent-submit').click(function (event) {
		event.preventDefault();
	});

	$('#btn_add_item').click(function (event) {
		event.preventDefault();

		var service_ids = [];
		var n = $( ".labor_item" ).length;
		$( ".chb_service" ).each(function( index ) {
			if ($(this).is(':checked')) {
				service_ids.push($(this).val());
			}
		});

		if (service_ids.length != 0) {
			$.ajax({
				url: "{{ route('labor.labor_detail.storeAndGetLaborDetail') }}",
				method: 'post',
				data: {
					labor_id: '{{ $labor->id }}',
					service_ids: service_ids,
				},
				success: function (data) {
					$('.item_list').html(data.labor_detail_list);
					$('.print-preview').html(data.labor_preview);
					$('#check_all_service').iCheck('uncheck');
					$('#category_id').val('').trigger('change');
					$('#service_check_list').html('');
					$('#create_labor_item_modal').modal('hide');
					$(".is_number").keyup(function () {
						isNumber($(this))
					});
				}
			});
		}

	});

	function reloadSelectService(id) {
		
		$.ajax({
			url: "{{ route('service.reloadSelectService') }}",
			method: 'post',
			data: {
			},
			success: function(data){
				$('#item_service_id').html(data);
				$('#item_service_id').val(id).trigger('change');

			}
		});
	}

	function select2_search (term) {
		$(".select2_pagination").select2('open');
		var $search = $(".select2_pagination").data('select2').dropdown.$search || $(".select2_pagination").data('select2').selection.$search;
		$search.val(term);
		$search.trigger('keyup');
	}

	$( document ).ready(function() {

		setTimeout(() => {
			$(".select2_pagination").val("{{ $labor->patient_id }}").trigger("change");
		}, 100);

		var data = [];
		$(".select2_pagination").each(function () {
			data.push({id:'{{ $labor->patient_id }}', text:'{{ str_pad($labor->patient_id, 6, "0", STR_PAD_LEFT) }} :: {{ (($labor->patient_id != '')? $labor->patient->name : '' )}}'});
		});
		$(".select2_pagination").select2({
			theme: 'bootstrap4',
			placeholder: "{{ __('label.form.choose') }}",
			allowClear: true,
			data: data,
			ajax: {
				url: "{{ route('patient.getSelect2Items') }}",
				method: 'post',
				dataType: 'json',
				data: function(params) {
					return {
							term: params.term || '{{ $labor->patient_id }}',
							page: params.page || 1
					}
				},
				cache: true
			}
		});
	});


	$(function(){
		function openPrintWindow(url, name) {
			var printWindow = window.open(url, name, "width="+ screen.availWidth +",height="+ screen.availHeight +",_blank");
			var printAndClose = function () {
				if (printWindow.document.readyState == 'complete') {
					clearInterval(sched);
					printWindow.print();
					printWindow.close();
				}
			}  
				var sched = setInterval(printAndClose, 2000);
		};

		jQuery(document).ready(function ($) {
			$(".btn-print-labor").on("click", function (e) {
				var myUrl = $(this).attr('data-url');
				// alert(myUrl);
				e.preventDefault();
				openPrintWindow(myUrl, "to_print");
			});
		});
	});
	
	function deleteLaborDetail(id) {
		
		const swalWithBootstrapButtons = Swal.mixin({
			customClass: {
				confirmButton: 'btn btn-success btn-flat ml-2 py-2 px-3',
				cancelButton: 'btn btn-danger btn-flat mr-2 py-2 px-3'
			},
			buttonsStyling: false
		})
		swalWithBootstrapButtons.fire({
			title: "{{ __('alert.swal.title.delete') }}",
			text: "{{ __('alert.swal.text.unrevertible') }}",
			icon: 'question',
			showCancelButton: true,
			confirmButtonText: "{{ __('alert.swal.button.yes') }}",
			cancelButtonText: "{{ __('alert.swal.button.no') }}",
			reverseButtons: true
		}).then((result) => {
			if (result.value) {
				$.ajax({
					url: "{{ route('labor.labor_detail.deleteLaborDetail') }}",
					type: 'post',
					data: {
						id: id
					},
					success: function(data){
						$('.print-preview').html(data.labor_preview);
						$('.item_list').html(data.labor_detail_list);
						Swal.fire({
							icon: 'success',
							title: "{{ __('alert.swal.result.title.save') }}",
							confirmButtonText: "{{ __('alert.swal.button.yes') }}",
							timer: 2500
						})
						$('#'+ id).remove();
					}
				})
			}
		})
	};

	$('#patient_id').change(function () {
		if ($(this).val()!='') {
			$.ajax({
				url: "{{ route('patient.getSelectDetail') }}",
				type: 'post',
				data: {
					id : $(this).val()
				},
			})
			.done(function( result ) {
				if(firstLoadPatient){
					firstLoadPatient = false;
					// $("[name='pt_no']").val("{{ $labor->pt_no }}");
					$("[name='pt_name']").val("{{ $labor->pt_name }}");
					$("[name='pt_age']").val("{{ $labor->pt_age }}");
					$("[name='pt_gender']").val("{{ $labor->pt_gender }}");
					$("[name='pt_phone']").val("{{ $labor->pt_phone }}");
					$("[name='pt_village']").val("{{ $labor->pt_village }}");
					$("[name='pt_commune']").val("{{ $labor->pt_commune }}");

					endLoadProvinceChanged = function () { $("[name='pt_district_id']").val("{{ $labor->pt_district_id }}").trigger('change'); }
					$("[name='pt_province_id']").val("{{ $labor->pt_province_id }}").trigger('change');
				}else{
					// $('[name="pt_no"]').val(result.patient.no);
					$('[name="pt_name"]').val(result.patient.name);
					$('[name="pt_phone"]').val(result.patient.phone);
					$('[name="pt_age"]').val(result.patient.age);
					$('[name="pt_gender"]').val(result.patient.pt_gender);
					$('[name="pt_village"]').val(result.patient.address_village);
					$('[name="pt_commune"]').val(result.patient.address_commune);

					endLoadProvinceChanged = function () { $('[name="pt_district_id"]').val(result.patient.address_district_id).trigger('change'); }
					$('[name="pt_province_id"]').val(result.patient.address_province_id).trigger('change');
				}
			});
		}
		
	});
</script>
@endsection