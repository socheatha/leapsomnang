@extends('layouts.app')

@section('css')
	<style>

	</style>
@endsection

@section('content')
	<div class="row">
			
		<div class="col-12 col-sm-6 col-md-3">
			<div class="info-box">
				<span class="info-box-icon bg-info elevation-1"><i class="fa fa-user-injured"></i></span>

				<div class="info-box-content">
					<span class="info-box-text">Patient</span>
					<span class="info-box-number">
						10
						<small>នាក់</small>
					</span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>

		<div class="col-12 col-sm-6 col-md-3">
			<div class="info-box">
				<span class="info-box-icon bg-success elevation-1"><i class="fa fa-pills"></i></span>

				<div class="info-box-content">
					<span class="info-box-text">Medicine</span>
					<span class="info-box-number">
						10
						<small>%</small>
					</span>
				</div>
				<!-- /.info-box-content -->
			</div>
			<!-- /.info-box -->
		</div>
	</div>

	{{-- <div class="card">
		<div class="card-header">
			{{ __('Dashboard') }}
			
			<div class="card-tools">
				<button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
					<i class="fas fa-minus"></i></button>
				<button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
					<i class="fas fa-times"></i></button>
			</div>
		</div>

		<div class="card-body">

		</div>
	</div> --}}
@endsection

@section('js')
	<script>

		

		// // Rest Javascript
		// function makeDinner(...args) {
		// 	return `Dinner includes the following items: ${args.join(':::')}`;
		// }
		// console.log(makeDinner('1','2','3','4','5','6'));

		// // Arrow Function
		// const makeWine = (qty)=> 'Wine '.repeat(qty);
		// console.log(makeWine(5));

		// let x = 0;

		// const impure = () =>{
		// 	x++;
		// 	return x ** 2;
		// }
		// console.log(impure());


		// const pure = (x) => x ** 2;
		// console.log(pure(x));

	</script>
@endsection