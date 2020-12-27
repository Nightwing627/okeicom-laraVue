@extends('layouts.user')

<!-- タイトル・メタディスクリプション -->
@section('title', '取引履歴')
@section('description', '取引履歴')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
    <div class="user-detaling-total">
        <div class="user-detaling-total--price">
            <span>{{ $holding_amount->separate_comma_amount }}</span>
        </div>
        <div class="user-detaling-total--request">
            <a href="{{ route('mypage.u.payment.create') }}">出金リクエスト</a>
        </div>
    </div>
    <!-- tab：ゆうちょ -->
    <div class="l-list--deal">
        <div class="l-list--deal--period">
            <p class="u-color--grayNavy u-text--small">表示対象期間</p>
            <div class="c-selectBox">
                <select id="months" name="months" class="form-control" autocomplete="months">
                    <option value=""></option>
                    @foreach ($trade_months as $trade_month)
                        <option value="{{ $trade_month->months }}" @if ($loop->first) selected  @endif>{{ $trade_month->months }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <!-- スマホ -->
        <div class="l-list--deal--detail sp-only">
            <div class="l-list--deal--detail--content">
                <div class="price">
                    <p class="trade add">＋¥ 1,000,000</p>
                    <p class="balance">（残：¥213,000）</p>
                </div> 
                <div class="detail">
                    <p class="time">10月18日</p>
                    <p class="item">売上</p>
                    <p class="deal">「レッスンタイトルタイトル」</p>
                </div>
            </div>
            <div class="l-list--deal--detail--content">
                <div class="price">
                    <p class="trade minus">-¥ 3,000</p>
                    <p class="balance">（残：¥213,000）</p>
                </div> 
                <div class="detail">
                    <p class="time">10月18日</p>
                    <p class="item">キャンセル手数料</p>
                    <p class="deal">「レッスンタイトルタイトルレッスンタイトルタイトル」</p>
                </div>
            </div>
            <div class="l-list--deal--detail--content">
                <div class="price">
                    <p class="trade minus">-¥ 3,000</p>
                    <p class="balance">（残：¥213,000）</p>
                </div> 
                <div class="detail">
                    <p class="time">10月18日</p>
                    <p class="item">出金</p>
                    <p class="deal">「レッスンタイトルタイトル」</p>
                </div>
            </div>
            <div class="l-list--deal--detail--content">
                <div class="price">
                    <p class="trade minus">-¥ 3,000</p>
                    <p class="balance">（残：¥213,000）</p>
                </div> 
                <div class="detail">
                    <p class="time">10月18日</p>
                    <p class="item">購入</p>
                    <p class="deal">「レッスンタイトルタイトル」</p>
                </div>
            </div>
            <div class="l-list--deal--detail--content">
                <div class="price">
                    <p class="trade add">＋¥ 1,000,000</p>
                    <p class="balance">（残：¥213,000）</p>
                </div> 
                <div class="detail">
                    <p class="time">10月18日</p>
                    <p class="item">キャンセル返金</p>
                    <p class="deal">「レッスンタイトルタイトルレッスンタイトルタイトル」</p>
                </div>
            </div>
        </div>
        <!-- PC -->
        <div class="l-list--deal--detail pc-only">
            <table>
                <thead>
                    <tr>
                        <td>日付</td>
                        <td>内容</td>
                        <td>対象レッスン</td>
                        <td>入金</td>
                        <td>出金</td>
                        <td>残高</td>
                    </tr>
                </thead>
                @foreach ($trade_details as $trade_detail)
                {{-- <tr>
                    <td>1日</td>
                    <td>購入</td>
                    <td>「レッスン名レッスン名レッスン名レッスン名」</td>
                    <td class="u-textAlign__right">-</td>
                    <td class="u-textAlign__right">¥23,334</td>
                    <td class="u-textAlign__right">¥335,906</td>
                </tr> --}}
                <tr>
                    <td>{{ $trade_detail->formated_ymd_created_at }}</td>
                    <td>購入</td>
                    <td>「{{ $trade_detail->lessons_title }}」</td>
                    <td class="u-textAlign__right">-</td>
                    <td class="u-textAlign__right">{{ $trade_detail->separate_comma_point_add_sign_amount }}</td>
                    <td class="u-textAlign__right">{{ $trade_detail->separate_comma_point_amount }}</td>
                </tr>
            </table>
        </div>
    </div>
@endsection



{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>入出金履歴</h2>
            <p>保有金額</p>
            <a class="" href="{{ route('mypage.u.payment.create') }}">
                出金リクエスト
            </a>
            {{ $holding_amount->separate_comma_amount }}
            <br>

            <select id="months" name="months" class="form-control" autocomplete="months">
                <option value=""></option>
                @foreach ($trade_months as $trade_month)
                    <option value="{{ $trade_month->months }}" @if ($loop->first) selected  @endif>{{ $trade_month->months }}</option>
                @endforeach
            </select>

            @foreach ($trade_details as $trade_detail)
                <p>{{ $trade_detail->formated_ymd_created_at }}</p>
                <p>「{{ $trade_detail->lessons_title }}」代金</p>
                <p>{{ $trade_detail->separate_comma_point_add_sign_amount }}</p>
                <p>{{ $trade_detail->separate_comma_point_amount }}</p>
            @endforeach
        </div>
    </div>
</div>
@endsection --}}
