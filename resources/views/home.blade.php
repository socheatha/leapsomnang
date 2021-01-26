@extends('layouts.app')

@section('css')
	<style>

	</style>
@endsection

@section('content')
<div class="card">
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
</div>
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