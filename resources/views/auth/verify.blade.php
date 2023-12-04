

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="margin: 100px 0;">
                <div class="card-header"><h3>{{ __('Xác thực địa chỉ Email') }}</h3></div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif

                    <b>{{ __('Vui lòng kiểm tra Email của bạn và nhấn')}} <span style="color: red;">"Verify Email Address"</span> {{ __('để xác thực Email') }}</b>
                    <p style="color: red; text-decoration: underline;">{{ __('Tin nhắn có thể nằm trong thư mục rác!') }}</p>

                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            {{ __('Gửi lại Email') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection