@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>TOPページ</h2>
            <p>
                <a class="" href="{{ route('email.verify') }}">
                    講師 新規登録
                </a>
                <a class="" href="{{ route('email.verify') }}">
                    ユーザー 新規登録
                </a>
            </p>

            <h3>本日のレッスン</h3>
            @foreach($today_lessons as $today_lesson)
                <p>
                    <img src="{{ $today_lesson->public_path_course_img1 }}" alt="" style="height: 100px; width: 100px;"><br>
                    <img src="{{ $today_lesson->public_path_users_img }}" alt="" style="height: 50px; width: 50px;">
                    {{ $today_lesson->evaluations_sum_point }}
                    {{ $today_lesson->kanji_number }}
                    {{ $today_lesson->separate_comma_price }}
                </p>
                <p>
                    <a class="" href="{{ route('lessons.detail', ['id' => $today_lesson->id]) }}">
                        {{ $today_lesson->title }}
                    </a>
                </p>
                <p>{{ $today_lesson->separate_hyphen_date }}
                {{ $today_lesson->separate_hyphen_time }}</p>
                <p>{{ $today_lesson->category1_name }} {{ $today_lesson->category2_name }} {{ $today_lesson->category3_name }}</p>
                <hr>
            @endforeach

            <h3>人気のレッスン</h3>
            @foreach($popular_lessons as $popular_lesson)
                <p>
                    <img src="{{ $popular_lesson->public_path_course_img1 }}" alt="" style="height: 100px; width: 100px;"><br>
                    <img src="{{ $popular_lesson->public_path_users_img }}" alt="" style="height: 50px; width: 50px;">
                    {{ $popular_lesson->evaluations_sum_point }}
                    {{ $popular_lesson->kanji_number }}
                    {{ $popular_lesson->separate_comma_price }}
                </p>
                <p>
                    <a class="" href="{{ route('lessons.detail', ['id' => $popular_lesson->id]) }}">
                        {{ $popular_lesson->title }}
                    </a>
                </p>
                <p>{{ $popular_lesson->separate_hyphen_date }}
                    {{ $popular_lesson->separate_hyphen_time }}</p>
                <p>{{ $popular_lesson->category1_name }} {{ $popular_lesson->category2_name }} {{ $popular_lesson->category3_name }}</p>
                <hr>
            @endforeach

            <h3>高評価のレッスン</h3>
            @foreach($highly_rated_lessons as $highly_rated_lesson)
                <p>
                    <img src="{{ $highly_rated_lesson->public_path_course_img1 }}" alt="" style="height: 100px; width: 100px;"><br>
                    <img src="{{ $highly_rated_lesson->public_path_users_img }}" alt="" style="height: 50px; width: 50px;">
                    {{ $highly_rated_lesson->evaluations_sum_point }}
                    {{ $highly_rated_lesson->kanji_number }}
                    {{ $highly_rated_lesson->separate_comma_price }}
                </p>
                <p>
                    <a class="" href="{{ route('lessons.detail', ['id' => $highly_rated_lesson->id]) }}">
                        {{ $highly_rated_lesson->title }}
                    </a>
                </p>
                <p>{{ $highly_rated_lesson->separate_hyphen_date }}
                    {{ $highly_rated_lesson->separate_hyphen_time }}</p>
                <p>{{ $highly_rated_lesson->category1_name }} {{ $highly_rated_lesson->category2_name }} {{ $highly_rated_lesson->category3_name }}</p>
                <hr>
            @endforeach

            <h3>新着のレッスン</h3>
            @foreach($new_arrival_lessons as $new_arrival_lesson)
                <p>
                    <img src="{{ $new_arrival_lesson->public_path_course_img1 }}" alt="" style="height: 100px; width: 100px;"><br>
                    <img src="{{ $new_arrival_lesson->public_path_users_img }}" alt="" style="height: 50px; width: 50px;">
                    {{ $new_arrival_lesson->evaluations_sum_point }}
                    {{ $new_arrival_lesson->kanji_number }}
                    {{ $new_arrival_lesson->separate_comma_price }}
                </p>
                <p>
                    <a class="" href="{{ route('lessons.detail', ['id' => $new_arrival_lesson->id]) }}">
                        {{ $new_arrival_lesson->title }}
                    </a>
                </p>
                <p>{{ $new_arrival_lesson->separate_hyphen_date }}
                    {{ $new_arrival_lesson->separate_hyphen_time }}</p>
                <p>{{ $new_arrival_lesson->category1_name }} {{ $new_arrival_lesson->category2_name }} {{ $new_arrival_lesson->category3_name }}</p>
                <hr>
            @endforeach

            <h3>人気の講師</h3>
            @foreach($popular_teachers as $popular_teacher)
                <img src="{{ $popular_teacher->public_path_img }}" alt="" style="height: 50px; width: 50px;">
                <p>{{ $popular_teacher->name }}</p>
                <p>{{ $popular_teacher->evaluations_sum_point }}</p>
                <p>{{ $popular_teacher->category1_name }} {{ $popular_teacher->category2_name }} {{ $popular_teacher->category3_name }}</p>
            @endforeach

            <h3>新着の講師</h3>
            @foreach($new_arrival_teachers as $new_arrival_teacher)
                <img src="{{ $new_arrival_teacher->public_path_img }}" alt="" style="height: 50px; width: 50px;">
                <p>{{ $new_arrival_teacher->name }}</p>
                <p>{{ $new_arrival_teacher->evaluations_sum_point }}</p>
                <p>{{ $new_arrival_teacher->category1_name }} {{ $new_arrival_teacher->category2_name }} {{ $new_arrival_teacher->category3_name }}</p>
            @endforeach

            <h3>レッスンカテゴリー</h3>
            @foreach($categories as $category)
                <a class="" href="{{ route('lessons.categories', ['categories_id' => $category->id]) }}">
                    {{ $category->name }}
                </a>
            @endforeach

            <p>
                <a class="" href="{{ route('email.verify') }}">
                    講師 新規登録
                </a>
                <a class="" href="{{ route('email.verify') }}">
                    ユーザー 新規登録
                </a>
            </p>
        </div>
    </div>
</div>
@endsection
