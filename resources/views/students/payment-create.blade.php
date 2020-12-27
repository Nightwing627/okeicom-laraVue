@extends('layouts.user-single')

<!-- タイトル・メタディスクリプション -->
@section('title', '出金リクエスト')
@section('description', '出金リクエスト')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacher.css') }}">
@endpush

<!-- 本文 -->
@section('content')
	<user-payment-component></user-payment-component>
@endsection


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>出金リクエスト</h2>
        </div>
    </div>
</div>
@endsection --}}
