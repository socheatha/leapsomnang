<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Labor</title>
		{{ Html::style('/css/bootstrap3.css') }}
		{{ Html::style('/css/custom-style.css') }}
		{{ Html::style('/css/invoice-print-style.css') }}
		<style>
			img{
				max-width: 100%;
			}
			.labor-print{
				width: 21cm;
				height: 29.7cm;
			}
		</style>
	</head>
	<body>

		{!! $labor_preview !!}
		<style>
			
		</style>
	</body>
 </html>