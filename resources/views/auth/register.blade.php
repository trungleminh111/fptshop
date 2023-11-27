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
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div class="text-center">
                    <h1>Register</h1>
                </div>
                <div class="form-group">
                    <label for="">Họ Và Tên</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Địa chỉ</label>
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>
                    @error('address')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="">Số điện thoại</label>
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone" autofocus>
                    @error('phone')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
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
                    <label for="">Mật Khẩu</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
                    <i class="fa-solid fa-eye"></i>
                    @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>
                <div class="form-group showpassword">
                    <label for="password-confirm" class="">{{ __('Nhập lại mật khẩu')}}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="mt-3" style="flex-direction: column; display:flex; align-items: center;">
                    <button type="submit" class="btn btn-custom" >
                        {{ __('Register') }}
                    </button>
                    <span class="mt-2">Bạn đã có tài khoản! <a href="{{route('login')}}">Đăng nhập</a></span>
                </div>
                <div class="backHome mt-5 d-flex justify-content-center">
                    <a href="/" class="btn btn-custom btn-back">Back home</a>
                </div>
            </form>
        </div>
    </div>
</div>

@include('include/footer')