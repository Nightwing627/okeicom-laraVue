@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($common_cancel_count > 0)
                未処理のキャンセルリクエストが{{ $common_cancel_count }}件あります。
            @endif
            <h2>コース詳細</h2>
            <form method="POST" action="{{ route('mypage.t.courses.update') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="courses_id" value="{{ $course->id }}">

                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Course URL') }}</label>

                    <div class="col-md-6">
                        <input id="url" type="text" class="form-control" name="url" value="" readonly>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Course Image') }}</label>

                    <div class="col-md-6">
                        @if ($course->img1)
                            <img src="{{ $course->public_path_img1 }}" alt="" style="height: 50px; width: 50px;">
                            <input type="checkbox" id="img1_del" name="img1_del" value="1">削除
                        @else
                            <label title="画像" class="btn btn-primary mr-2">
                                <input type="file" accept=".jpeg,.jpg,.png" id="img1" name="img1" style="display:none">
                                画像
                            </label>
                        @endif
                        @error('img1')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        @if ($course->img2)
                            <img src="{{ $course->public_path_img2 }}" alt="" style="height: 50px; width: 50px;">
                            <input type="checkbox" id="img2_del" name="img2_del" value="1">削除
                        @else
                            <label title="画像" class="btn btn-primary mr-2">
                                <input type="file" accept=".jpeg,.jpg,.png" id="img2" name="img2" style="display:none">
                                画像
                            </label>
                        @endif
                        @error('img2')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        @if ($course->img3)
                            <img src="{{ $course->public_path_img3 }}" alt="" style="height: 50px; width: 50px;">
                            <input type="checkbox" id="img3_del" name="img3_del" value="1">削除
                        @else
                            <label title="画像" class="btn btn-primary mr-2">
                                <input type="file" accept=".jpeg,.jpg,.png" id="img3" name="img3" style="display:none">
                                画像
                            </label>
                        @endif
                        @error('img3')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        @if ($course->img4)
                            <img src="{{ $course->public_path_img4 }}" alt="" style="height: 50px; width: 50px;">
                            <input type="checkbox" id="img4_del" name="img4_del" value="1">削除
                        @else
                            <label title="画像" class="btn btn-primary mr-2">
                                <input type="file" accept=".jpeg,.jpg,.png" id="img4" name="img4" style="display:none">
                                画像
                            </label>
                        @endif
                        @error('img4')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror

                        @if ($course->img5)
                            <img src="{{ $course->public_path_img5 }}" alt="" style="height: 50px; width: 50px;">
                            <input type="checkbox" id="img5_del" name="img5_del" value="1">削除
                        @else
                            <label title="画像" class="btn btn-primary mr-2">
                                <input type="file" accept=".jpeg,.jpg,.png" id="img5" name="img5" style="display:none">
                                画像
                            </label>
                        @endif
                        @error('img5')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="url" class="col-md-4 col-form-label text-md-right">{{ __('Course Category') }}</label>

                    <div class="col-md-6">
                        @foreach($categories as $category)
                            <input type="checkbox" id="categories" name="categories[]" class="@error('categories') is-invalid @enderror" value="{{ $category->id }}" @if(in_array($category->id, $course->array_configured_categories)) checked="checked" @endif>{{ $category->name }}
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
