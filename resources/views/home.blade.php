
@extends('layouts.app')

@section('content')

<div class="topScreen">
    <div class="l-allWrapper">
        <div class="topScreen__text">
            <p class="topScreen__title">自宅で好きな時に<br>習い事！</p>
            <p class="topScreen__sub">オンライン学習サイト<br>「おけい.com」</p>
            <div class="topScreen__link">
                <a class="c-button--round right-arrow-round" href="{{ route('email.verify') }}">新規登録</a>
            </div>
        </div>
    </div>
</div>
<div class="l-scroll">
    <div class="l-allWrapper">
        <div class="l-scroll__wrap">
            <div class="l-scroll__box">
                <div class="c-scroll__title l-flex l-v__center">
                    <h2>本日の放送するレッスン</h2>
                    <a href="{{ route('lessons.index') }}">一覧へ</a>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex">
                        @foreach($today_lessons as $today_lesson)
                        <div class="c-scroll__box">
                            <a class="c-scroll__box__inner" href="{{ route('lessons.detail', ['id' => $today_lesson->id]) }}">
                                <div class="c-scroll__box__img c-img--cover">
                                    <img src="{{ $today_lesson->public_path_course_img1 }}">
                                </div>
                                <div class="c-scroll__box__teacher l-flex l-v__bottom">
                                    <div class="c-scroll__box__teacher__img">
                                        <div class="scroll__box__teacher__img__inner c-img--round">
                                            <img src="{{ $today_lesson->public_path_users_img }}">
                                        </div>

                                    </div>
                                    <div class="c-scroll__box__teacher__evaluation">
                                        <img src="{{ asset('/img/icon-star.png') }}">
                                        <span class="evaluationNumber">{{ $today_lesson->round_avg_point }}</span>
                                    </div>
                                </div>
                                <div class="c-scroll__box__detail l-flex">
                                    <span class="number">{{ $today_lesson->kanji_number }}</span>
                                    <span class="price">{{ $today_lesson->separate_comma_price }}</span>
                                </div>
                                <div class="c-scroll__box__text">
                                    <p>{{ $today_lesson->title }}</p>
                                </div>
                                <p class="c-scroll__box__time">
                                    <span class="date">{{ $today_lesson->formated_md_date }}</span>
                                    <time>{{ $today_lesson->separate_hyphen_time }}</time>
                                </p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title">
                    <h2>人気のレッスン</h2>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex">
                        @foreach($popular_lessons as $popular_lesson)
                        <div class="c-scroll__box">
                            <a class="c-scroll__box__inner" href="">
                                <div class="c-scroll__box__img c-img--cover">
                                    <img src="{{ $popular_lesson->public_path_course_img1 }}">
                                </div>
                                <div class="c-scroll__box__teacher l-flex l-v__bottom">
                                    <div class="c-scroll__box__teacher__img">
                                        <div class="scroll__box__teacher__img__inner c-img--round">
                                            <img src="{{ $popular_lesson->public_path_users_img }}">
                                        </div>

                                    </div>
                                    <div class="c-scroll__box__teacher__evaluation">
                                        <img src="{{ asset('/img/icon-star.png') }}">
                                        <span class="evaluationNumber">{{ $popular_lesson->round_avg_point }}</span>
                                    </div>
                                </div>
                                <div class="c-scroll__box__detail l-flex">
                                    <span class="number">{{ $popular_lesson->kanji_number }}</span>
                                    <span class="price">{{ $popular_lesson->separate_comma_price }}</span>
                                </div>
                                <div class="c-scroll__box__text">
                                    <p>{{ $popular_lesson->title }}</p>
                                </div>
                                <p class="c-scroll__box__time">
                                    <span class="date">{{ $popular_lesson->formated_md_date }}</span>
                                    <time>{{ $popular_lesson->separate_hyphen_time }}</time>
                                </p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title">
                    <h2>高評価のレッスン</h2>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex">
                        @foreach($highly_rated_lessons as $highly_rated_lesson)
                        <div class="c-scroll__box">
                            <a class="c-scroll__box__inner" href="">
                                <div class="c-scroll__box__img c-img--cover">
                                    <img src="{{ $highly_rated_lesson->public_path_course_img1 }}">
                                </div>
                                <div class="c-scroll__box__teacher l-flex l-v__bottom">
                                    <div class="c-scroll__box__teacher__img">
                                        <div class="scroll__box__teacher__img__inner c-img--round">
                                            <img src="{{ $highly_rated_lesson->public_path_users_img }}">
                                        </div>

                                    </div>
                                    <div class="c-scroll__box__teacher__evaluation">
                                        <img src="{{ asset('/img/icon-star.png') }}">
                                        <span class="evaluationNumber">{{ $highly_rated_lesson->round_avg_point }}</span>
                                    </div>
                                </div>
                                <div class="c-scroll__box__detail l-flex">
                                    <span class="number">{{ $highly_rated_lesson->kanji_number }}</span>
                                    <span class="price">{{ $highly_rated_lesson->separate_comma_price }}</span>
                                </div>
                                <div class="c-scroll__box__text">
                                    <p>{{ $highly_rated_lesson->title }}</p>
                                </div>
                                <p class="c-scroll__box__time">
                                    <span class="date">{{ $highly_rated_lesson->formated_md_date }}</span>
                                    <time>{{ $highly_rated_lesson->separate_hyphen_time }}</time>
                                </p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title">
                    <h2>新着レッスン</h2>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex">
                        @foreach($new_arrival_lessons as $new_arrival_lesson)
                        <div class="c-scroll__box">
                            <a class="c-scroll__box__inner" href="">
                                <div class="c-scroll__box__img c-img--cover">
                                    <img src="{{ $new_arrival_lesson->public_path_course_img1 }}">
                                </div>
                                <div class="c-scroll__box__teacher l-flex l-v__bottom">
                                    <div class="c-scroll__box__teacher__img">
                                        <div class="scroll__box__teacher__img__inner c-img--round">
                                            <img src="{{ $new_arrival_lesson->public_path_users_img }}">
                                        </div>

                                    </div>
                                    <div class="c-scroll__box__teacher__evaluation">
                                        <img src="{{ asset('/img/icon-star.png') }}">
                                        <span class="evaluationNumber">{{ $new_arrival_lesson->round_avg_point }}</span>
                                    </div>
                                </div>
                                <div class="c-scroll__box__detail l-flex">
                                    <span class="number">{{ $new_arrival_lesson->kanji_number }}</span>
                                    <span class="price">{{ $new_arrival_lesson->separate_comma_price }}</span>
                                </div>
                                <div class="c-scroll__box__text">
                                    <p>{{ $new_arrival_lesson->title }}</p>
                                </div>
                                <p class="c-scroll__box__time">
                                    <span class="date">{{ $new_arrival_lesson->formated_md_date }}</span>
                                    <time>{{ $new_arrival_lesson->separate_hyphen_time }}</time>
                                </p>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title l-flex l-v__center">
                    <h2>人気の講師</h2>
                    <a href="{{ route('teachers.index') }}">一覧へ</a>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex">
                        @foreach($popular_teachers as $popular_teacher)
                        <div class="c-scroll__box c-teacher--box">
                            <a class="c-teacher--box__inner" href="">
                                <div class="c-teacher--box__img c-img--cover">
                                    <img src="{{ $popular_teacher->public_path_img }}">
                                </div>
                                <p class="c-teacher--box__name">{{ $popular_teacher->name }}</p>
                                <div class="c-teacher--box__evaluation l-flex l-center l-v__center">
                                    <img src="{{ asset('/img/icon-star.png') }}">
                                    <span class="evaluationNumber">{{ $popular_teacher->round_avg_point }}</span>
                                </div>
                                <ul class="c-teacher--box__category l-flex l-center">
                                    <li><span>アート・デザイン</span></li>
                                    <li><span>フィットネス</span></li>
                                    <li><span>家庭教師</span></li>
                                    <li><span>パソコン</span></li>
                                    <li><span>その他</span></li>
                                </ul>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title l-flex l-v__center">
                    <h2>新着の講師</h2>
                    <a href="{{ route('teachers.index') }}">一覧へ</a>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex">
                        @foreach($new_arrival_teachers as $new_arrival_teacher)
                        <div class="c-scroll__box c-teacher--box">
                            <a class="c-teacher--box__inner" href="">
                                <div class="c-teacher--box__img c-img--cover">
                                    <img src="{{ $new_arrival_teacher->public_path_img }}">
                                </div>
                                <p class="c-teacher--box__name">{{ $new_arrival_teacher->name }}</p>
                                <div class="c-teacher--box__evaluation l-flex l-center l-v__center">
                                    <img src="{{ asset('/img/icon-star.png') }}">
                                    <span class="evaluationNumber">{{ $new_arrival_teacher->round_avg_point }}</span>
                                </div>
                                <ul class="c-teacher--box__category l-flex l-center">
                                    <li><span>アート・デザイン</span></li>
                                    <li><span>フィットネス</span></li>
                                    <li><span>家庭教師</span></li>
                                    <li><span>パソコン</span></li>
                                    <li><span>その他</span></li>
                                </ul>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
