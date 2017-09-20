@extends('layouts.venedor')

@section('htmlheader_title', 'Daftar Bank Sampah')

@push('scripts')
{{-- <script src="{{ asset('plugins/bootstrap-formhelpers-phone/bootstrap-formhelpers-phone.js') }}"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-formhelpers/2.3.0/js/bootstrap-formhelpers.min.js"></script>
<script>
    $('#terms').click(function() {
        if($('#terms').is(':checked')) {
            $('#daftar').prop('disabled', false);
        } else {
            $('#daftar').prop('disabled', true);
        }        
    });
</script>
@endpush

@push('breadcrumbs')
<div id="breadcrumb-container">
    <div class="container">
        <ul class="breadcrumb">
            <li><a href="/">Beranda</a></li>
            <li><a href="/register">Daftar</a></li>
            <li class="active">Bank Sampah</li>
        </ul>
    </div>
</div>
@endpush

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <header class="content-title">
                <h1 class="title">Daftar Bank Sampah</h1>
                <p class="title-desc">(*) harus diisi</p>
            </header>
            <div class="xs-margin"></div><!-- space -->
            <form id="register-form" method="POST" action="{{ route('register.bank') }}">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <fieldset>
                            <h2 class="sub-title">Informasi Pribadi</h2>
                            {{-- Username/id --}}
                            <div class="input-group{{ $errors->has('id') ? ' has-error' : '' }}">
                                <span class="input-group-addon"><span class="input-icon input-icon-user"></span><span class="input-text">Username&#42;</span></span>
                                <input type="text" id="id" name="id" value="{{ old('id') }}" class="form-control input-lg" placeholder="(4-15 karakter)" required autofocus>
                            </div>
                            @if ($errors->has('id'))
                            <span class="help-block">{{ $errors->first('id') }}</span>
                            <div class="sm-margin"></div>{{-- space --}}
                            @endif
                            {{-- Name --}}
                            <div class="input-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                <span class="input-group-addon"><span class="input-icon input-icon-user"></span><span class="input-text">Nama Lengkap&#42;</span></span>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control input-lg" placeholder="Nama lengkap anda" required>
                            </div>
                            @if ($errors->has('name'))
                            <span class="help-block">{{ $errors->first('name') }}</span>
                            <div class="sm-margin"></div>{{-- space --}}
                            @endif
                            {{-- Email --}}
                            <div class="input-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                <span class="input-group-addon"><span class="input-icon input-icon-email"></span><span class="input-text">E-mail&#42;</span></span>
                                <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control input-lg" placeholder="E-mail anda" required>
                            </div>
                            @if ($errors->has('email'))
                            <span class="help-block">{{ $errors->first('email') }}</span>
                            <div class="sm-margin"></div>{{-- space --}}
                            @endif
                            {{-- Address --}}
                            <div class="input-group{{ $errors->has('address') ? ' has-error' : '' }}">
                                <span class="input-group-addon"><span class="input-icon input-icon-address"></span><span class="input-text">Alamat</span></span>
                                <input type="text" id="address" name="address" value="{{ old('address') }}" class="form-control input-lg" placeholder="Alamat anda">
                            </div>
                            @if ($errors->has('address'))
                            <span class="help-block">{{ $errors->first('address') }}</span>
                            <div class="sm-margin"></div>{{-- space --}}
                            @endif
                            {{-- Phone Number --}}
                            <div class="input-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                                <span class="input-group-addon"><span class="input-icon input-icon-phone"></span><span class="input-text">Nomor telepon</span></span>
                                <input type="text" id="phone_number" name="phone_number" data-format="dddd-dddd-ddddd" value="{{ old('phone_number') }}" class="form-control input-lg bfh-phone" placeholder="Nomor telepon anda">
                            </div>
                            @if ($errors->has('phone_number'))
                            <span class="help-block">{{ $errors->first('phone_number') }}</span>
                            <div class="sm-margin"></div>{{-- space --}}
                            @endif
                            {{-- Gender --}}
                            <div class="input-group">
                                <span class="input-group-addon"><span class="input-icon input-icon-user"></span><span class="input-text">Jenis Kelamin</span></span>
                                <select id="gender" name="gender" class="form-control input-lg">
                                    <option disabled selected>Pilih salah satu</option>
                                    <option value="male"{{ old('gender') == 'male' ? ' selected' : '' }}>Laki-laki</option>
                                    <option value="female"{{ old('gender') == 'female' ? ' selected' : '' }}>Perempuan</option>
                                </select>
                            </div>
                            @if ($errors->has('gender'))
                            <span class="help-block">{{ $errors->first('gender') }}</span>
                            <div class="sm-margin"></div>{{-- space --}}
                            @endif
                            {{-- Birth Date --}}
                            <div class="input-group{{ $errors->has('birth_date') ? ' has-error' : '' }}">
                                <span class="input-group-addon"><span class="input-icon input-icon-message"></span><span class="input-text">Tanggal Lahir</span></span>
                                <input type="date" id="birth_date" name="birth_date" value="{{ old('birth_date') }}" class="form-control input-lg" placeholder="Tanggal lahir anda">
                            </div>
                            @if ($errors->has('birth_date'))
                            <span class="help-block">{{ $errors->first('birth_date') }}</span>
                            <div class="sm-margin"></div>{{-- space --}}
                            @endif
                        </fieldset>
                    </div>{{-- End .col-md-6 --}}
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <fieldset>
                            <h2 class="sub-title">Profil Bank Sampah</h2>
                            {{-- ID Bank Sampah--}}
                            <div class="input-group{{ $errors->has('bank_id') ? ' has-error' : '' }}">
                                <span class="input-group-addon"><span class="input-icon input-icon-company"></span><span class="input-text">ID&#42;</span></span>
                                <input type="text" id="bank_id" name="bank_id" value="{{ $bank_id }}" class="form-control input-lg" required readonly>
                            </div>
                            @if ($errors->has('bank_id'))
                            <span class="help-block">{{ $errors->first('bank_id') }}</span>
                            <div class="sm-margin"></div>{{-- space --}}
                            @endif
                            {{-- Nama Bank Sampah --}}
                            <div class="input-group{{ $errors->has('bank_name') ? ' has-error' : '' }}">
                                <span class="input-group-addon"><span class="input-icon input-icon-subject"></span><span class="input-text">Nama&#42;</span></span>
                                <input type="text" id="bank_name" name="bank_name" value="{{ old('bank_name') }}" class="form-control input-lg" placeholder="Nama bank anda" required>
                            </div>
                            @if ($errors->has('bank_name'))
                            <span class="help-block">{{ $errors->first('bank_name') }}</span>
                            <div class="sm-margin"></div>{{-- space --}}
                            @endif
                            {{-- Alamat Bank Sampah --}}
                            <div class="input-group{{ $errors->has('bank_address') ? ' has-error' : '' }}">
                                <span class="input-group-addon"><span class="input-icon input-icon-address"></span><span class="input-text">Alamat</span></span>
                                <input type="text" id="bank_address" name="bank_address" value="{{ old('bank_address') }}" class="form-control input-lg" placeholder="Alamat bank anda">
                            </div>
                            @if ($errors->has('bank_address'))
                            <span class="help-block">{{ $errors->first('bank_address') }}</span>
                            <div class="sm-margin"></div>{{-- space --}}
                            @endif
                            {{-- Deskripsi Bank Sampah --}}
                            <div class="input-group textarea-container">
                                <span class="input-group-addon"><span class="input-icon input-icon-message"></span><span class="input-text">Penjelasan singkat tentang bank sampah</span></span>
                                <textarea name="bank_description" id="bank_description" class="form-control" cols="30" rows="6">{{ old('bank_description') }}</textarea>
                            </div>
                            {{-- Order Number Bank Sampah --}}
                            <input type="hidden" name="bank_order_number" value="{{ $order_number }}">
                        </fieldset>
                    </div>{{-- End .col-md-6 --}}
                </div>{{-- End .row --}}
                <div class="row">
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <fieldset>
                            <h2 class="sub-title">Password anda</h2>
                            <div class="input-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <span class="input-group-addon"><span class="input-icon input-icon-password"></span><span class="input-text">Password&#42;</span></span>
                                <input type="password" id="password" name="password" class="form-control input-lg" placeholder="Password anda" required>
                            </div>
                            @if ($errors->has('password'))
                            <span class="help-block">{{ $errors->first('password') }}</span>
                            @endif
                            <div class="input-group">
                                <span class="input-group-addon"><span class="input-icon input-icon-password"></span><span class="input-text">Ulangi Password&#42;</span></span>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control input-lg" placeholder="Ulangi password anda" required>
                            </div>
                            @if ($errors->has('password_confirmation'))
                            <span class="help-block">{{ $errors->first('password_confirmation') }}</span>
                            @endif
                            <div class="input-group custom-checkbox">
                                <input type="checkbox" name="terms" id="terms"> <span class="checbox-container">
                                    <i class="fa fa-check"></i>
                                </span>
                                Saya setuju dengan <a href="#">syarat dan ketentuan</a> yang berlaku
                            </div>{{-- End .input-group --}}
                            <button type="submit" id="daftar" class="btn btn-custom-2 md-margin" disabled>Daftar</button>
                        </fieldset>
                    </div>{{-- End .col-md-6 --}}
                </div>{{-- End .row --}}
            </form>
        </div>{{-- End .col-md-12 --}}
    </div>{{-- End .row --}}
</div>{{-- End .container --}}
@endsection