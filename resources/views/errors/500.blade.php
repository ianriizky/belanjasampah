<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    @section('htmlheader')
    	@section('htmlheader_title', 'Internal Server Error')
        @include('layouts.partials.adminbsb.head-online')
        @include('layouts.partials.token')
    @show
    <body class="five-zero-zero">
	    <div class="five-zero-zero-container">
	        <div class="error-code">500</div>
	        <div class="error-message">{{ $exception->getMessage() }}</div>
	        <div class="button-place">
	            <a href="/" class="btn btn-default btn-lg waves-effect">KEMBALI KE BERANDA</a>
	        </div>
	    </div>
	    @section('scripts')
	    	{{-- Online --}}
	    	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	    	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	    	<script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.5/waves.min.js"></script>
	    	{{-- Offline --}}
            {{-- <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script> --}}
		    {{-- <script src="{{ asset('plugins/bootstrap/js/bootstrap.js') }}"></script> --}}
		    {{-- <script src="{{ asset('plugins/node-waves/waves.js') }}"></script> --}}
        @show
	</body>
</html>