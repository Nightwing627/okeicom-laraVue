@extends('layouts.app')

<!-- タイトル・メタディスクリプション -->
@section('title', '講師詳細 | おけいcom')
@section('description', 'おけいcomの講師詳細ページ概要です。')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherDetail.css') }}">
@endpush

<!-- 本文 -->
@section('content')
    <div class="l-wrap--title profile">
        <div class="l-wrap">
            <div class="teacherDetail-profile">
                <div class="teacherDetail-profile-detail">
                    <div class="c-img--shadow">
                        <div class="c-img--cover c-img--round" v-if="user.img!=null">
                            <img src="/storage/courses/$user->img">"
                        </div>
                    </div>
                    <p class="u-text--big u-mb10">{{ $user->name }}</p>
                    <div class="c-text--evaluation u-mb5">
                        <div class="star">
                            <img src="/img/icon-star.png">
                            <span class="evaluation">{{ $user->ave }}</span>
                        </div>
                        <p class="review">レビュー {{ $user->count }}件</p>
                    </div>
                    <ul class="c-text--category u-mb5">
                        <li  v-if="user.cat1!=null">{{ $user->cat1 }}</li>
                        <li  v-if="user.cat2!=null">{{ $user->cat2 }}</li>
                        <li  v-if="user.cat3!=null">{{ $user->cat3 }}</li>
                        <li  v-if="user.cat4!=null">{{ $user->cat4 }}</li>
                        <li  v-if="user.cat5!=null">{{ $user->cat5 }}</li>
                    </ul>
                    <div class="teacherDetail-profile-detail-tab u-mb10">
                        <div class="tabBox"><span>国籍</span>{{ $user->country }}</div>
                        <div class="tabBox"><span>言語</span>{{ $user->lang }}</div>
                        <div class="tabBox"><span>都道府県</span>{{ $user->pref }}</div>
                    </div>
                    <a href="{{ route }}" class="c-button--square__pink">メッセージを送る</a>
                </div>
                <div class="teacherDetail-profile-text">
                    <p class="u-text--sentence">{{ user.profile }}</p>
                </div>
            </div>
        </div>
    </div>
    <teacher-show-component :user={{ $user }} :lessons={{ $lessons }} :evalutions={{ $evalutions }}></teacher-show-component>
@endsection
