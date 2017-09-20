@extends('layouts.adminbsb')

@section('htmlheader_title', ucfirst(Request::segment(1)))

@push('styles')
<style type="text/css">
	.slide-fade-enter-active {
		transition: all .3s ease;
	}
	.slide-fade-leave-active {
		transition: all .8s cubic-bezier(1.0, 0.5, 0.8, 1.0);
	}
	.slide-fade-enter, .slide-fade-leave-to
		/* .slide-fade-leave-active below version 2.1.8 */ {
		transform: translateX(10px);
		opacity: 0;
	}
</style>
@endpush

@push('vuejs-script')
<script src="{{ asset('js/'.Request::segment(1).'.js') }}"></script>{{-- VueJS Script --}}
<script>
	$('#flash-overlay-modal').modal();
</script>
@endpush

@section('main-content')
@include('flash::message')
<vue-progress-bar></vue-progress-bar>
<transition name="slide-fade">
	<router-view></router-view>
</transition>
@endsection