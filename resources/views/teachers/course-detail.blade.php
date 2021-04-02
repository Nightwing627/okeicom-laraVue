@extends('layouts.teacher')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'コース詳細')
@section('description', 'コース詳細')

{{-- CSS --}}
@push('css')
    <link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherCourseAdd.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherCourseDetail.css') }}">
@endpush

{{-- 本文 --}}
@section('content')
    @error('img1')
        <div class="l-alart errorAlart" role="alert">
            <p>画像1</p>
        </div>
    @enderror
    @error('img2')
        <div class="l-alart errorAlart" role="alert">
            <p>画像2</p>
        </div>
    @enderror
    @error('img3')
        <div class="l-alart errorAlart" role="alert">
            <p>画像3</p>
        </div>
    @enderror
    @error('img4')
        <div class="l-alart errorAlart" role="alert">
            <p>画像4</p>
        </div>
    @enderror
    @error('img5')
        <div class="l-alart errorAlart" role="alert">
            <p>画像5</p>
        </div>
    @enderror
    @error('categories')
        <div class="l-alart errorAlart" role="alert">
            <p>カテゴリーが設定されていない、あるいは5つ以上のカテゴリーが設定されています。</p>
        </div>
    @enderror
    @error('title')
        <div class="l-alart errorAlart" role="alert">
            <p>タイトルが未記入です。</p>
        </div>
    @enderror
    @error('detail')
        <div class="l-alart errorAlart" role="alert">
            <p>詳細が未記入です。</p>
        </div>
    @enderror
    @if (session('flash_message'))
        <div class="flash_message">
            {{ session('flash_message') }}
        </div>
    @endif
    <teacher-course-detail-component
        :course={{ $course }}
        :categories_list={{ $categories }}
        :lessons={{ $lessons }}
        :csrf="{{json_encode(csrf_token())}}"
    >
    {{--
    <teacher-course-detail-component
        :course={{ $course }}
        :categories={{ $categories }}
        :lessons={{ $lessons }}
    >
    </teacher-course-detail-component>
    --}}
    </teacher-course-detail-component>
    {{--
    <form method="POST" action="{{ route('mypage.t.courses.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="courses_id" value="{{ $course->id }}">
        <button name="save" type="submit">送信する</button>
    </form>
    --}}
@endsection



{{--
<div class="l-wrap--main--inner">
    <div class="c-button--tab top-tab two-tab">
        <div class="c-button--tab--inner u-w400_pc">
            <div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '1'}" @click.prevent="changeTab('1')">コース詳細</div>
            <div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '2'}" @click.prevent="changeTab('2')">レッスン一覧</div>
        </div>
    </div>
    <!-- tab：コース詳細 -->
    <div class="c-list--table" v-if="isBarTab === '1'">
        <form method="POST" action="{{ route('mypage.t.courses.update') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="courses_id" value="{{ $course->id }}">
        <!--
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">URL</p>
            </div>
            <div class="c-list--td">
                <input type="" name="" class="" disabled value="aaaa" value="https://okei.com/aaa">
                <input id="url" class="c-input--fixed" type="text" class="form-control" name="url" value="" readonly>
            </div>
        </div>
        -->
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">画像</p>
            </div>
            <div class="c-list--td">
                <course-img-list-component
                    img1="{{ $course->img1 }}"
                    img2="{{ $course->img2 }}"
                    img3="{{ $course->img3 }}"
                    img4="{{ $course->img4 }}"
                    img5="{{ $course->img5 }}"
                ></course-img-list-component>
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">カテゴリー</p>
            </div>
            <div class="c-list--td">
                <ul class="c-list--category">
                    <li><input type="checkbox" name=""><label>語学</label></li>
                    <li><input type="checkbox" name=""><label>家庭教師</label></li>
                    <li><input type="checkbox" name=""><label>音楽</label></li>
                    <li><input type="checkbox" name=""><label>アートデザイン</label></li>
                    <li><input type="checkbox" name=""><label>美容</label></li>
                    <li><input type="checkbox" name=""><label>健康</label></li>
                    <li><input type="checkbox" name=""><label>ダンス</label></li>
                    <li><input type="checkbox" name=""><label>バレエ</label></li>
                    <li><input type="checkbox" name=""><label>フィットネス</label></li>
                    <li><input type="checkbox" name=""><label>武道</label></li>
                    <li><input type="checkbox" name=""><label>書道</label></li>
                    <li><input type="checkbox" name=""><label>お茶</label></li>
                    <li><input type="checkbox" name=""><label>お花</label></li>
                    <li><input type="checkbox" name=""><label>手芸</label></li>
                    <li><input type="checkbox" name=""><label>パソコン</label></li>
                    <li><input type="checkbox" name=""><label>趣味</label></li>
                    <li><input type="checkbox" name=""><label>教養</label></li>
                    <li><input type="checkbox" name=""><label>その他</label></li>
                </ul>
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">タイトル</p>
            </div>
            <div class="c-list--td">
                <input placeholder="1234567">
            </div>
        </div>
        <div class="c-list--tr">
            <div class="c-list--th">
                <p class="main">詳細</p>
            </div>
            <div class="c-list--td">
                <textarea></textarea>
            </div>
        </div>
        <div class="l-button--submit">
            <input type="subit" name="" value="変更内容を保存する" class="c-button--square__pink">
        </div>
    </div>
    <!-- tab：その他 -->
    <div class="l-contentList__list__wrap" v-else-if="isBarTab === '2'">
        <div class="c-button--add">
            <a @href="">レッスンを追加する</a>
        </div>
        @foreach($lessons as $lesson)
            <!-- <div class="c-list--courseLesson">
                <div class="c-list--courseLesson--num">
                    <span>#<?php echo $i; ?></span>
                </div>
                <div class="c-list--courseLesson--title">
                    <p class="title u-text--big u-mb5">タイトルタイトルタイトルタイトル</p>
                    <p class="date u-color--grayNavy u-text--small">10/20(土) 17:00-20:00</p>
                </div>
                開催日を超えた現場は削除
                <div class="c-button--edit">
                    <a href="" class="c-button--edit--link delete">削除</a>
                    <a href="" class="c-button--edit--link edit">編集</a>
                </div>
            </div> -->
            <div class="c-list--courseLesson">
                <div class="c-list--courseLesson--num">
                    <span>#<?php echo $i; ?></span>
                </div>
                <div class="c-list--courseLesson--title">
                    <p class="title u-text--big u-mb5">{{ $lesson->title }}</p>
                    <p class="date u-color--grayNavy u-text--small">{{ $lesson->separate_hyphen_date }} {{ $lesson->separate_hyphen_time }}</p>
                </div>
                <div class="c-button--edit">
                    <a href="" class="c-button--edit--link delete">削除</a>
                    <a href="{{ route('mypage.t.lessons.detail', ['id' => $lesson->id]) }}" class="c-button--edit--link edit">編集</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
--}}
