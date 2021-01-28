@extends('layouts.app')

@section('css')
	<style type="text/css">
    table td{
      vertical-align: middle !important;
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
					{{-- <a href="#addItem" data-toggle="modal" data-target="#create_invoice_item_modal" class="dropdown-item text-success"><i class="fa fa-plus"></i> &nbsp; {!! __('label.buttons.add_item') !!}</a> --}}
					<a href="{{route('invoice.index')}}" class="dropdown-item text-danger"><i class="fa fa-arrow-left"></i> &nbsp;{{ __('label.buttons.back') }}</a>
				@endslot
			@endcomponent

			<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
				<i class="fas fa-minus"></i></button>
		</div>

		<!-- Error Message -->
		@component('components.crud_alert')
		@endcomponent

	</div>

	{!! Form::open(['url' => route('invoice.store_import'),'method' => 'post','class' => 'mt-1']) !!}
	<div class="card-body">
    
    <div class="row justify-content-center">
      <div class="col-sm-3">
        <div class="form-group">
          <div class="input-group mb-3">
            <div class="input-group-prepend">
              <span class="input-group-text"><i class="fa fa-calendar-alt"></i></span>
            </div>
            {!! Form::text('select_month', date('Y-m'), ['class' => 'form-control', 'placeholder' => 'select month', 'id' => 'monthpicker1','autocomplete' => 'off', 'required']) !!}
          </div>
        </div>
      </div>
    </div>

    <table class="table table-bordered" width="100%" id="invoice_table">
      <thead>
        <tr>
          <th class="text-center" width="30px">
            <input type="checkbox" class="minimal check_all_invoice" />
          </th>
          <th class="text-center" width="9%">{!! __('module.table.invoice.inv_number') !!}</th>
          <th class="text-center" width="12%">{!! __('module.table.date') !!}</th>
          <th class="text-center">{!! __('module.table.invoice.customer') !!}</th>
          <th class="text-center" width="5%">{!! __('module.table.status') !!}</th>
          <th class="text-center" width="9%">{!! __('module.table.invoice.exchange_rate') !!}</th>
          <th class="text-center" width="10%">{!! __('module.table.invoice.grand_total') !!}</th>
        </tr>
      </thead>
      <tbody class="invoice-body">
        
      </tbody>
    </table>

	</div>
	<!-- ./card-body -->
	
	<div class="card-footer text-muted text-center">
		@include('components.submit')
	</div>
	<!-- ./card-Footer -->
	{{ Form::close() }}

</div>


@endsection

@section('js')
<script type="text/javascript">


  getInvoicesDB2nd(moment().format('YYYY-MM'));

  $('#monthpicker1').datepicker({
    autoclose: true,
    minViewMode: 1,
    format: 'yyyy-mm',
  })
  .on('changeDate', function(selected){
    getInvoicesDB2nd(moment(selected.date).format('YYYY-MM'));
  });

  function getInvoicesDB2nd(month) {
		$.ajax({
			url: "{{ route('invoice.getInvoicesDB2nd') }}",
			data: { 'month':month },
			method: 'post',
			success: function(data){
        $('.invoice-body').html(data.tbody);


        $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
          checkboxClass: 'icheckbox_minimal-blue',
          radioClass   : 'iradio_minimal-blue'
        })
        $('.check_all_invoice').on('ifChecked', function (event) {
          $('.chb_invoice').iCheck('check');
          triggeredByChild = false;
        });
        $('.check_all_invoice').on('ifUnchecked', function (event) {
          if (!triggeredByChild) {
            $('.chb_invoice').iCheck('uncheck');
          }
          triggeredByChild = false;
        });
        // Removed the checked state from "All" if any checkbox is unchecked
        $('.chb_invoice').on('ifUnchecked', function (event) {
          triggeredByChild = true;
          $('.check_all_invoice').iCheck('uncheck');
        });
        $('.chb_invoice').on('ifChecked', function (event) {
          if ($('.chb_invoice').filter(':checked').length == $('.chb_invoice').length) {
            $('.check_all_invoice').iCheck('check');
          }
        });
			}
		});
  }

</script>
@endsection