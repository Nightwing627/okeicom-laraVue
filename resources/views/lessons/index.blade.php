@extends('layouts.app')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'おけいcom')
@section('description', 'おけいcomのページ概要です。')

{{-- CSS --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/searchResult.css') }}">
@endpush

{{-- 本文 --}}
@section('content')
    {{--
    <lesson-index-component
        :lessons="{{ $lessons }}"
        :categories="{{ $categories }}"
        :pagenations="{{ $pagenations }}"
        :info="{{ $info }}"
    >
    <lesson-index-component
        :lessons="{{ $lessons }}"
        :categories="{{ $categories }}"
    >
    </lesson-index-component>
    --}}

    <div class="l-wrap--title">
        <div class="l-wrap">
            <h1 class="c-headline--screen">レッスン一覧</h1>
        </div>
    </div>
    <div class="l-contentList">
        <div class="l-allWrapper">
            <div class="l-contentList__wrap l-flex">
                <sidebar-component :categories="{{ $categories }}"></sidebar-component>
                <div class="l-contentList__list">
                    <div class="l-contentList__list__headline l-flex">
                        <div class="headlineContent info">
                            <h2 class="title">全てのカテゴリーから検索結果一覧を表示</h2>
                            <p class="number">{{ $lessons->total() ?? '0' }}件中 {{ $lessons->firstItem() }}-{{ $lessons->lastItem() }}件を表示</p>
                        </div>
                        <div class="headlineContent sort l-flex l-v__center">
                            <span>並び替え</span>
                            <div class="c-selectBox">
                                <form action="{{url('lessons')}}" method="get">
                                    {{ csrf_field() }}
                                    <select name="sortChange" class="c-input--gray" onchange="submit(this.form)">
                                        <option value="newDate" {{$params == 'newDate' ? 'selected': '' }}>新着順</option>
                                        <option value="dateLate" {{$params == 'dateLate' ? 'selected': '' }}>開催日が近い順</option>
                                        <option value="participantHigh" {{$params == 'participantHigh' ? 'selected': '' }}>参加者が多い順</option>
                                        <option value="evaluationHigh" {{$params == 'evaluationHigh' ? 'selected': '' }}>評価が高い順</option>
                                        <option value="priceLow" {{$params == 'priceLow' ? 'selected': '' }}>料金が安い順</option>
                                    </select>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="l-contentList__list__wrap">
                        @foreach($lessons as $lesson)
						<div class="c-contentList__box">
                            <a class="c-contentList__box__inner" href="/lessons/detail/{{ $lesson->id }}">
                                <div class="c-contentList__box__img">
                                    <div class="c-img--cover">
                                        <img src="{{ $lesson->public_path_course_img1 }}">
                                    </div>
                                </div>
                                <div class="c-contentList__box__info">
                                    <div class="number l-flex">
                                        <p class="other">
                                            <span class="stage">第{{ $lesson->number }}回</span>
                                            <span class="date">{{ $lesson->add_week_date }} {{ $lesson->separate_hyphen_time }}</span>
                                        </p>
                                        <p class="price">{{ $lesson->separate_comma_price }}</p>
                                    </div>
                                    <p class="title">{{ $lesson->title }}</p>
                                    <p class="detail pc-only">{{ $lesson->detail }}</p>
                                    <div class="category">
                                        @if ($lesson->category1_name)
                                            <span>{{ $lesson->category1_name }}</span>
                                        @endif
                                        @if ($lesson->category2_name)
                                            <span>{{ $lesson->category2_name }}</span>
                                        @endif
                                        @if ($lesson->category3_name)
                                            <span>{{ $lesson->category3_name }}</span>
                                        @endif
                                        @if ($lesson->category4_name)
                                            <span>{{ $lesson->category4_name }}</span>
                                        @endif
                                        @if ($lesson->category5_name)
                                            <span>{{ $lesson->category5_name }}</span>
                                        @endif
                                    </div>
                                    <div class="teacher l-flex l-start l-v__center pc-only">
                                        <div class="teacherImg">
                                            <div class="teacherImgInner c-img--round c-img--cover">
                                                <img src="{{ $lesson->public_path_users_img }}">
                                            </div>
                                        </div>
                                        <div class="teacherEvaluation">
                                            <img src="/img/icon-star.png">
                                            <span class="evaluationNumber">{{ $lesson->round_avg_point}}</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    <p></p>
                    <div class="l-pagenation">
                        <ul class="l-pagenation__list">
                            @for ($i = 1; $i < $lessons->lastPage()+1; $i++)
                                <li class="{{ $i == $lessons->currentPage() ? 'selected disabled' : ''}}">
                                    <a href="{{ $lessons->withQueryString()->url($i) }}">{{ $i }}</a>
                                </li>
                            @endfor
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

{{--
// カテゴリー一覧
@foreach($categories as $category)
<a href="{{ route('lessons.categories', ['categories_id' => $category->id]) }}">
    {{ $category->name }}
</a>
@endforeach
--}}
