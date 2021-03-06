@extends('layouts.auth')

@section('content')
<section class="registerSec">
    <div class="container">
        <div class="loginSec-top">
            <h1 class="loginSec-title">Tastitt</h1>
        </div>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-input">
                <input id="name" type="text" class="@error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="名前">
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-input">
                <input id="email" type="email" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-input">
                <input id="line_token" type="line_token" class="@error('line_token') is-invalid @enderror" name="line_token" required autocomplete="line_token" placeholder="LINEトークン">
                @error('line_token')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-input">
                <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="パスワード">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-input">
                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="パスワード確認">
            </div>

            <div class="form-submit">
                <button type="submit" class="">登録</button>
                <div class="form-link">
                    <a class="form-link-log" href="{{ route('login') }}">ログインはこちら</a>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
