@extends('layouts.app')

{{-- タイトル・メタディスクリプション --}}
@section('title', '講師詳細 | おけいcom')
@section('description', 'おけいcomの講師詳細ページ概要です。')

{{-- CSS --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherDetail.css') }}">
@endpush

{{-- 本文 --}}
@section('content')
    <!--
    <div class="l-wrap--title profile">
        <div class="l-wrap">
            <div class="teacherDetail-profile">
                <div class="teacherDetail-profile-detail">
                    <div class="c-img--shadow">
                        <div class="c-img--cover c-img--round">
                            <img src="{{ asset('/storage/profile/' . $user->img) }}">
                        </div>
                    </div>
                    <p class="u-text--big u-mb10"></p>
                    <div class="c-text--evaluation u-mb5">
                        <div class="star">
                            <img src="/img/common/icon-star.png">
                            <span class="evaluation">{{ $user->round_avg_point }}</span>
                        </div>
                        <p class="review">レビュー {{ $user->reviews }}件</p>
                    </div>
                    <ul class="c-text--category u-mb5">
                        @isset($user->category1_id)<li>{{ $user->category1_name }}</li>@endisset
                        @isset($user->category2_id)<li>{{ $user->category2_name }}</li>@endisset
                        @isset($user->category3_id)<li>{{ $user->category3_name }}</li>@endisset
                        @isset($user->category4_id)<li>{{ $user->category4_name }}</li>@endisset
                        @isset($user->category5_id)<li>{{ $user->category5_name }}</li>@endisset
                    </ul>
                    <div class="teacherDetail-profile-detail-tab u-mb10">
                        <div class="tabBox"><span>国籍</span>{{ $user->country_id ?: '未設定' }}</div>
                        <div class="tabBox"><span>言語</span>{{ $user->language_id ?: '未設定' }}</div>
                        <div class="tabBox"><span>都道府県</span>{{ $user->prefecture_id ?: '未設定' }}</div>
                    </div>
                    <a href="/mypage/t/messages/{{$user->id}}" class="c-button--square__pink">メッセージを送る</a>
                </div>
                <div class="teacherDetail-profile-text">
                    <p class="u-text--sentence"></p>
                </div>
            </div>
        </div>
    </div>
    -->
    <teacher-show-component :user="{{$user}}" :lessons="{{$lessons}}" :evalutions="{{$evalutions}}"></teacher-show-component>
@endsection
