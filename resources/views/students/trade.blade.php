@extends('layouts.app')

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
@endsection
