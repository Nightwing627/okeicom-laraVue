@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if ($common_cancel_count > 0)
                <a class="" href="{{ route('mypage.t.cancel-requests') }}">
                   未処理のキャンセルリクエストが{{ $common_cancel_count }}件あります。
                </a>
            @endif
            <div>
                <a class="" href="{{ route('mypage.t.courses.create') }}">
                    コースを追加する
                </a>
            </div>
            <h2>コース一覧</h2>
            @foreach($courses as $course)
                <a href="{{ route('mypage.t.courses.detail', ['courses_id' => $course->id]) }}">
                    {{ $course->title }}
                </a>
                <p>{{ $course->detail }}</p>
                <p>{{ $course->category1_name }} {{ $course->category2_name }} {{ $course->category3_name }}</p>
                <hr>
            @endforeach
            {{ $courses->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>
</div>
@endsection
