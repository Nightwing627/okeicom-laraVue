@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($common_cancel_count > 0)
                未処理のキャンセルリクエストが{{ $common_cancel_count }}件あります。
            @endif
            <h2>コース詳細</h2>
            <form method="POST" action="{{ route('mypage.t.courses.update') }}">
                @csrf
                <input type="hidden" name="courses_id" value="{{ $course->id }}">

                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Course URL') }}</label>

                    <div class="col-md-6">
                        <input id="url" type="text" class="form-control" name="url" value="{{ 'レッスン詳細URLを生成する' }}" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Course Image') }}</label>

                    <div class="col-md-6">
                        {{ $course->img1 }}
                        {{ $course->img2 }}
                        {{ $course->img3 }}
                        {{ $course->img4 }}
                        {{ $course->img5 }}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Course Category') }}</label>

                    <div class="col-md-6">
                        @foreach($categories as $category)
                            {{ $category->name }}
                        @endforeach
                    </div>
                </div>

                <div class="form-group row">
                    <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Course Title') }}</label>

                    <div class="col-md-6">
                        <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ $course->title }}" required autocomplete="title" autofocus>

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
                        <textarea id="detail" class="form-control @error('detail') is-invalid @enderror" name="detail" required autocomplete="detail" cols="50" rows="10">{{ $course->detail }}</textarea>

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

            <div>
                <h2>レッスン一覧</h2>
                    <a class="" href="{{ route('mypage.t.lessons.create', ['courses_id' => $course->id]) }}">
                        新規レッスン作成
                    </a>
                <div class="col-md-6">
                    @foreach($lessons as $lesson)
                        {{ $lesson->separate_hyphen_date }}
                        {{ $lesson->separate_hyphen_time }}<br>
                        {{ $lesson->title }}
{{--                        <a class="" href="{{ route('mypage.t.lessons.detail', ['id' => $lesson->id]) }}">--}}
{{--                            {{ $lesson->title }}--}}
{{--                        </a>--}}
                        <hr>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
