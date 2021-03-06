<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="content-type" content="text/html; charset=UTF-8">
		<title>Labor</title>
		{{ Html::style('/css/bootstrap3.css') }}
		{{ Html::style('/css/custom-style.css') }}
		{{ Html::style('/css/invoice-print-style.css') }}
		<style type="text/css">
			img{
				max-width: 100%;
			}
			@page { size: 21cm 29.7cm;}
			
			#ck_result table, #ck_result table tr, #ck_result table th, #ck_result table td{
				border-width: 0px!important;
			}
		</style>
	</head>
	<body>

		{!! $labor_preview !!}

	</body>
 </html>