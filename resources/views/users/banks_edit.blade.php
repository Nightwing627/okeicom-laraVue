@extends('layouts.user')

{{--  タイトル・メタディスクリプション  --}}
@section('title', '銀行情報編集')
@section('description', '銀行情報編集')

{{--  CSS  --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/dashboard.css') }}">
@endpush

{{--  JS  --}}
@push('js')
@endpush

{{--  本文  --}}
@section('content')
    {{--  エラーメッセージ  --}}
    @if ($errors->any())
        <div class="l-alart errorAlart" role="alert">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="post" action="@if(Auth::user()->status == 0) {{ route('mypage.u.bank.update') }} @else(Auth::user()->status == 1) {{ route('mypage.t.bank.update') }} @endif">
        @csrf
        <user-bank-component :bank-date={{ $bankDate }} target="{{ $target }}"></user-bank-component>
    </form>
@endsection
