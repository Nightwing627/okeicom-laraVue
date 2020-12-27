@extends('layouts.user')

<!-- タイトル・メタディスクリプション -->
@section('title', '銀行情報編集')
@section('description', '銀行情報編集')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/dashboard.css') }}">
@endpush

<!-- 本文 -->
@section('content')
	<user-bank-component></user-bank-component>
@endsection