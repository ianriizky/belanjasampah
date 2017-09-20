@extends('layouts.venedor')

@section('htmlheader_title', ucfirst(Request::segment(1)))

@push('breadcrumbs')
<div id="breadcrumb-container">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="/">Beranda</a></li>
            <li class="active">{{ ucfirst(Request::segment(1)) }}</li>
        </ul>
    </div>
</div>
@endpush

@push('scripts')
{{-- Google map javascript api v3 --}}
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyD45Nu6JYgh1oKG5G9ut7Nr4QW48gx-6ug&amp;sensor=false"></script>
@endpush

@section('main-content')
@include('flash::message')
<div class="lg-margin"></div>{{-- Space --}}
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <header class="content-title">
                <h1 class="title">Kontak Kami</h1>
                <p class="title-desc">Berhubungan langsung dengan kami tanpa batas. Segala yang terbaik untuk kepuasan anda.</p>
            </header>
            <div class="xs-margin"></div>{{-- space --}}
            <div class="row">
                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div id="map">
                        {{-- Google - Map - Api  --}}
                    </div>{{-- End #map --}}
                </div>{{-- End .col-md-12 --}}
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <h2 class="sub-title">Hubungi Kami</h2>
                    <ul class="contact-details-list">
                        <li>
                            <span class="contact-icon contact-icon-mobile"></span>
                            <ul>
                                <li>+62-8573-8626-264</li>
                                <li>+62-8133-7313-249</li>
                            </ul>
                        </li>
                        <li>
                            <span class="contact-icon contact-icon-email"></span>
                            <ul>
                                <li>belanjasampah62@gmail.com</li>
                                <li>ian.rizkypratama@gmail.com</li>
                            </ul>
                        </li>
                        <li>
                            <span class="contact-icon contact-icon-facebook"></span>
                            <ul>
                                <li>Septianata Rizky Pratama</li>
                            </ul>
                        </li>
                    </ul>
                </div>{{-- End .col-md-4 --}}
            </div>{{-- End .row --}}
        </div>{{-- End .col-md-12 --}}
    </div>{{-- End .row --}}
</div>{{-- End .container --}}
@endsection