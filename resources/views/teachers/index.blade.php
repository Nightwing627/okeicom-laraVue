@extends('layouts.app')

<!-- タイトル・メタディスクリプション -->
@section('title', '講師一覧 | おけいcom')
@section('description', 'おけいcomの講師一覧ページ概要です。')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacher.css') }}">
@endpush

<!-- 本文 -->
@section('content')
    <div class="l-wrap--title">
        <div class="l-wrap">
            <h1 class="c-headline--screen">講師一覧</h1>
        </div>
    </div>
    <div class="l-wrap--body">
        <div class="l-wrap l-flex">
            <sidebar-component
                :categories="{{ $categories }}"
                categories_id="{{ $params['categories_id'] ?? '' }}"
                path="{{ '/teacher' }}"
            >
            </sidebar-component>
            <div class="l-wrap--main">
                <div class="l-contentList__list__headline l-flex">
                    <div class="headlineContent info">
                        <h2 class="title">検索結果一覧を表示</h2>
                        <p class="number">{{ $teachers->total() ?? '0' }}件中 {{ $teachers->firstItem() ?? '0' }}-{{ $teachers->lastItem() ?? '0' }}件を表示</p>
                    </div>
                    <div class="headlineContent sort l-flex l-v__center">
                        <span>並び替え</span>
                        <div class="c-selectBox">
                            <form action="{{ url('teachers') }}" method="get">
                                <select name="sort_param" class="c-input--gray" onchange="submit(this.form)">
                                    <option value="sort_new" {{ isset($params['sort_param'])  == 'sort_new' ? 'selected': '' }}>新着順</option>
                                    <option value="sort_evaluation" {{ isset($params['sort_param']) == 'sort_evaluation' ? 'selected': '' }}>評価が高い順</option>
                                </select>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="l-list--teacher">
                    <div class="l-list--teacher__tab three-tab">
                        <!-- <a v-bind:href="'/teachers'" v-if="selected_category==''">
                            <div class="tab-box selected" v-if="sex==''">全て</div>
                            <div class="tab-box" v-else>全て</div>
                        </a>
                        <a v-bind:href="'/teachers/category/'+selected_category.id" v-else>
                            <div class="tab-box selected" v-if="sex==''">全て</div>
                            <div class="tab-box" v-else>全て</div>
                        </a>
                        <a v-bind:href="'/teachers?sex=1'" v-if="selected_category==''">
                            <div class="tab-box selected" v-if="sex==1">男性</div>
                            <div class="tab-box"  v-else>男性</div>
                        </a>
                        <a v-bind:href="'/teachers/category/'+selected_category.id+'?sex=1'" v-else>
                            <div class="tab-box selected" v-if="sex==1">男性</div>
                            <div class="tab-box"  v-else>男性</div>
                        </a>
                        <a v-bind:href="'/teachers?sex=2'" v-if="selected_category==''">
                            <div class="tab-box selected" v-if="sex==2">女性</div>
                            <div class="tab-box" v-else>女性</div>
                        </a>
                        <a v-bind:href="'/teachers/category/'+selected_category.id+'?sex=2'" v-else>
                            <div class="tab-box selected" v-if="sex==2">女性</div>
                            <div class="tab-box" v-else>女性</div>
                        </a> -->
                    </div>
                    @if($teachers)
                        @foreach($teachers as $teacher)
                        <div class="l-content--teacher">
                            <a href="/teachers/detail/{{ $teacher->id }}">
                                <div class="l-content--teacher__inner l-flex">
                                    <div class="u-w100">
                                        <div class="c-img--round c-img--cover">
                                            <img>
                                        </div>
                                    </div>
                                    <div class="u-wflex1 u-pl10">
                                        <p class="u-text--big u-mb10">
                                            @if($teacher->sex == 0)
                                                <span class="c-text--sex gender u-mr10">不明</span>
                                            @elseif($teacher->sex == 1)
                                                <span class="c-text--sex man u-mr10">男性</span>
                                            @elseif($teacher->sex == 2)
                                                <span class="c-text--sex woman u-mr10">女性</span>
                                            @endif
                                            <a>{{ $teacher->name }}</a>
                                        </p>
                                        <div class="c-text--evaluation">
                                            <div class="star">
                                                <img src="/img/icon-star.png">
                                                <span class="evaluation">{{ $teacher->round_avg_point }}</span>
                                            </div>
                                            <p class="review">レビュー {{ $teacher->count }}件</p>
                                        </div>
                                        <ul class="c-text--category u-mt10">
                                            @if ($teacher->category1_name)
                                                <li>{{ $teacher->category1_name }}</li>
                                            @endif
                                            @if ($teacher->category2_name)
                                                <li>{{ $teacher->category2_name }}</li>
                                            @endif
                                            @if ($teacher->category3_name)
                                                <li>{{ $teacher->category3_name }}</li>
                                            @endif
                                            @if ($teacher->category4_name)
                                                <li>{{ $teacher->category4_name }}</li>
                                            @endif
                                            @if ($teacher->category5_name)
                                                <li>{{ $teacher->category5_name }}</li>
                                            @endif
                                        </ul>
                                        <p class="u-text--sentence u-mt10 pc-only">{{ $teacher->profile }}</p>
                                    </div>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    @else
                        <p>講師がいません。</p>
                    @endif
                </div>
                <div class="l-pagenation">

                    <ul class="l-pagenation__list">
                        @for ($i = 1; $i < $teachers->lastPage()+1; $i++)
                            <li class="{{ $i == $teachers->currentPage() ? 'selected disabled' : ''}}">
                                <a href="{{ $teachers->withQueryString()->url($i) }}">{{ $i }}</a>
                            </li>
                        @endfor
                    </ul>
                </div>
            </div>
        </div>
    </div>
    {{-- <teacher-index-component :count={{ $count }} :order={{ $order }}  :page={{ $page }} :sex='{{ $sex }}' :start={{ $start }} :end={{ $end }} :page_cnt={{ $page_cnt }}  :users={{ $users }} :categories={{ $categories }} :selected_category={{ $selected_category }}></teacher-index-component> --}}
@endsection
