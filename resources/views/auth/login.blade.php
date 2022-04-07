@extends('layouts.auth')

@section('content')
<section class="loginSec">
    <div class="container">
        <div class="loginSec-top">
            <h1 class="loginSec-title">Tastitt</h1>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-input">
                <input id="email" type="email" class=" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="メールアドレス">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <div class="form-input">
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="パスワード">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">ログイン情報を保持する</label>
                </div>

            <div class="form-submit">
                <button type="submit" class="">ログイン</button>
                <div class="form-link">
                    @if (Route::has('password.request'))
                        <a class="form-link-pass" href="{{ route('password.request') }}">パスワードをお忘れの場合</a>
                    @endif
                    <a class="form-link-reg" href="{{ route('register') }}">新規登録はこちら</a>
                </div>
            </div>
        </form>
    </div>
</section>

@endsection
