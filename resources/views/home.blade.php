
@extends('layouts.app')

@section('content')
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