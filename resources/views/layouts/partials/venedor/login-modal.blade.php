<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1" aria-hidden="true">
    <form id="login-form" method="POST" action="{{ route('login') }}">
        {{ csrf_field() }}
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel1">Masuk</h4>
                </div>{{-- End .modal-header --}}
                <div class="modal-body">
                    {{-- Username --}}
                    <div class="input-group{{ $errors->has('id') ? ' has-error' : '' }}">
                        <span class="input-group-addon"><span class="input-icon input-icon-user"></span><span class="input-text">Username</span></span>
                        <input type="text" id="id" name="id" value="{{ old('id') }}" class="form-control input-lg" placeholder="Username" required autofocus>
                    </div>
                    @if ($errors->has('id'))
                    <span class="help-block">{{ $errors->first('id') }}</span>
                    <div class="sm-margin"></div>{{-- space --}}
                    @endif
                    {{-- Password --}}
                    <div class="input-group xs-margin{{ $errors->has('id') ? ' has-error' : '' }}">
                        <span class="input-group-addon"><span class="input-icon input-icon-password"></span><span class="input-text">Password</span></span>
                        <input type="password" id="password" name="password" value="{{ old('password') }}" class="form-control input-lg" placeholder="Password" required>
                    </div>
                    @if ($errors->has('password'))
                    <span class="help-block">{{ $errors->first('password') }}</span>
                    <div class="sm-margin"></div>{{-- space --}}
                    @endif
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" id="remember" name="remember"{{ old('remember') ? ' checked' : '' }}>
                            Ingat saya
                        </label>
                    </div>
                </div>{{-- End .modal-body --}}
                <div class="modal-footer">
                    <button type="button" class="btn btn-custom" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-custom-2">Masuk</button>
                </div>{{-- End .modal-footer --}}
            </div>{{-- End .modal-content --}}
        </div>{{-- End .modal-dialog --}}
    </form>
</div>{{-- End .modal --}}