@extends('layouts.teacher')

<!-- タイトル・メタディスクリプション -->
@section('title', 'ダッシュボード')
@section('description', 'ダッシュボード')

<!-- CSS -->
@push('css')
	<link rel="stylesheet" href="{{ asset('/css/foundation/single/dashboard.css') }}">
@endpush

<!-- 本文 -->
@section('content')
	<div class="dashboard">
		<div class="dashboard-content">
			<div class="dashboard-content-list"><a href="">登録済みコース</a></div>
			<div class="dashboard-content-list"><a href="">レッスン参加状況</a></div>
			<div class="dashboard-content-list"><a href="">キャンセル依頼</a></div>
			<div class="dashboard-content-list"><a href="">メッセージ</a></div>
			<div class="dashboard-content-list"><a href="">プロフィール</a></div>
			<div class="dashboard-content-list"><a href="">入出金一覧</a></div>
			<div class="dashboard-content-list"><a href="">クレジットカード情報</a></div>
			<div class="dashboard-content-list"><a href="">銀行口座情報</a></div>
			<!-- <div class="dashboard-content-list"><a href="">クーポン発行</a></div> -->
		</div>
		<div class="dashboard-content">
			<div class="dashboard-content-list"><a href="">お知らせ</a></div>
			<div class="dashboard-content-list"><a href="">運営にお問い合わせ</a></div>
			<div class="dashboard-content-list"><a href="">ログアウト</a></div>
		</div>
	</div>
@endsection