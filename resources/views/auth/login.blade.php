@include('include/header')

<div class="login container h-100">
    <div class="row h-100">
        <div class="col-md-12 d-flex align-items-center justify-content-center">
            <h1 class="wellcomeHtphone">Wellcome To HTPhone</h1>
        </div>
        <div class="col-md-5 col-12">
            <img src="{{asset('images/loginpage.png')}}" alt="" style="height: 50%; width:100%;">
        </div>
        <div class="col-md-7 col-12">
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="text-center">
                    <h1>Đăng Nhập</h1>
                </div>
                <div class="form-group">
                    <label for="">Email</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                    @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group showpassword">
                    <label for="">Password</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <i class="fa-solid fa-eye"></i>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-check mt-2">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember')

                            ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                    @if (Route::has('password.request'))
                    <a class="float-end" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                    @endif
                </div>
                <div class="mt-3" style="flex-direction: column; display:flex; align-items: center;">
                    <button type="submit" class="btn btn-custom">
                        {{ __('Login') }}
                    </button>
                    <span>Bạn chưa có tài khoản! <a href="{{route('register')}}">Đăng kí</a></span>
                </div>
                <div class="backHome mt-5 d-flex justify-content-center">
                    <a href="/" class="btn btn-custom btn-back">Back home</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('include/footer')