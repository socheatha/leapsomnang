@extends('layouts.app')

@section('css')
	<style class="text/css">

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
					@can('User Create')
					<a href="{{route('user.create')}}" class="dropdown-item"><i class="fa fa-plus"></i> &nbsp;{{ __('label.buttons.create') }}</a>
					@endcan
				@endslot
			@endcomponent

			<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fas fa-minus"></i></button>
			{{-- <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove"><i class="fas fa-times"></i></button> --}}
		</div>

		<!-- Error Message -->
		@component('components.crud_alert')
		@endcomponent

	</div>

	<div class="card-body">
		<table id="datatables" class="table table-bordered table-hover">
			<thead>
				<tr>
					<th width="30px">{!! __('module.table.no') !!}</th>
					<th>{!! __('module.table.user.first_name') !!}</th>
					<th>{!! __('module.table.user.last_name') !!}</th>
					<th>{!! __('module.table.user.email') !!}</th>
					<th>{!! __('module.table.user.phone') !!}</th>
					<th>{!! __('module.table.user.position') !!}</th>
					<th>{!! __('module.table.user.role') !!}</th>
					<th>{!! __('module.table.action') !!}</th>
				</tr>
			</thead>
			<tbody>
				@foreach($users as $i => $user)
					<tr>
						<td class="text-center">{{ ++$i }}</td>
						<td>{{ $user->first_name }}</td>
						<td>{{ $user->last_name }}</td>
						<td>{{ $user->email }}</td>
						<td>{{ $user->phone }}</td>
						<td>{{ $user->position }}</td>
						<td>{{ @$user->roles->first()->name }}</td>
						<td class="text-right">

							@can('User Assign Role')
								{{-- Edit Button --}}
								<a href="{{ route('user.role',$user->id) }}" class="btn btn-primary btn-sm btn-flat" data-toggle="tooltip" data-placement="left" title="{{ __('label.buttons.assign') }}"><i class="fa fa-user-graduate"></i></a>
							@endcan

							@can('User Password')
								{{-- Password Button --}}
								<a href="{{ route('user.password',$user->id) }}" class="btn btn-warning btn-sm btn-flat" data-toggle="tooltip" data-placement="left" title="{{ __('label.buttons.password') }}"><i class="fa fa-key"></i></a>
							@endcan

							@can('User Edit')
							{{-- Edit Button --}}
							<a href="{{ route('user.edit',$user->id) }}" class="btn btn-info btn-sm btn-flat" data-toggle="tooltip" data-placement="left" title="{{ __('label.buttons.edit') }}"><i class="fa fa-pencil-alt"></i></a>
							@endcan

							@can('User Delete')
							{{-- Delete Button --}}
							<button class="btn btn-danger btn-sm btn-flat BtnDeleteConfirm" value="{{ $user->id }}" data-toggle="tooltip" data-placement="left" title="{{ __('label.buttons.delete') }}"><i class="fa fa-trash-alt"></i></button>
							{{ Form::open(['url'=>route('user.destroy', $user->id), 'id' => 'form-item-'.$user->id, 'class' => 'sr-only']) }}
							{{ Form::hidden('_method','DELETE') }}
							{{ Form::hidden('passwordDelete','') }}
							{{ Form::close() }}
							@endcan

						</td>
					</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>

<span class="sr-only" id="deleteAlert" data-title="{{ __('alert.swal.title.delete', ['name' => Auth::user()->module()]) }}" data-text="{{ __('alert.swal.text.unrevertible') }}" data-btnyes="{{ __('alert.swal.button.yes') }}" data-btnno="{{ __('alert.swal.button.no') }}" data-rstitle="{{ __('alert.swal.result.title.success') }}" data-rstext="{{ __('alert.swal.result.text.delete') }}"> Delete Message </span>


{{-- Password Confirm modal --}}
@component('components.confirm_password')@endcomponent


@endsection

@section('js')
	<script type="text/javascript">
		$('.BtnDeleteConfirm').click(function () {
			$('#item_id').val($(this).val());
			$('#modal_confirm_delete').modal();
		});

		$('.submit_confirm_password').click(function () {
			var id = $('#item_id').val();
			var password_confirm = $('#password_confirm').val();
			$('[name="passwordDelete"]').val(password_confirm);
			if (password_confirm!='') {
				$.ajax({
					url: "{{ route('user.password_confirm') }}",
					type: 'post',
					data: {id:id, _token:'{{ csrf_token() }}', password_confirm:password_confirm},
				})
				.done(function( result ) {
					if(result == true){
						Swal.fire({
							icon: 'success',
							title: "{{ __('alert.swal.result.title.success') }}",
							confirmButtonText: "{{ __('alert.swal.button.yes') }}",
							timer: 1500
						})
						.then((result) => {
							$( "form" ).submit(function( event ) {
								$('button').attr('disabled','disabled');
							});
							$('[name="passwordDelete"]').val(password_confirm);
							$("#form-item-"+id).submit();
						})
					}else{
						Swal.fire({
							icon: 'warning',
							title: "{{ __('alert.swal.result.title.wrong',['name'=>'ពាក្យសម្ងាត់']) }}",
							confirmButtonText: "{{ __('alert.swal.button.yes') }}",
							timer: 2500
						})
						.then((result) => {
							$('#modal_confirm_delete').modal();
						})
					}
				});
			}else{
				Swal.fire({
					icon: 'warning',
					title: "{{ __('alert.swal.title.empty') }}",
					confirmButtonText: "{{ __('alert.swal.button.yes') }}",
					timer: 1500
				})
				.then((result) => {
					$('#modal_confirm_delete').modal();
				})
			}
		});
	</script>
@endsection