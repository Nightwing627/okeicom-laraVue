@extends('layouts.single')

<!-- タイトル・メタディスクリプション -->
@section('title', 'キャンセル')
@section('description', 'キャンセル')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/lessonCancel.css') }}">
@endpush

<!-- 本文 -->
@section('content')
    <div class="l-wrap--single">
    	<div class="l-wrap--title">
    		<a class="c-link--back u-mb5" href="">レッスン詳細へ戻る</a>
    		<h1 class="c-headline--screen">レッスンを予約する</h1>
    	</div>
    	<div class="l-wrap--body">
    		<div class="l-wrap--main l-wrap--detail">
    			<div class="l-content--detail">
    				<div class="c-headline--block">レッスン詳細</div>
    				<div class="l-content--detail__inner l-flex_pc u-pb10_sp">
    					<p class="u-text--big u-mb5_sp">¥12,000</p>
    					<p class="u-text--big">10/20(土) 17:00-20:00</p>
    				</div>
    				<div class="l-content--detail__inner l-flex">
    					<div class="u-w30per">
    						<div class="c-img--cover">
    							<img src="/img/common/screen-top.jpg">
    						</div>
    					</div>
    					<div class="u-w70per u-pl15">
    						<p class="c-text--title">レッスン名レッスン名レッスン名レッスン名レッスン名</p>
    						<p class="c-text--detail pc-only">レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細</p>
    					</div>
    				</div>
    			</div>
    			<div class="l-content--detail">
    				<div class="c-headline--block">キャンセル手数料</div>
    				<div class="l-content--detail__inner">
    					<div class="cancelArea">
    						<span class="cancelAreaText pc-only">キャンセル手数料</span>
    						<p class="cancelAreaNumber">¥3,000</p>
    					</div>
    					<div class="cancelSub">24時間以内のキャンセルは、キャンセル申請を講師及び運営者側に拒否される可能性があります。<br>その場合、支払済のポイントは返金されません。</div>
    				</div>
    			</div>
    			<div class="l-content--detail">
    				<div class="c-headline--block">キャンセル理由</div>
    				<div class="l-content--detail__inner">
    					<div class="cancelReason">
    						
    						<div class="cancelReasonArea">
    							<textarea placeholder="詳細をご記入ください"></textarea>
    						</div>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="l-button--confirm">
    		<div class="l-button--confirm__inner">
    			<input type="checkbox" name="">
    			<label><a href="" class="u-text--link">キャンセルポリシー</a>に同意する</label>
    		</div>
    	</div>
    	<div class="l-button--submit">
    		<input class="c-button--square__pink" type="subit" name="" value="キャンセル確定">
    	</div>
    </div>
@endsection
