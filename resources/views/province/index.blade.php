@extends('layouts.app')

@section('css')
	<style type="text/css">
		
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
						@can('Province Create')
						<a href="{{route('province.create')}}" class="dropdown-item"><i class="fa fa-plus"></i> &nbsp;{{ __('label.buttons.create') }}</a>
						@endcan
					@endslot
				@endcomponent
				<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
			</div>

			<!-- Error Message -->
			@component('components.crud_alert')
			@endcomponent

		</div>

		<div class="card-body">
			<table id="datatables" class="table table-bordered table-hover">
				<thead>
					<tr>
						<th>{!! __('module.table.no') !!}</th>
						<th>{{ __('module.table.name_kh') }}</th>
						<th>{{ __('module.table.name_en') }}</th>
						<th>{{ __('module.table.province.districts') }}</th>
						<th width="10%">{{ __('module.table.action') }}</th>
					</tr>
				</thead>
				<tbody>
					@foreach($provinces as $i => $province)
						<tr>
							<td class="text-center">{{ ++$i }}</td>
							<td>{{ $province->name_en }}</td>
							<td>{{ $province->name }}</td>
							<td class="text-center"><b>{{ $province->districts->count() }}</b></td>
							<td class="text-right">

								@can('Province Edit')
								{{-- Edit Button --}}
								<a href="{{ route('province.edit',$province->id) }}" class="btn btn-info btn-sm btn-flat"><i class="fa fa-pencil-alt"></i></a>
								@endcan

								@can('Province Delete')
								{{-- Delete Button --}}
								<button class="btn btn-danger btn-sm btn-flat BtnDelete" value="{{ $province->id }}"><i class="fa fa-trash-alt"></i></button>
								{{ Form::open(['url'=>route('province.destroy', $province->id), 'id' => 'form-item-'.$province->id, 'class' => 'sr-only']) }}
								{{ Form::hidden('_method','DELETE') }}
								{{ Form::close() }}
								@endcan

							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>

    <span class="sr-only" id="deleteAlert" data-title="{{ __('alert.swal.title.delete', ['name' => Auth::user()->module()]) }}" data-text="{{ __('alert.swal.text.unrevertible') }}" data-btnyes="{{ __('alert.swal.button.yes') }}" data-btnno="{{ __('alert.swal.button.no') }}" data-rstitle="{{ __('alert.swal.result.title.success') }}" data-rstext="{{ __('alert.swal.result.text.delete') }}"> Delete Message </span>

	</div>
@endsection

@section('js')
	<script type="text/javascript">

	</script>
@endsection
