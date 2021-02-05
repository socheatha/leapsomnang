@extends('layouts.app')

@section('css')
	{{ Html::style('/css/invoice-print-style.css') }}
	<style type="text/css">
	
	</style>
@endsection

@section('content')
<div class="card">
	<div class="card-header">
		<b>{!! Auth::user()->subModule() !!}</b>
		<div class="card-tools">
			<button type="button" class="btn btn-success btn-sm btn-flat" data-toggle="modal" data-target="#create_invoice_item_modal"><i class="fa fa-plus"></i> &nbsp; {!! __('label.buttons.add_item') !!}</button>
			{{-- Action Dropdown --}}
			@component('components.action')
				@slot('otherBTN')
					<a href="{{route('invoice.index')}}" class="dropdown-item text-danger"><i class="fa fa-arrow-left"></i> &nbsp;{{ __('label.buttons.back') }}</a>
				@endslot
			@endcomponent

			<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
		</div>

		<!-- Error Message -->
		@component('components.crud_alert')
		@endcomponent

	</div>

	{!! Form::open(['url' => route('invoice.store'),'method' => 'post','class' => 'mt-3']) !!}
	<div class="card-body">
		@include('invoice.form')

		<ul class="todo-list" data-widget="todo-list">
		</ul>

	</div>
	<!-- ./card-body -->
	
	<div class="card-footer text-muted text-center">
		@include('components.submit')
	</div>
	<!-- ./card-Footer -->
	{{ Form::close() }}

</div>

@include('invoice.modal')

@endsection

@section('js')
<script type="text/javascript">


		$(".select2_pagination").change(function () {
			$('[name="txt_search_field"]').val($('.select2-search__field').val());
		});
		
		function select2_search (term) {
			$(".select2_pagination").select2('open');
			var $search = $(".select2_pagination").data('select2').dropdown.$search || $(".select2_pagination").data('select2').selection.$search;
			$search.val(term);
			$search.trigger('keyup');
		}

		$(".select2_pagination").select2({
			theme: 'bootstrap4',
			placeholder: "{{ __('label.form.choose') }}",
			allowClear: true,
			ajax: {
				url: "{{ route('patient.getSelect2Items') }}",
				method: 'post',
				dataType: 'json',
				data: function(params) {
					return {
							term: params.term || '',
							page: params.page || 1
					}
				},
				cache: true
			}
		});


	$('.service').change(function () {
		if ($(this).val()!='') {
			var service_id = $(this).val();
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				url: "{{ route('service.getDetail') }}",
				method: 'post',
				data: {
						id: service_id,
				},
				success: function(data){
					$('[name="item_price"]').val( data.service.price );
					$('[name="item_qty"]').val( 1 );
					$('[name="item_description"]').val( data.service.name );
				}
			});
			
		}
	});

	
	$('#btn_add_item').click(function () {

		if ($('[name="item_service_id"]').val() !='' && $('[name="item_price"]').val() !='' && $('[name="item_qty"]').val() !='' && $('[name="item_description"]').val() !='') {	
			var id = Math.floor(Math.random() * 1000);
			$('.todo-list').append(	`<li class="${ id }">
																<input type="hidden" name="service_id[]" value="${ $('[name="item_service_id"]').val() }" />
																<input type="hidden" name="price[]" value="${ $('[name="item_price"]').val() }" />
																<input type="hidden" name="discount[]" value="${ $('[name="item_discount"]').val() }" />
																<input type="hidden" name="qty[]" value="${ $('[name="item_qty"]').val() }" />
																<input type="hidden" name="description[]" value="${ $('[name="item_description"]').val() }" />
																<!-- drag handle -->
																<span class="handle">
																	<i class="fas fa-ellipsis-v"></i>
																	<i class="fas fa-ellipsis-v"></i>
																</span>
																<span class="text">${ $('[name="item_description"]').val() }</span>
																<small class="badge badge-danger"><i class="fa fa-dollar-sign"></i> ${ $('[name="item_price"]').val() * $('[name="item_qty"]').val() }</small>
																<div class="tools">
																	<i class="fa fa-times text-danger btn_remove_item" data-id="${ id }"></i>
																</div>
															</li>`);
			$('[name="item_service_id"]').val('').trigger('change');
			$('[name="item_price"]').val( '' );
			$('[name="item_discount"]').val( '0' ).trigger('change');
			$('[name="item_qty"]').val( '' );
			$('[name="item_description"]').val( '' );
			$('#create_invoice_item_modal').modal('hide');

			$('.btn_remove_item').click( function () {
				$('.'+ $(this).data('id')).remove();
			});

		}else{
			Swal.fire({
				icon: 'warning',
				title: "{{ __('alert.swal.title.empty_field') }}",
				text: "{{ __('alert.swal.text.empty_field') }}",
				confirmButtonText: "{{ __('alert.swal.button.yes') }}",
			}).then((result) => {
				if (result.value) {
					$('#create_invoice_item_modal').modal('show');
				}
			})
		}
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
				$('[name="pt_no"]').val(result.patient.no);
				$('[name="pt_name"]').val(result.patient.name);
				$('[name="pt_phone"]').val(result.patient.phone);
				$('[name="pt_age"]').val(result.patient.age);
				$('[name="pt_gender"]').val(result.patient.pt_gender);
			});
		}
		
	});



</script>
@endsection