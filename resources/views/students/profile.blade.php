@extends('layouts.user')

<!-- タイトル・メタディスクリプション -->
@section('title', 'プロフィール')
@section('description', 'プロフィール')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacher.css') }}">
@endpush

<!-- 本文 -->
@section('content')
<form method="POST" action="{{ route('mypage.u.profile.update') }}" enctype="multipart/form-data">
    @csrf
    <div class="c-list--table">
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">プロフィール画像</p>
            </div>
            <user-profile-upload-img-component></user-profile-upload-img-component>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">アカウント名</p>
                <p class="sub">アカウント名は変更できません。</p>
            </div>
            <div class="c-list--td">
                <input class="c-input--fixed" disabled type="text" id="account" name="account" class="form-control" value="{{ $user->account }}" readonly>
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">ユーザーネーム</p>
                <p class="sub">サイトに表示する名前です。<br>20文字以内です。</p>
            </div>
            <div class="c-list--td">
                <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" required>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">パスワード</p>
            </div>
            <div class="c-list--td">
                <a href="{{ route('mypage.u.profile.password.edit') }}" class="u-text--link">パスワードを変更する</a>
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">性別</p>
                <p class="sub">性別は変更できません。</p>
            </div>
            <div class="c-list--td">
                <input class="c-input--fixed" disabled type="text" id="sex" name="sex" class="form-control" value="{{ $user->sex_name }}" readonly>
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">国籍</p>
            </div>
            <div class="c-list--td">
                <input type="" name="" value="日本">
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">言語</p>
            </div>
            <div class="c-list--td">
                <input type="" name="" value="日本語">
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">都道府県</p>
            </div>
            <div class="c-list--td">
                <div class="c-selectBox">
                    <select>
                        <option>東京</option>
                        <option>北海道</option>
                        <option>北海道</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">カテゴリー</p>
            </div>
            <div class="c-list--td">
                <div class="c-selectBox u-mb5">
                    <select>
                        <option>カテゴリー1</option>
                        <option>カテゴリー2</option>
                        <option>カテゴリー3</option>
                    </select>
                </div>
                <div class="c-selectBox u-mb5">
                    <select>
                        <option>カテゴリー1</option>
                        <option>カテゴリー2</option>
                        <option>カテゴリー3</option>
                    </select>
                </div>
                <div class="c-selectBox u-mb5">
                    <select>
                        <option>カテゴリー1</option>
                        <option>カテゴリー2</option>
                        <option>カテゴリー3</option>
                    </select>
                </div>
                <div class="c-selectBox u-mb5">
                    <select>
                        <option>カテゴリー1</option>
                        <option>カテゴリー2</option>
                        <option>カテゴリー3</option>
                    </select>
                </div>
                <div class="c-selectBox">
                    <select>
                        <option>カテゴリー1</option>
                        <option>カテゴリー2</option>
                        <option>カテゴリー3</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">プロフィール</p>
                <p class="sub">1000文字以内です。</p>
            </div>
            <div class="c-list--td">
                <textarea id="profile" name="profile" class="form-control @error('profile') is-invalid @enderror" required cols="50" rows="10">{{ $user->profile }}</textarea>
                @error('profile')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
    </div>
    <div class="l-button--submit">
        <button type="submit" class="c-button--square__pink">変更内容を保存する</button>
    </div>
</form>
@endsection



{{--

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>プロフィール</h2>
            <form method="POST" action="{{ route('mypage.u.profile.update') }}" enctype="multipart/form-data">


                <div class="form-group row">
                    @if($user->img)
                        <img src="{{ $user->public_path_img }}" alt="" style="height: 50px; width: 50px;">
                    @else
                        <label title="プロフィール画像" class="@error('img') is-invalid @enderror btn btn-primary mr-2">
                            <input type="file" id="img" name="img" accept=".png,.jpeg,.jpg,.gif" style="display:none">
                            プロフィール画像
                        </label>
                    @endif
                    @error('img')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group row">
                    <label for="account" class="col-md-4 col-form-label text-md-right">{{ __('Account') }}</label>

                    <div class="col-md-6">
                        <input type="text" id="account" name="account" class="form-control" value="{{ $user->account }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                    <div class="col-md-6">
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}" required>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <a class="" href="{{ route('mypage.u.profile.password.edit') }}">
                        パスワードを変更する
                    </a>
                </div>

                <div class="form-group row">
                    <label for="sex" class="col-md-4 col-form-label text-md-right">{{ __('Sex') }}</label>

                    <div class="col-md-6">
                        <input type="text" id="sex" name="sex" class="form-control" value="{{ $user->sex_name }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="profile" class="col-md-4 col-form-label text-md-right">{{ __('Profile') }}</label>

                    <div class="col-md-6">
                        <textarea id="profile" name="profile" class="form-control @error('profile') is-invalid @enderror" required cols="50" rows="10">{{ $user->profile }}</textarea>

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
@endsection
 --}}
