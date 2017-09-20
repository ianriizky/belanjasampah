<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
	@section('htmlheader')
		@include('layouts.partials.venedor.head-online')
		@include('layouts.partials.token')
	@show
	<body>
		<div id="wrapper">
			@include('layouts.partials.venedor.header')
			<section id="content">
				@stack('breadcrumbs')
				@yield('main-content'){{-- Body --}}
			</section>
			@include('layouts.partials.venedor.footer')
		</div>
	@include('layouts.partials.venedor.scripts-online')
	</body>
</html>