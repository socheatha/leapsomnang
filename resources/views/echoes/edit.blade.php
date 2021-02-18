@extends('layouts.app')

@section('css')
	{{ Html::style('/css/invoice-print-style.css') }}
	<style type="text/css">
		.btn-print-echoes{
			top: -30px;
			right: 55px;
		}
	</style>
@endsection

@section('content')

<div class="card">
	<div class="card-header">
		<b>{!! Auth::user()->subModule() !!}</b>
		
		<div class="card-tools">
			<a href="{{route('echoes.index', $type)}}" class="btn btn-danger btn-sm btn-flat"><i class="fa fa-table"></i> &nbsp;{{ __('label.buttons.back_to_list', [ 'name' => Auth::user()->module() ]) }}</a>
		</div>

		<!-- Error Message -->
		@component('components.crud_alert')
		@endcomponent

	</div>

	{!! Form::open(['url' => route('echoes.update', [$type, $echoes->id]),'method' => 'post', 'enctype'=>'multipart/form-data','class' => 'mt-3']) !!}
	{!! Form::hidden('_method', 'PUT') !!}

	<div class="card-body">
		@include('echoes.form')
	</div>
	<!-- ./card-body -->
	
	<div class="card-footer text-muted text-center">
		@include('components.submit')
	</div>
	<!-- ./card-Footer -->
	{{ Form::close() }}

</div>

<div class="position-relative">
	@can("Echoes Print")
		<button type="button" class="btn btn-flat btn-success position-absolute mr-9 mt-5 btn-print-echoes" data-url="{{ route('echoes.print', [$type, $echoes->id]) }}"><i class="fa fa-print"></i> {{ __("label.buttons.print") }}</button>
	@endCan
</div>

<div class="pb-2 print-preview">
	{!! $echoes_preview !!}
</div>

@include('components.confirm_password')


<span class="sr-only" id="deleteAlert" data-title="{{ __('alert.swal.title.delete', ['name' => Auth::user()->module()]) }}" data-text="{{ __('alert.swal.text.unrevertible') }}" data-btnyes="{{ __('alert.swal.button.yes') }}" data-btnno="{{ __('alert.swal.button.no') }}" data-rstitle="{{ __('alert.swal.result.title.success') }}" data-rstext="{{ __('alert.swal.result.text.delete') }}"> Delete Message </span>


@endsection

@section('js')
<script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
<script type="text/javascript">
	var firstLoadPatient = true;
	var endLoadPatientChnaged = function() {}
	var endLoadProvinceChanged = function() {}

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
		$(".btn-print-echoes").on("click", function (e) {
			var myUrl = $(this).attr('data-url');
			e.preventDefault();
			openPrintWindow(myUrl, "to_print");
		});
	});
		function select2_search (term) {
			$(".select2_pagination").select2('open');
			var $search = $(".select2_pagination").data('select2').dropdown.$search || $(".select2_pagination").data('select2').selection.$search;
			$search.val(term);
			$search.trigger('keyup');
		}

		$( document ).ready(function() {

			setTimeout(() => {
				$(".select2_pagination").val("{{ $echoes->patient_id }}").trigger("change");
			}, 100);

			var data = [];
			$(".select2_pagination").each(function () {
				data.push({id:'{{ $echoes->patient_id }}', text:'PT-{{ str_pad($echoes->patient_id, 6, "0", STR_PAD_LEFT) }} :: {{ $echoes->patient->name }}'});
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
								term: params.term || '{{ $echoes->patient_id }}',
								page: params.page || 1
						}
					},
					cache: true
				}
			});
		});

		$('.select2_pagination').val('{{ $echoes->id }}').trigger('change')


		var editor = CKEDITOR.replace('my-editor', {
			height: '350',
			font_names: 'Calibrib Bold; Calibri Italic; Calibri; Roboto Regular; Roboto Bold; Khmer OS Battambang; Khmer OS Muol Light; Khmer OS Content; Khmer OS Kuolen;',
			toolbar: [
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
				{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
				{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates' ] },
				{ name: 'insert', items: ['Table' ] },
				{ name: 'styles', items: [ 'Styles', 'Format', 'Font', 'FontSize' ] },
				{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },
				{ name: 'clipboard', groups: [ 'clipboard', 'undo' ]},
			]
		});

		

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
						$("[name='pt_no']").val("{{ $echoes->pt_no }}");
						$("[name='pt_name']").val("{{ $echoes->pt_name }}");
						$("[name='pt_age']").val("{{ $echoes->pt_age }}");
						$("[name='pt_gender']").val("{{ $echoes->pt_gender }}");
						$("[name='pt_phone']").val("{{ $echoes->pt_phone }}");
						$("[name='pt_village']").val("{{ $echoes->pt_village }}");
						$("[name='pt_commune']").val("{{ $echoes->pt_commune }}");

						endLoadProvinceChanged = function () { $("[name='pt_district_id']").val("{{ $echoes->pt_district_id }}").trigger('change'); }
						$("[name='pt_province_id']").val("{{ $echoes->pt_province_id }}").trigger('change');
					}else{
						$('[name="pt_no"]').val(result.patient.no);
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

		

		$('#echo_default_description_id').change(function () {
			if ($(this).val()!='') {
				$.ajax({
					url: "{{ route('echo_default_description.getDetail') }}",
					type: 'post',
					data: {
						id : $(this).val()
					},
				})
				.done(function( result ) {
					editor.setData(result.echo_default_description.description);
				});
			}
			
		});


</script>
@endsection