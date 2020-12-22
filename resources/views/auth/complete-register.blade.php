{{-- @extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">会員登録完了</div>

                    <div class="card-body">
                        <p>ご登録いただき、ありがとうございました。</p>
                        <a class="" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection --}}


@extends('layouts.single')

<!-- タイトル・メタディスクリプション -->
@section('title', 'レッスン購入完了 | おけいcom')
@section('description', 'レッスン購入完了')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
<div class="l-wrap--single">
    <div class="l-wrap--title">
        <h1 class="c-headline--screen">レッスン購入完了</h1>
    </div>
    <div class="l-wrap--body">
        <div class="l-wrap--main l-wrap--detail">
            <div class="l-content--detail">
                <div class="l-content--detail__inner">
                    <p class="u-text--sentence u-mb20">購入が完了しました！</p>
                    <a href="{{ url('/') }}" class="u-text--link">購入済みレッスン一覧へ</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection