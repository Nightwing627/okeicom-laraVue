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
    @if($errors->any())
        <div class="l-alart errorAlart" role="alert">
            @foreach ($errors->all() as $error)
                <p>{{ $error ?? '' }}</p>
            @endforeach
        </div>
    @endif
    @if (session('flash_message'))
        <div class="flash_message">
            <p>{{ session('flash_message') }}</p>
        </div>
    @endif
    <div class="l-wrap--single">
        <teacher-course-store-component
            :old={{ json_encode(Session::getOldInput()) }}
            :categories_list={{ $categories }}
            :csrf={{json_encode(csrf_token())}}
            :errors={{ $errors ?? '' }}
        >
        </teacher-course-store-component>
    </div>
    {{--  @error('img1')
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
    @error('detail')
    <div class="l-alart errorAlart" role="alert">
        <p>コース詳細は1,000文字以内です。</p>
    </div>
    @enderror
    @if (session('flash_message'))
    <div class="flash_message">
        {{ session('flash_message') }}
    </div>
    @endif  --}}
@endsection
