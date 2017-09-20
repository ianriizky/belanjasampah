<div class="page-loader-wrapper">
    <div class="loader">
        <div class="preloader">
            <div @isset($color) class="spinner-layer pl-{{ $color }}"@endisset>
                <div class="circle-clipper left">
                    <div class="circle"></div>
                </div>
                <div class="circle-clipper right">
                    <div class="circle"></div>
                </div>
            </div>
        </div>
        <p>Tunggu sebentar ...</p>
    </div>
</div>