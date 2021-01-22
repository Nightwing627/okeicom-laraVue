@extends('layouts.app')

<!-- タイトル・メタディスクリプション -->
@section('title', '検索結果')
@section('description', 'おけいcomの検索結果ページです。')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/searchResult.css') }}">
<link rel="stylesheet" href="{{ asset('/css/npm/vue3-datepicker.css') }}">
@endpush

<!-- 本文 -->
@section('content')
    {{-- <search-component
        keyword="{{ $keyword }}"
        :lessons="{{ $lessons }}"
        :categories="{{ $categories }}"
    >
    </search-component> --}}
	<div class="l-screen">
		<div class="l-screen__title">
			<div class="l-allWrapper">
                <h1 class="headline">検索結果一覧</h1>
			</div>
		</div>
		<div class="l-searchResult">
			<div class="l-allWrapper">
				<div class="l-searchResult__wrap l-flex">
					<div class="c-searchResult__block tab l-flex l-v__center">
						<ul class="c-tab">
							<li class="c-tab--button selected"><a>レッスンから選択</a></li>
							<li class="c-tab--button"><a>先生から検索</a></li>
						</ul>
					</div>
					<div class="c-searchResult__block input l-flex l-v__center">
						<form action="{{ route('search.index') }}" method="get">
                            @isset($params['categories_id'])
                                <input type="hidden" name="categories_id" value="{{ $params['categories_id'] }}">
                            @endisset
                            @isset($params['sort_param'])
                                <input type="hidden" name="sort_param" value="{{ $params['sort_param'] }}">
                            @endisset
							<div class="c-searchResult__block__inner l-flex">
								<div class="searchText">
                                    @isset($params['keyword'])
                                        <input type="text" name="keyword" value="{{ $params['keyword'] }}">
                                    @else
                                        <input type="text" name="keyword" value="">
                                    @endisset
								</div>
								<div class="searchDate pc-only">
                                    @isset($params['select_date'])
                                        <vuejs-datepicker-component name="select_date" value="{{ $params['select_date'] }}"/></vuejs-datepicker-component>
                                    @else
                                        <vuejs-datepicker-component name="select_date"/></vuejs-datepicker-component>
                                    @endisset
								</div>
								<div class="searchSubmit pc-only">
                                    <button type="submit">検索</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
    <div class="l-contentList">
        <div class="l-allWrapper">
            <div class="l-contentList__wrap l-flex">
                <sidebar-component
                    :categories="{{ $categories }}"
                    categories_id="{{ $params['categories_id'] ?? '' }}"
                    path="{{ '/search' }}"
                ></sidebar-component>
                <div class="l-contentList__list">
                    <div class="l-contentList__list__headline l-flex">
                        <div class="headlineContent info">
                            <h2 class="title">レッスン一覧を表示</h2>
                            <p class="number">{{ $lessons->total() ?? '0' }}件中 {{ $lessons->firstItem() ?? '0' }}-{{ $lessons->lastItem() ?? '0' }}件を表示</p>
                        </div>
                        <div class="headlineContent sort l-flex l-v__center">
                            <span>並び替え</span>
                            <div class="c-selectBox">
                                <form action="{{ route('search.index') }}" method="get">
                                    @isset($params['categories_id'])
                                        <input type="hidden" name="categories_id" value="{{ $params['categories_id'] }}">
                                    @endisset
                                    @isset($params['is_target'])
                                        <input type="hidden" name="is_target" value="{{ $params['is_target'] }}">
                                    @endisset
                                    @isset($params['keyword'])
                                        <input type="hidden" name="keyword" value="{{ $params['keyword'] }}">
                                    @endisset
                                    @isset($params['select_date'])
                                        <input type="hidden" name="select_date" value="{{ $params['select_date'] }}">
                                    @endisset
                                    <select name="sort_param" class="c-input--gray" onchange="submit(this.form)">
                                        @if (old('period') == '1ヶ月') selected @endif
                                        <option value="newDate" {{ isset($params['sort_param']) == 'newDate' ? 'selected': '' }}>新着順</option>
                                        <option value="dateLate" {{ isset($params['sort_param']) == 'dateLate' ? 'selected': '' }}>開催日が近い順</option>
                                        <option value="participantHigh" {{ isset($params['sort_param']) == 'participantHigh' ? 'selected': '' }}>参加者が多い順</option>
                                        <option value="evaluationHigh" {{ isset($params['sort_param']) == 'evaluationHigh' ? 'selected': '' }}>評価が高い順</option>
                                        <option value="priceLow" {{ isset($params['sort_param']) == 'priceLow' ? 'selected': '' }}>料金が安い順</option>
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
                                            <span>{{ $lesson->user_point }}</span>
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
