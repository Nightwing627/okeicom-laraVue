@extends('layouts.user')

<!-- タイトル・メタディスクリプション -->
@section('title', 'メッセージ一覧')
@section('description', 'メッセージ一覧')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/userMessage.css') }}">
@endpush

<!-- 本文 -->
@section('content')
    <div class="message-header l-flex l-start">
        <div class="message-header-back sp-only">
            <a href="">
                <img src="/img/common/icon-arrow-left-blue.png">
            </a>
        </div>
        <div class="message-header-img pc-only">
            <div class="c-img--cover c-img--round">
                <img src="/storage/profile/{{ $user_img }}">
            </div>
        </div>
        <p></p>
        <p class="u-text--big">{{ $user_name }}</p>
    </div>
    <div class="message-body">
        @php
            if(!$message_details->isEmpty()) {
                $break_date = '';
                foreach ($message_details as $message_detail) {
                    if($break_date != $message_detail->separate_hyphen_created_at) {
                        echo '<div class="message-body-block"><p class="message-body-date">';
                        echo $message_detail->separate_hyphen_created_at;
                        echo '</p></div>';
                    }
                    $break_date = $message_detail->separate_hyphen_created_at;
                    echo '<div class="message-body-block"><div class="l-flex">';
                    // 自分か相手かの判断方法↓ フロント実装後このコメントは削除してください
                    // if($partner_users_id == $message_detail->user_send_id) {
                    //     echo '相手';
                    // } else {
                    //     echo '自分';
                    // }
                    echo '<div class="message-body-img"><div class="c-img--cover c-img--round"><img src="/storage/profile/' . $message_detail->users_img .'"></div></div>';
                    echo '<div class="message-body-text"><p class="name"><a href="/teachers/detail/' . $message_detail->partner_users_id . '" class="u-text--link">'. $message_detail->users_name . '</a></p><p class="body">'. $message_detail->message_detail . '</p></div>';
                    echo '<div class="message-body-time"><span class="u-color--gray u-text--small">' . $message_detail->created_time . '</span></div>';
                    if ($message_detail->file) {
                        echo '<p>'. $message_detail->public_path_file . '</p>';
                    }
                    echo '</div></div>';
                }
            } else {
                echo 'メッセージはありません';
            }
        @endphp
    </div>
    <div class="message-input">
        {{-- @if(!$message_details->isEmpty()) --}}
        <form method="POST" action="{{ route('mypage.u.messages.send') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" id="partner_users_id" name="partner_users_id" value="{{ $partner_users_id }}">
            <user-profile-message-file-component></user-profile-message-file-component>
        </form>
        {{-- @endif --}}
    </div>
@endsection


{{--
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<link rel="stylesheet" href="{{ asset('/css/foundation/single/userMessage.css') }}">
<body>
    <div id="app" class="login-user l-message">
        <header-user-component></header-user-component>
        <main>
            <div class="l-wrap--body">
                <user-message-component></user-message-component>

                <div class="l-message--inner">
                    <!-- サイドバー -->
                    <div class="message-sidebar pc-only">
                        <div class="message-sidebar-list">
                            <div class="message-sidebar-list-box" v-for="i in 10">
                                <div class="l-flex l-v__center">
                                    <div class="u-w50">
                                        <div class="message-sidebar-list-box-img">
                                            <div class="c-img--cover">
                                                <img src="/img/common/screen-top.jpg">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="u-wflex1">
                                        <p class="u-color--red u-text--small u-mt5">未読</p>
                                        <p>名前名前名前</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- メイン -->
                    <div class="message-header l-flex l-start">
                        <div class="message-header-back sp-only">
                            <a href="">
                                <img src="/img/common/icon-arrow-left-blue.png">
                            </a>
                        </div>
                        <div class="message-header-img pc-only">
                            <div class="c-img--cover c-img--round">
                                <img src="/img/common/screen-top.jpg">
                            </div>
                        </div>
                        <p class="u-text--big">名前名前名前名前</p>
                    </div>
                    <div class="message-body">
                        <div class="message-body-block"><p class="message-body-date">2020/12/03</p></div>
                        <div class="message-body-block">
                            <div class="l-flex">
                                <div class="message-body-img">
                                    <div class="c-img--cover c-img--round">
                                        <img src="/img/common/screen-top.jpg">
                                    </div>
                                </div>
                                <div class="message-body-text">
                                    <p class="name">
                                        <a href="" class="u-text--link">田中</a>
                                    </p>
                                    <p class="body">ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ</p>
                                </div>
                                <div class="message-body-time">
                                    <span class="u-color--gray u-text--small">11:32</span>
                                </div>
                            </div>
                        </div>
                        <div class="message-body-block">
                            <div class="l-flex">
                                <div class="message-body-img">
                                    <div class="c-img--cover c-img--round">
                                        <img src="/img/common/screen-top.jpg">
                                    </div>
                                </div>
                                <div class="message-body-text">
                                    <p class="name">
                                        <a href="" class="u-text--link">田中</a>
                                    </p>
                                    <p class="body">ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ</p>
                                </div>
                                <div class="message-body-time">
                                    <span class="u-color--gray u-text--small">11:32</span>
                                </div>
                            </div>
                        </div>
                        <div class="message-body-block">
                            <div class="l-flex">
                                <div class="message-body-img">
                                    <div class="c-img--cover c-img--round">
                                        <img src="/img/common/screen-top.jpg">
                                    </div>
                                </div>
                                <div class="message-body-text">
                                    <p class="name">
                                        <a href="" class="u-text--link">田中</a>
                                    </p>
                                    <p class="body">ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ</p>
                                </div>
                                <div class="message-body-time">
                                    <span class="u-color--gray u-text--small">11:32</span>
                                </div>
                            </div>
                        </div>
                        <div class="message-body-block">
                            <div class="l-flex">
                                <div class="message-body-img">
                                    <div class="c-img--cover c-img--round">
                                        <img src="/img/common/screen-top.jpg">
                                    </div>
                                </div>
                                <div class="message-body-text">
                                    <p class="name">
                                        <a href="" class="u-text--link">田中</a>
                                    </p>
                                    <p class="body">ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ</p>
                                </div>
                                <div class="message-body-time">
                                    <span class="u-color--gray u-text--small">11:32</span>
                                </div>
                            </div>
                        </div>
                        <div class="message-body-block">
                            <div class="l-flex">
                                <div class="message-body-img">
                                    <div class="c-img--cover c-img--round">
                                        <img src="/img/common/screen-top.jpg">
                                    </div>
                                </div>
                                <div class="message-body-text">
                                    <p class="name">
                                        <a href="" class="u-text--link">田中</a>
                                    </p>
                                    <p class="body">ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ</p>
                                </div>
                                <div class="message-body-time">
                                    <span class="u-color--gray u-text--small">11:32</span>
                                </div>
                            </div>
                        </div>
                        <div class="message-body-block"><p class="message-body-date">2020/12/04</p></div>
                        <div class="message-body-block">
                            <div class="l-flex">
                                <div class="message-body-img">
                                    <div class="c-img--cover c-img--round">
                                        <img src="/img/common/screen-top.jpg">
                                    </div>
                                </div>
                                <div class="message-body-text">
                                    <p class="name">
                                        <a href="" class="u-text--link">田中</a>
                                    </p>
                                    <p class="body">ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ</p>
                                </div>
                                <div class="message-body-time">
                                    <span class="u-color--gray u-text--small">11:32</span>
                                </div>
                            </div>
                        </div>
                        @php
                            if(!$message_details->isEmpty()) {
                                $break_date = '';
                                foreach ($message_details as $message_detail) {
                                    if($break_date != $message_detail->separate_hyphen_created_at) {
                                        echo '<div class="message-body-block"><p class="message-body-date">';
                                        echo $message_detail->separate_hyphen_created_at;
                                        echo '</p></div>';
                                    }
                                    $break_date = $message_detail->separate_hyphen_created_at;
                                    echo '<div class="message-body-block"><div class="l-flex">';
                                    // 自分か相手かの判断方法↓ フロント実装後このコメントは削除してください
                                    // if($partner_users_id == $message_detail->user_send_id) {
                                    //     echo '相手';
                                    // } else {
                                    //     echo '自分';
                                    // }
                                    echo '<div class="message-body-img"><div class="c-img--cover c-img--round"><img src="/storage/profile/' . $message_detail->users_img .'"></div></div>';
                                    echo '<div class="message-body-text"><p class="name"><a href="/teachers/detail/' . $message_detail->partner_users_id . '" class="u-text--link">'. $message_detail->users_name . '</a></p><p class="body">'. $message_detail->message_detail . '</p></div>';
                                    echo '<div class="message-body-time"><span class="u-color--gray u-text--small">' . $message_detail->created_time . '</span></div>';
                                    if ($message_detail->file) {
                                        echo '<p>'. $message_detail->public_path_file . '</p>';
                                    }
                                    echo '</div></div>';
                                }
                            } else {
                                echo 'メッセージはありません';
                            }
                        @endphp
                    </div>
                    <div class="message-input">
                        {{-- @if(!$message_details->isEmpty()) --}}
                        <form method="POST" action="{{ route('mypage.u.messages.send') }}" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" id="partner_users_id" name="partner_users_id" value="{{ $partner_users_id }}">
                            <user-profile-message-file-component></user-profile-message-file-component>
                        </form>
                        {{-- @endif --}}
                    </div>
                </div>
            </div>
        </main>
    </div>
    @include("../common/footer-message")
</body>
</html>
--}}


{{--
開発者が実装したもの
@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>メッセージ詳細</h2>
            <div class="col-12">
                @php
                    if(!$message_details->isEmpty()) {
                        $break_date = '';
                        foreach ($message_details as $message_detail) {
                            if($break_date != $message_detail->separate_hyphen_created_at) {
                                echo $message_detail->separate_hyphen_created_at;
                                echo '<hr>';
                            }
                            $break_date = $message_detail->separate_hyphen_created_at;

                            // 自分か相手かの判断方法↓ フロント実装後このコメントは削除してください
                            if($partner_users_id == $message_detail->user_send_id) {
                                echo '相手';
                            } else {
                                echo '自分';
                            }
                            echo '<p>' . $message_detail->users_name . ' ' . $message_detail->created_time . '</p>';
                            echo '<p>'. $message_detail->message_detail . '</p>';
                            if ($message_detail->file) {
                                echo '<p>'. $message_detail->public_path_file . '</p>';
                            }
                        }
                    } else {
                        echo 'メッセージはありません';
                    }
                @endphp

                @if(!$message_details->isEmpty())
                    <form method="POST" action="{{ route('mypage.u.messages.send') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="partner_users_id" name="partner_users_id" value="{{ $partner_users_id }}">

                        <div class="form-group row">
                            <div class="col-12">
                                <textarea id="message_detail" class="form-control @error('message_detail') is-invalid @enderror" name="message_detail" required cols="50" rows="5" placeholder="メッセージを入力"></textarea>

                                @error('message_detail')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label title="ファイル" class="@error('file') is-invalid @enderror btn btn-primary mr-2">
                                    <input type="file" accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.png,.jpeg,.jpg,.gif" id="file" name="file" style="display:none">
                                    ファイル
                                </label>
                                @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <button name="save" type="submit" class="btn btn-primary">
                                    送信
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
--}}
