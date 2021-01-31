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
			{{-- Action Dropdown --}}
			@component('components.action')
				@slot('otherBTN')
					<a href="{{route('echoes.index', $type)}}" class="dropdown-item text-danger"><i class="fa fa-arrow-left"></i> &nbsp;{{ __('label.buttons.back') }}</a>
				@endslot
			@endcomponent

			<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fas fa-minus"></i></button>
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
	@can("Invoice Print")
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

		var editor = CKEDITOR.replace('my-editor', {
			height: '250',
			toolbar: [
				{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
				{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote', 'CreateDiv', '-', 'JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock' ] },
				{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source', '-', 'Save', 'NewPage', 'ExportPdf', 'Preview', 'Print', '-', 'Templates' ] },
				{ name: 'clipboard', groups: [ 'clipboard', 'undo' ]},
			]
		});

		

		$('#patient_id').change(function () {
			if ($(this).val()!='') {
				$.ajax({
					url: "{{ route('patient.getDetail') }}",
					type: 'post',
					data: {
						id : $(this).val()
					},
				})
				.done(function( result ) {
					$('[name="pt_no"]').val(result.patient.no);
					$('[name="pt_name"]').val(result.patient.name);
					$('[name="pt_phone"]').val(result.patient.phone);
					$('[name="pt_age"]').val(result.patient.age);
					$('[name="pt_gender"]').val(result.patient.pt_gender);
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