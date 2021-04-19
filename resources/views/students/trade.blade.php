@extends(($user_status == 0)?'layouts.user':'layouts.teacher')

{{--  タイトル・メタディスクリプション  --}}
@section('title', '入出金管理')
@section('description', '入出金管理')

{{--  CSS  --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/userDealing.css') }}">
@endpush

{{-- 本文  --}}
@section('content')
    <div class="user-detaling-total">
        <div class="user-detaling-total--price">
            <span>¥{{ number_format($holding_amount) }}</span>
        </div>
        <div class="user-detaling-total--request">
            <a href="{{ route('mypage.u.payment.create') }}" @if($holding_amount === 0) class="disabled" disabled="disabled" tabindex="-1" @endif>出金リクエスト</a>
            {{--  <form method="POST" action="{{ route('mypage.u.payment.create') }}">
                <button type="submit" class="c-button--square__pink" @if($holding_amount->separate_comma_amount == '¥0') disabled @endif>出金リクエスト</button>
            </form>  --}}
        </div>
    </div>
    {{--  tab：ゆうちょ  --}}
    <div class="l-list--deal">
        <div class="l-list--deal--period">
            <p class="u-color--grayNavy u-text--small">表示対象期間</p>
            <div class="c-selectBox">
                <select id="months" name="months" class="form-control" autocomplete="months">
                    @foreach ($trade_months as $trade_month)
                        <option value="{{ $trade_month->months }}" @if ($loop->first) selected  @endif>{{ date("Y年n月j日" ,strtotime($trade_month->months)) }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        {{--  スマホ  --}}
        <div class="l-list--deal--detail sp-only">
            @foreach ($trade_details as $trade_detail)
            <div class="l-list--deal--detail--content">
                <div class="price">
                    <p class="trade add">{{ $trade_detail->separate_comma_point_add_sign_amount }}</p>
                    <p class="balance">（残：{{ $trade_detail->separate_comma_point_amount }}）</p>
                </div>
                <div class="detail">
                    <p class="time"></p>
                    @if($trade_detail->lessons_title == '出金')
                    <p class="item">出金</p>
                    <p class="deal"></p>
                    @else
                    <p class="item">売上</p>
                    <p class="deal">「レッスンタイトルタイトル」</p>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
        {{--  PC  --}}
        <div class="l-list--deal--detail pc-only">
            <table>
                <thead>
                    <tr>
                        <td>日付</td>
                        <td>対象レッスン</td>
                        <td>入金</td>
                        <td>出金</td>
                        <td>残高</td>
                    </tr>
                </thead>
                @foreach ($trade_details as $trade_detail)
                {{--
                <tr>
                    <td>1日</td>
                    <td>購入</td>
                    <td>「レッスン名レッスン名レッスン名レッスン名」</td>
                    <td class="u-textAlign__right">-</td>
                    <td class="u-textAlign__right">¥23,334</td>
                    <td class="u-textAlign__right">¥335,906</td>
                </tr>
                --}}
                <tr>
                    <td>{{ $trade_detail->formated_ymd_created_at }}</td>
                    @if($trade_detail->lessons_title == '出金')
                    <td>出金依頼</td>
                    <td></td>
                    <td class="u-textAlign__right">{{ $trade_detail->separate_comma_amount }}</td>
                    @else
                    <td>「{{ $trade_detail->lessons_title }}」</td>
                    <td class="u-textAlign__right">{{ $trade_detail->separate_comma_amount }}</td>
                    <td></td>
                    @endif
                    {{-- <td class="u-textAlign__right"></td> --}}
                    <td class="u-textAlign__right">{{ $trade_detail->separate_comma_point_amount }}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
