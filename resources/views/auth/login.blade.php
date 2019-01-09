@extends('layouts.static')

@section('content')
    <div class="col-md-4 col-sm-6 ml-auto mr-auto">
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="card card-login">
                <div class="card-header card-header-rose text-center">
                    <h4 class="card-title">{{ __('Login') }}</h4>
                </div>
                <div class="card-body ">
                <span class="bmd-form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                            <i class="material-icons">face</i>
                            </span>
                        </div>
                        <input id="username" type="text" class="form-control{{ $errors->has('username') ? ' is-invalid' : '' }}" name="username" value="{{ old('username') }}" placeholder="{{ __('Username') }}" required autofocus>
                        @if ($errors->has('username'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                        @endif
                    </div>
                </span>
                    <span class="bmd-form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="material-icons">lock_outline</i>
                            </span>
                        </div>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" required>
                        @if ($errors->has('password'))
                            <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </span>
                    <span class="bmd-form-group">
                    <div class="input-group text-center" style="padding-top: 20px;">
                        <label style="width: 100%;">
                            <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                        </label>
                    </div>
                </span>
                </div>
                <div class="card-footer justify-content-center">
                    <button type="submit" class="btn btn-rose btn-link btn-lg">
                        {{ __('Login') }}
                    </button>

                    {{--<a class="btn btn-rose btn-link btn-lg" href="{{ route('password.request') }}">--}}
                    {{--{{ __('Forgot Your Password?') }}--}}
                    {{--</a>--}}
                </div>
            </div>
        </form>
    </div>
@endsection
