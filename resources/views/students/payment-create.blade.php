@extends(($user_status == 0)?'layouts.user-single':'layouts.teacher-single')

{{-- タイトル・メタディスクリプション --}}
@section('title', '出金リクエスト')
@section('description', '出金リクエスト')

{{-- CSS --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacher.css') }}">
<link rel="stylesheet" href="{{ asset('/css/foundation/single/userPayment.css') }}">
@endpush

{{-- 本文 --}}
@section('content')
    <div class="l-wrap--single">
        <div class="l-wrap--title">
            <a class="c-link--back u-mb5" href="{{ url()->previous() }}">取引一覧へ戻る</a>
            <h1 class="c-headline--screen">出金リクエスト</h1>
        </div>
        <form method="POST" action="{{ route('mypage.t.payment.store') }}">
            @csrf
            <input type="hidden" name="amount" value="{{ $holding_amount->amount }}">
            <div class="l-wrap--body">
                <div class="l-wrap--main l-wrap--detail">
                    <div class="l-content--detail">
                        <div class="c-headline--block">出金額</div>
                        <div class="l-content--detail__inner">
                            <div class="user-pament-total">
                                <p>{{ $holding_amount->separate_comma_amount }}</p>
                            </div>
                        </div>
                    </div>
                    <user-payment-component :bank-date={{ $bankDate }} target="{{ $target }}"></user-payment-component>
                </div>
            </div>
            <div class="l-button--submit">
                <button class="c-button--square__pink" type="submit">出金リクエスト確定</button>
            </div>
        </form>
    </div>
@endsection
