@extends('layouts.teacher')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'レッスン詳細')
@section('description', 'レッスン詳細')

{{-- CSS --}}
@push('css')
    <link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherCourseDetail.css') }}">
@endpush

{{-- 本文 --}}
@section('content')
    <div class="l-wrap--main--inner">
        <div class="c-button--tab top-tab two-tab">
            <div class="c-button--tab--inner u-w400_pc">
                <div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '1'}" @click.prevent="changeTab('1')">レッスン詳細</div>
                <div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '2'}" @click.prevent="changeTab('2')">参加者一覧</div>
            </div>
        </div>
        <!-- tab：レッスン詳細 -->
        <!-- <div class="c-list--table" v-if="isBarTab === '1'"> -->
        <div class="c-list--table">
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">タイトル</p>
                </div>
                <div class="c-list--td">
                    <input type="" name="" placeholder="タイトルを入力してください">
                </div>
            </div>
            <!-- case：放送タイプが動画埋め込みの場合 -->
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">URL</p>
                </div>
                <div class="c-list--td">
                    <input type="" name="" placeholder="https://www.youtube.com/">
                </div>
            </div>
            <!-- case：放送タイプがスライドの場合 -->
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">スライドファイル（powerpoint）</p>
                </div>
                <div class="c-list--td">
                    <input type="file" name="" placeholder="スライドファイル" accept="application/vnd.openxmlformats-officedocument.presentationml.presentation,.pptx,application/vnd.ms-powerpoint,.ppt">
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">開催日時</p>
                </div>
                <div class="c-list--td">
                    <div class="l-flex">
                        <div class="l-content--input__two">
                            <div class="l-content--input__headline">開始時間</div>
                            <div class="l-flex l-start">
                                <div class="l-content--input__two u-w100_pc">
                                    <select>
                                        <?php for($i=0; $i<24; $i++): ?>
                                            <option><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="l-content--input__two u-w100_pc">
                                    <select>
                                        <?php for($i=0; $i<60; $i++): ?>
                                            <option><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="l-content--input__two">
                            <div class="l-content--input__headline">終了時間</div>
                            <div class="l-flex l-start">
                                <div class="l-content--input__two u-w100_pc">
                                    <select>
                                        <?php for($i=0; $i<24; $i++): ?>
                                            <option><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="l-content--input__two u-w100_pc">
                                    <select>
                                        <?php for($i=0; $i<60; $i++): ?>
                                            <option><?php echo $i; ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
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
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">金額</p>
                </div>
                <div class="c-list--td">
                    <input type="" name="" placeholder="半角数字を入力してください">
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">キャンセル手数料</p>
                </div>
                <div class="c-list--td">
                    <div class="c-selectBox u-w100">
                        <select>
                            <?php for($i = 1; $i < 101; $i ++): ?>
                            <option><?php echo $i; ?>%</option>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="l-button--submit">
                <input type="subit" name="" value="変更内容を保存する" class="c-button--square__pink">
            </div>
        </div>
        <!-- tab：その他 -->
        <div class="l-contentList__list__wrap">
            <?php for($i = 1; $i <= 10; $i++): ?>
                <div class="c-list--courseLesson">
                    <div class="c-list--courseLesson--num">
                        <div class="c-img--round c-img--cover">
                            <img src="/public/img/screen-top.jpg">
                        </div>
                    </div>
                    <div class="c-list--courseLesson--title u-pl10">
                        <p class="title u-text--big u-mb5">名前名前</p>
                        <p class="date u-color--grayNavy u-text--small">10/20(土) 12:00</p>
                    </div>
                    <!-- 開催日を超えた現場は削除 -->
                    <div class="c-button--edit">
                        <a class="c-button--edit--link edit" @click.prevent="openDetail">詳細</a>
                    </div>
                </div>
            <?php endfor; ?>
        </div>
    </div>
@endsection
