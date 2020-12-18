@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>プロフィール</h2>
            <form method="POST" action="{{ route('mypage.u.profile.update') }}" enctype="multipart/form-data">
                @csrf

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
