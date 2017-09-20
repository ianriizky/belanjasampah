@extends('layouts.adminbsb')

@section('htmlheader_title', ucfirst(Request::segment(1)))

@push('vuejs-script')
{{-- Online --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/node-waves/0.7.5/waves.min.js"></script>
{{-- Offline --}}
{{-- <script src="{{ asset('plugins/jquery-3.2.1/jquery-3.2.1.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script> --}}
{{-- <script src="{{ asset('plugins/node-waves/waves.js') }}"></script> --}}
@endpush

@push('scripts')
<script>
	$('#flash-overlay-modal').modal();
</script>
@endpush

@section('main-content')
@include('flash::message')
@endsection