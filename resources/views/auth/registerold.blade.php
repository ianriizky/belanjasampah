@extends('layouts.basic')

@section('htmlheader_title', 'Daftar')

@push('styles')
{{-- Bootstrap Material Datetime Picker Css --}}
<link href="{{ asset('plugins/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}" rel="stylesheet" />
{{-- Bootstrap Select Css --}}
<link href="{{ asset('plugins/bootstrap-select/css/bootstrap-select.css') }}" rel="stylesheet" />
@endpush

@push('scripts')
<script src="{{ asset('js/admin.js') }}"></script>{{-- Custom Js --}}
{{-- Moment Plugin Js --}}
<script src="{{ asset('plugins/momentjs/moment.js') }}"></script>
{{-- Bootstrap Material Datetime Picker Plugin Js --}}
<script src="{{ asset('plugins/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker.js') }}"></script>
{{-- Bootstrap Select Js --}}
<script src="{{ asset('plugins/bootstrap-select/js/bootstrap-select.js') }}"></script>
<script type="text/javascript">
    $(function () {
        $('.datepicker').bootstrapMaterialDatePicker({
            format      : 'YYYY-MM-DD',
            clearButton : true,
            weekStart   : 0,
            time        : false
        });
        $('.datepicker').bootstrapMaterialDatePicker('setMaxDate', moment());
    });
    $('#terms').click(function() {
        if($('#terms').is(':checked')) {
            $('#daftar').prop('disabled', false);
        } else {
            $('#daftar').prop('disabled', true);
        }        
    });
</script>
@endpush

@section('main-content')
<body class="signup-page">
    <div class="signup-box">
        <div class="logo">
            <a href="/">{{ config('app.name') }}</a>
            {{-- <small>blablabla</small> --}}
        </div>
        <div class="card">
            <div class="body">
                <form role="form" action="{{ route('register') }}" id="sign_up" method="POST">
                    {{ csrf_field() }}
                    {{-- <div class="msg">Daftar disini untuk masuk ke sistem</div> --}}
                    {{-- Username (id in database) --}}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line{{ $errors->has('id') ? ' error' : '' }}">
                            <input id="id" name="id" type="text" class="form-control" placeholder="Username" value="{{ old('id') }}" required autofocus>
                        </div>
                        @if ($errors->has('id'))
                        <label id="id-error" class="error" for="id">{{ $errors->first('id') }}</label>
                        @endif
                    </div>
                    {{-- E-mail --}}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">email</i>
                        </span>
                        <div class="form-line{{ $errors->has('email') ? ' error' : '' }}">
                            <input id="email" name="email" type="email" class="form-control" placeholder="E-mail" value="{{ old('email') }}" required>
                        </div>
                        @if ($errors->has('email'))
                        <label id="email-error" class="error" for="email">{{ $errors->first('email') }}</label>
                        @endif
                    </div>
                    {{-- Name --}}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">face</i>
                        </span>
                        <div class="form-line{{ $errors->has('name') ? ' error' : '' }}">
                            <input id="name" name="name" type="text" class="form-control" placeholder="Nama Lengkap" value="{{ old('name') }}" required>
                        </div>
                        @if ($errors->has('name'))
                        <label id="name-error" class="error" for="name">{{ $errors->first('name') }}</label>
                        @endif
                    </div>
                    {{-- Role User --}}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">verified_user</i>
                        </span>
                        <select id="roles" name="roles" class="form-control show-tick">
                            <option selected disabled>-- Hak Akses --</option>
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}"{{ old('roles') == $role->id ? ' selected' : '' }}>{{ $role->display_name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('roles'))
                        <label id="roles-error" class="error" for="roles">{{ $errors->first('roles') }}</label>
                        @endif
                    </div>

                    {{-- Address --}}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">location_on</i>
                        </span>
                        <div class="form-line{{ $errors->has('address') ? ' error' : '' }}">
                            <input id="address" name="address" type="text" class="form-control" placeholder="Alamat" value="{{ old('address') }}">
                        </div>
                        @if ($errors->has('address'))
                        <label id="address-error" class="error" for="address">{{ $errors->first('address') }}</label>
                        @endif
                    </div>
                    {{-- Phone Number --}}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">phone</i>
                        </span>
                        <div class="form-line{{ $errors->has('phone_number') ? ' error' : '' }}">
                            <input id="phone_number" name="phone_number" type="number" class="form-control" placeholder="Nomor Telepon" value="{{ old('phone_number') }}">
                        </div>
                        @if ($errors->has('phone_number'))
                        <label id="phone_number-error" class="error" for="phone_number">{{ $errors->first('phone_number') }}</label>
                        @endif
                    </div>
                    {{-- Gender --}}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">favorite</i>
                        </span>
                        <input id="laki" name="gender" type="radio" value="male" class="with-gap radio-col-light-blue"{{ old('gender')=='male' ? ' checked' : '' }}/>
                        <label for="laki">Laki-laki</label>
                        <input id="perempuan" name="gender" type="radio" value="female" class="with-gap radio-col-pink"{{ old('gender')=='female' ? ' checked' : '' }}/>
                        <label for="perempuan">Perempuan</label>
                        @if ($errors->has('gender'))
                        <label id="gender-error" class="error" for="gender">{{ $errors->first('gender') }}</label>
                        @endif
                    </div>
                    {{-- Birth Date --}}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">date_range</i>
                        </span>
                        <div class="form-line{{ $errors->has('birth_date') ? ' error' : '' }}">
                            <label>Tanggal Lahir</label>
                            <input id="birth_date" name="birth_date" type="date" class="datepicker form-control" value="{{ old('birth_date') }}">
                        </div>
                        @if ($errors->has('birth_date'))
                        <label id="birth_date-error" class="error" for="birth_date">{{ $errors->first('birth_date') }}</label>
                        @endif
                    </div>
                    {{-- Password --}}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line{{ $errors->has('password') ? ' error' : '' }}">
                            <input id="password" name="password" type="password" class="form-control" placeholder="Password" required>
                        </div>
                        @if ($errors->has('password'))
                        <label id="password-error" class="error" for="password">{{ $errors->first('password') }}</label>
                        @endif
                    </div>
                    {{-- Password Confirmation --}}
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input id="password-confirm" name="password_confirmation" type="password" class="form-control" placeholder="Ulangi password" required>
                        </div>
                    </div>
                    {{-- Saya setuju --}}
                    <div class="form-group">
                        <input type="checkbox" name="terms" id="terms" class="filled-in chk-col-pink">
                        <label for="terms">Saya setuju dengan <a href="#">syarat dan ketentuan</a> yang berlaku</label>
                    </div>

                    <button id="daftar" class="btn btn-block btn-lg bg-pink waves-effect" type="submit" disabled>DAFTAR</button>

                    <div class="m-t-25 m-b--5 align-center">
                        <a href="{{ url('/login') }}">Sudah punya akun?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
@endsection