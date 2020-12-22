
@extends('layouts.app')

@section('content')
<<<<<<< HEAD
<div class="topScreen">
    <div class="l-allWrapper">
        <div class="topScreen__text">
            <p class="topScreen__title">自宅で好きな時に<br>習い事！</p>
            <p class="topScreen__sub">オンライン学習サイト<br>「おけい.com」</p>
            <div class="topScreen__link">
                <a class="c-button--round right-arrow-round" href="">新規登録</a>
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
                    <a href="">一覧へ</a>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex">
                        <?php for($i=0; $i<5; $i++) :?>
                        <div class="c-scroll__box">
                            <a class="c-scroll__box__inner" href="">
                                <div class="c-scroll__box__img c-img--cover">
                                    <img src="{{ asset('/img/screen-top.jpg') }}">
                                </div>
                                <div class="c-scroll__box__teacher l-flex l-v__bottom">
                                    <div class="c-scroll__box__teacher__img">
                                        <div class="scroll__box__teacher__img__inner c-img--round">
                                            <img src="{{ asset('/img/screen-top.jpg') }}">
                                        </div>
                                        
                                    </div>
                                    <div class="c-scroll__box__teacher__evaluation">
                                        <img src="{{ asset('/img/icon-star.png') }}">
                                        <span class="evaluationNumber">4.8</span>
                                    </div>
                                </div>
                                <div class="c-scroll__box__detail l-flex">
                                    <span class="number">第一回</span>
                                    <span class="price">¥30,000</span>
                                </div>
                                <div class="c-scroll__box__text">
                                    <p>【特別】コロナ時代に生き延びるフリーランの仕</p>
                                </div>
                                <p class="c-scroll__box__time">
                                    <span class="date">12月1日</span>
                                    <time>10:00-12:00</time>
                                </p>
                            </a>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title">
                    <h2>人気のレッスン</h2>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex">
                        <?php for($i=0; $i<5; $i++) :?>
                        <div class="c-scroll__box">
                            <a class="c-scroll__box__inner" href="">
                                <div class="c-scroll__box__img c-img--cover">
                                    <img src="{{ asset('/img/screen-top.jpg') }}">
                                </div>
                                <div class="c-scroll__box__teacher l-flex l-v__bottom">
                                    <div class="c-scroll__box__teacher__img">
                                        <div class="scroll__box__teacher__img__inner c-img--round">
                                            <img src="{{ asset('/img/screen-top.jpg') }}">
                                        </div>
                                        
                                    </div>
                                    <div class="c-scroll__box__teacher__evaluation">
                                        <img src="{{ asset('/img/icon-star.png') }}">
                                        <span class="evaluationNumber">4.8</span>
                                    </div>
                                </div>
                                <div class="c-scroll__box__detail l-flex">
                                    <span class="number">第一回</span>
                                    <span class="price">¥30,000</span>
                                </div>
                                <div class="c-scroll__box__text">
                                    <p>【特別】コロナ時代に生き延びるフリーランの仕</p>
                                </div>
                                <p class="c-scroll__box__time">
                                    <span class="date">12月1日</span>
                                    <time>10:00-12:00</time>
                                </p>
                            </a>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title">
                    <h2>高評価のレッスン</h2>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex">
                        <?php for($i=0; $i<5; $i++) :?>
                        <div class="c-scroll__box">
                            <a class="c-scroll__box__inner" href="">
                                <div class="c-scroll__box__img c-img--cover">
                                    <img src="{{ asset('/img/screen-top.jpg') }}">
                                </div>
                                <div class="c-scroll__box__teacher l-flex l-v__bottom">
                                    <div class="c-scroll__box__teacher__img">
                                        <div class="scroll__box__teacher__img__inner c-img--round">
                                            <img src="{{ asset('/img/screen-top.jpg') }}">
                                        </div>
                                        
                                    </div>
                                    <div class="c-scroll__box__teacher__evaluation">
                                        <img src="{{ asset('/img/icon-star.png') }}">
                                        <span class="evaluationNumber">4.8</span>
                                    </div>
                                </div>
                                <div class="c-scroll__box__detail l-flex">
                                    <span class="number">第一回</span>
                                    <span class="price">¥30,000</span>
                                </div>
                                <div class="c-scroll__box__text">
                                    <p>【特別】コロナ時代に生き延びるフリーランの仕</p>
                                </div>
                                <p class="c-scroll__box__time">
                                    <span class="date">12月1日</span>
                                    <time>10:00-12:00</time>
                                </p>
                            </a>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title">
                    <h2>新着レッスン</h2>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex">
                        <?php for($i=0; $i<5; $i++) :?>
                        <div class="c-scroll__box">
                            <a class="c-scroll__box__inner" href="">
                                <div class="c-scroll__box__img c-img--cover">
                                    <img src="{{ asset('/img/screen-top.jpg') }}">
                                </div>
                                <div class="c-scroll__box__teacher l-flex l-v__bottom">
                                    <div class="c-scroll__box__teacher__img">
                                        <div class="scroll__box__teacher__img__inner c-img--round">
                                            <img src="{{ asset('/img/screen-top.jpg') }}">
                                        </div>
                                        
                                    </div>
                                    <div class="c-scroll__box__teacher__evaluation">
                                        <img src="{{ asset('/img/icon-star.png') }}">
                                        <span class="evaluationNumber">4.8</span>
                                    </div>
                                </div>
                                <div class="c-scroll__box__detail l-flex">
                                    <span class="number">第一回</span>
                                    <span class="price">¥30,000</span>
                                </div>
                                <div class="c-scroll__box__text">
                                    <p>【特別】コロナ時代に生き延びるフリーランの仕</p>
                                </div>
                                <p class="c-scroll__box__time">
                                    <span class="date">12月1日</span>
                                    <time>10:00-12:00</time>
                                </p>
                            </a>
                        </div>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title l-flex l-v__center">
                    <h2>人気の講師</h2>
                    <a href="">一覧へ</a>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex">
                        <?php for($i=0; $i<5; $i++) :?>
                        <div class="c-scroll__box c-teacher--box">
                            <a class="c-teacher--box__inner" href="">
                                <div class="c-teacher--box__img c-img--cover">
                                    <img src="{{ asset('/img/screen-top.jpg') }}">
                                </div>
                                <p class="c-teacher--box__name">佐藤 真衣</p>
                                <div class="c-teacher--box__evaluation l-flex l-center l-v__center">
                                    <img src="{{ asset('/img/icon-star.png') }}">
                                    <span class="evaluationNumber">4.8</span>
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
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
            <div class="l-scroll__box">
                <div class="c-scroll__title l-flex l-v__center">
                    <h2>新着の講師</h2>
                    <a href="">一覧へ</a>
                </div>
                <div class="l-scroll__list">
                    <div class="l-scroll__list__wrap l-flex">
                        <?php for($i=0; $i<5; $i++) :?>
                        <div class="c-scroll__box c-teacher--box">
                            <a class="c-teacher--box__inner" href="">
                                <div class="c-teacher--box__img c-img--cover">
                                    <img src="{{ asset('/img/screen-top.jpg') }}">
                                </div>
                                <p class="c-teacher--box__name">佐藤 真衣</p>
                                <div class="c-teacher--box__evaluation l-flex l-center l-v__center">
                                    <img src="{{ asset('/img/icon-star.png') }}">
                                    <span class="evaluationNumber">4.8</span>
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
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
=======
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
>>>>>>> cabd2de39d96d54a9ef55332606047b48aa6a2e4
        </div>
    </div>
</div>


{{-- @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
@endif

{{ __('You are logged in!') }} --}}
@endsection