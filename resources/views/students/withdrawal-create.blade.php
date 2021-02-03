@extends(($user_status == 0)?'layouts.user-single':'layouts.teacher-single')

<!-- タイトル・メタディスクリプション -->
@section('title', '退会')
@section('description', '退会')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
    <div class="l-wrap--single">
        <div class="l-wrap--title">
            <a class="c-link--back u-mb5" href="{{ url()->previous() }}">前の画面に戻る</a>
            <h1 class="c-headline--screen">退会手続き</h1>
        </div>
        <div class="l-wrap--body">
            <div class="l-wrap--main l-wrap--detail">
                <div class="l-content--detail">
                    <div class="l-content--detail__inner">
                        <p class="u-text--sentence u-mb20">退会した場合、以下のことができなくなってしまいます。</p>
                        <ul class="c-list--dot">
                            <li>契約済みレッスンが全て見れなくなる（返金不可）</li>
                            <li>現在保有しているお金が全てなくなる</li>
                            <li>メッセージが全て削除される</li>
                            <li>レッスンの予約</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <form method="POST" action="{{ route('mypage.u.withdrawal.store') }}">
            @csrf
            <div class="l-button--submit">
                <button type="submit" class="c-button--square__pink">{{ __('Withdrawal') }}</button>
            </div>
        </form>
    </div>
@endsection




{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>退会</h2>
            <p>退会した場合、以下のことができなくなってしまいます。</p>
            <ul>
                <li>契約済みのレッスンが見れなくなる</li>
                <li>現在保有しているポイントが返金されない</li>
                <li>レッスンの予約</li>
            </ul>
            <form method="POST" action="{{ route('mypage.u.withdrawal.store') }}">
                @csrf
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Withdrawal') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection --}}
