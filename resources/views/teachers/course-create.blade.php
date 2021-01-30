@extends('layouts.teacher-single')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'コース作成')
@section('description', 'コース作成')

{{-- CSS --}}
@push('css')
    <link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherCourseAdd.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherCourseDetail.css') }}">
@endpush

{{-- 本文 --}}

@section('content')
@error('img1')
<div class="l-alart errorAlart" role="alert">
    <p>画像が1枚も登録されていません。</p>
</div>
@enderror
@error('img2')
<div class="l-alart errorAlart" role="alert">
    <p>画像2</p>
</div>
@enderror
@error('img3')
<div class="l-alart errorAlart" role="alert">
    <p>画像3</p>
</div>
@enderror
@error('img4')
<div class="l-alart errorAlart" role="alert">
    <p>画像4</p>
</div>
@enderror
@error('img5')
<div class="l-alart errorAlart" role="alert">
    <p>画像5</p>
</div>
@enderror
@error('categories')
<div class="l-alart errorAlart" role="alert">
    <p>カテゴリーが設定されていない、あるいは5つ以上のカテゴリーが設定されています。</p>
</div>
@enderror
@error('title')
<div class="l-alart errorAlart" role="alert">
    <p>コースタイトルが未記入です。</p>
</div>
@enderror
@if (session('flash_message'))
<div class="flash_message">
    {{ session('flash_message') }}
</div>
@endif
<div class="l-wrap--single">
    <teacher-course-store-component
        :categories_list={{ $categories }}
        :csrf="{{json_encode(csrf_token())}}"
    ></teacher-course-store-component>
</div>
@endsection


<!-- <form method="GET" action="{{ route('mypage.t.courses.store') }}" enctype="multipart/form-data"> -->




{{--
@extends('layouts.app')

@section('content')

@error('img1')
<div class="l-alart errorAlart" role="alert">
    <p>画像1</p>
</div>
@enderror
@error('img2')
<div class="l-alart errorAlart" role="alert">
    <p>画像2</p>
</div>
@enderror
@error('img3')
<div class="l-alart errorAlart" role="alert">
    <p>画像3</p>
</div>
@enderror
@error('img4')
<div class="l-alart errorAlart" role="alert">
    <p>画像4</p>
</div>
@enderror
@error('img5')
<div class="l-alart errorAlart" role="alert">
    <p>画像5</p>
</div>
@enderror
@error('categories')
<div class="l-alart errorAlart" role="alert">
    <p>カテゴリーが設定されていない、あるいは5つ以上のカテゴリーが設定されています。</p>
</div>
@enderror
@error('title')
<div class="l-alart errorAlart" role="alert">
    <p>タイトルが未記入です。</p>
</div>
@enderror
@error('detail')
<div class="l-alart errorAlart" role="alert">
    <p>詳細が未記入です。</p>
</div>
@enderror
@if (session('flash_message'))
<div class="flash_message">
    {{ session('flash_message') }}
</div>
@endif
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($common_cancel_count > 0)
                未処理のキャンセルリクエストが{{ $common_cancel_count }}件あります。
            @endif
            <h2>コース作成</h2>
            <form method="POST" action="{{ route('mypage.t.courses.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <label for="img1" class="col-md-4 col-form-label text-md-right">{{ __('Course Image') }}</label>

                    <div class="col-md-6">
                        <label title="画像" class="btn btn-primary mr-2">
                            <input type="file" accept=".jpeg,.jpg,.png" id="img1" name="img1" style="display:none">
                            画像
                        </label>
                        @error('img1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <label title="画像" class="btn btn-primary mr-2">
                            <input type="file" accept=".jpeg,.jpg,.png" id="img2" name="img2" style="display:none">
                            画像
                        </label>
                        @error('img2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <label title="画像" class="btn btn-primary mr-2">
                            <input type="file" accept=".jpeg,.jpg,.png" id="img3" name="img3" style="display:none">
                            画像
                        </label>
                        @error('img3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <label title="画像" class="btn btn-primary mr-2">
                            <input type="file" accept=".jpeg,.jpg,.png" id="img4" name="img4" style="display:none">
                            画像
                        </label>
                        @error('img4')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        <label title="画像" class="btn btn-primary mr-2">
                            <input type="file" accept=".jpeg,.jpg,.png" id="img5" name="img5" style="display:none">
                            画像
                        </label>
                        @error('img5')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="categories" class="col-md-4 col-form-label text-md-right">{{ __('Course Category') }}</label>

                    <div class="col-md-6">
                        @foreach($categories as $category)
                            <input type="checkbox" id="categories" name="categories[]" class="@error('categories') is-invalid @enderror" value="{{ $category->id }}">{{ $category->name }}
                        @endforeach

                        @error('categories')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Course Title') }}</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus>

                        @error('title')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="detail" class="col-md-4 col-form-label text-md-right">{{ __('Course Detail') }}</label>

                    <div class="col-md-6">
                        <textarea id="detail" class="form-control @error('detail') is-invalid @enderror" name="detail" required autocomplete="detail" cols="50" rows="10">{{ old('detail') }}</textarea>

                        @error('detail')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-3 offset-md-4">
                        <button name="save" type="submit" class="btn btn-primary">
                            {{ __('Save') }}
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button name="delete" type="submit" class="btn btn-primary">
                            {{ __('Delete') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
--}}
