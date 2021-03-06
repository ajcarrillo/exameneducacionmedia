<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<title>SIEM</title>
		<link rel="stylesheet" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
		@auth
			<meta name="api-token" content="{{ Auth::user()->api_token }}">
			<meta name="token" content="{{ Auth::user()->jarvis_user_access_token }}">
		@endauth

		<title>{{ config('app.name', 'Laravel') }}</title>
		@yield('extra-head')

		<link rel="stylesheet" href="{{ mix('css/adminlte.css') }}">
		@yield('extra-css')
		<style>
			body {
				height: 100vh !important;
			}
		</style>
	</head>
	<body>
		@include('partials.logos_banner')
		<div class="bg-primary">
			<div class="container py-4">
				<div class="d-sm-flex justify-content-sm-between align-items-sm-center">
					<div class="mb-3 mb-sm-0">
						<h5 class="mb-0">{{ get_user_full_name() }} <br> Folio
							CENEVAL: {{ get_aspirante()->folio }}<br></h5>
					</div>
					<a href="{{ route('aspirante.dashboard.index') }}"
					   class="btn bg-white" style="color: #1f2d3d!important">
						Regresar
					</a>
				</div>

			</div>

		</div>
		@yield('content')
		@routes
		<script src="{{ mix('js/adminlte.js') }}"></script>
		<script type="text/javascript">
            window.clone = function (obj) {
                return JSON.parse(JSON.stringify(obj));
            }
		</script>
		@yield('extra-scripts')
	</body>
</html>
