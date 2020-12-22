{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div>
                <p>メールアドレスを認証しました。</p>
                <p>必要な情報を入力して、本登録を完了させてください。</p>
            </div>
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('sign-up.store', ['token' => $token]) }}">
                        @csrf

                        <div class="form-group row">
                            <label for="account" class="col-md-4 col-form-label text-md-right">{{ __('Account') }}</label>

                            <div class="col-md-6">
                                <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account" value="{{ old('account') }}" required autocomplete="account" autofocus>

                                @error('account')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email }}" required autocomplete="email" readonly>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('Sex') }}</label>

                            <div class="col-md-6">
                                <select id="sex" name="sex" class="form-control @error('sex') is-invalid @enderror" required autocomplete="sex">
                                    <option value=""></option>
                                    @foreach ($sexes as $key => $value)
                                        <option value="{{ $key }}" @if(old('sex') == $key) selected  @endif>{{ $value }}</option>
                                    @endforeach
                                </select>

                                @error('sex')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('Profile') }}</label>

                            <div class="col-md-6">
                                <textarea id="profile" class="form-control @error('profile') is-invalid @enderror" name="profile" required autocomplete="profile" cols="50" rows="10">{{ old('profile') }}</textarea>

                                @error('profile')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}





@extends('layouts.single')

<!-- タイトル・メタディスクリプション -->
@section('title', '新規登録フォーム | おけいcom')
@section('description', '新規登録フォーム')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
<div class="l-wrap--single">

    <div class="l-wrap--title">
        <h1 class="c-headline--screen u-textAlign__center">新規登録</h1>
    </div>
    <div class="l-wrap--body">
        <div class="l-wrap--main l-wrap--detail">
        <div class="l-wrap--main l-wrap--detail">

            <div class="l-content--detail">
                <form method="POST" action="{{ route('sign-up.store', ['token' => $token]) }}">
                @csrf
                    <div class="l-content--detail__inner">
                        <div class="l-content--input">
                            <p class="l-content--input__headline">アカウント名</p>
                            <input id="account" type="text" class="form-control @error('account') is-invalid @enderror" name="account" value="{{ old('account') }}" required autocomplete="account" autofocus placeholder="アカウント名">
                            @error('account')
                                <span class="u-color--red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">ユーザーネーム</p>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="ユーザーネーム">
                            @error('name')
                                <span class="u-color--red">{{ $message }}</span>
                            @enderror
                        </div>
                        <!--
                            メールアドレスは、認証で設定したメールアドレスを使用したいです！そのため、入力不要にしたいです。
                        -->
                        <div class="l-content--input">
                            <p class="l-content--input__headline">パスワード</p>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                                <span class="u-color--red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">性別</p>
                            <div class="c-selectBox u-w150">
                                <select id="sex" name="sex" class="form-control @error('sex') is-invalid @enderror" required autocomplete="sex">
                                    @foreach ($sexes as $key => $value)
                                        <option value="{{ $key }}" @if(old('sex') == $key) selected  @endif>{{ $value }}</option>
                                    @endforeach
                                </select>
                                @error('sex')
                                <span class="u-color--red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        {{-- <div class="l-content--input">
                            <p class="l-content--input__headline">国籍</p>
                            <input type="" name="" placeholder="国籍">
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">言語</p>
                            <input type="" name="" placeholder="言語">
                        </div> --}}
                        <div class="l-content--input">
                            <p class="l-content--input__headline">都道府県</p>
                            <input type="" name="" placeholder="都道府県">
                        </div>
                        {{-- <div class="l-content--input">
                            <p class="l-content--input__headline">カテゴリー（最低1つ）</p>
                            <div class="c-selectBox u-mb5">
                                <select>
                                    <option>カテゴリー1</option>
                                    <option>カテゴリー2</option>
                                    <option>カテゴリー3</option>
                                    <option>カテゴリー4</option>
                                    <option>カテゴリー5</option>
                                    <option>カテゴリー6</option>
                                    <option>カテゴリー7</option>
                                </select>
                            </div>
                            <div class="c-selectBox u-mb5">
                                <select>
                                    <option>カテゴリー1</option>
                                    <option>カテゴリー2</option>
                                    <option>カテゴリー3</option>
                                    <option>カテゴリー4</option>
                                    <option>カテゴリー5</option>
                                    <option>カテゴリー6</option>
                                    <option>カテゴリー7</option>
                                </select>
                            </div>
                            <div class="c-selectBox u-mb5">
                                <select>
                                    <option>カテゴリー1</option>
                                    <option>カテゴリー2</option>
                                    <option>カテゴリー3</option>
                                    <option>カテゴリー4</option>
                                    <option>カテゴリー5</option>
                                    <option>カテゴリー6</option>
                                    <option>カテゴリー7</option>
                                </select>
                            </div>
                            <div class="c-selectBox u-mb5">
                                <select>
                                    <option>カテゴリー1</option>
                                    <option>カテゴリー2</option>
                                    <option>カテゴリー3</option>
                                    <option>カテゴリー4</option>
                                    <option>カテゴリー5</option>
                                    <option>カテゴリー6</option>
                                    <option>カテゴリー7</option>
                                </select>
                            </div>
                            <div class="c-selectBox">
                                <select>
                                    <option>カテゴリー1</option>
                                    <option>カテゴリー2</option>
                                    <option>カテゴリー3</option>
                                    <option>カテゴリー4</option>
                                    <option>カテゴリー5</option>
                                    <option>カテゴリー6</option>
                                    <option>カテゴリー7</option>
                                </select>
                            </div>
                        </div> --}}
                        {{-- <div class="l-content--input">
                            <p class="l-content--input__headline">プロフィール画像</p>
                            <div class="imageBox">
                                <div class="imageBox-picture c-img--cover">
                                    <img :src="data.image">
                                </div>
                                <span class="imageBox-icon">
                                    <div class="imageBox-icon__inner">
                                        <img src="/public/img/icon-camera-black.png">
                                        <input type="file" ref="file" @change="setImage"/>
                                    </div>
                                </span>
                            </div>
                        </div> --}}
                        <div class="l-content--input">
                            <p class="l-content--input__headline">プロフィール</p>
                            <textarea id="profile" class="form-control @error('profile') is-invalid @enderror" name="profile" required autocomplete="profile" cols="50" rows="10">{{ old('profile') }}</textarea>
                            @error('profile')
                            <span class="u-color--red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="l-button--submit">
                        <button class="c-button--square__pink" type="subit" name="">新規登録</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection