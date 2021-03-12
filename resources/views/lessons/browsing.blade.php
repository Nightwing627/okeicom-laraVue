@extends('layouts.user-single')

<!-- タイトル・メタディスクリプション -->
@section('title', 'レッスン閲覧画面')
@section('description', 'レッスン閲覧画面')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
	<div class="l-wrap--single">
		<div class="l-wrap--title">
			<h1 class="c-headline--screen">レッスン受講画面</h1>
		</div>
		<div class="l-wrap--body">
			<div class="l-wrap--main l-wrap--detail">
				<div class="l-content--detail">
					<div class="l-content--detail__inner">
                        <div class="browsing-url">
                            <a class="u-text--link" target="_blank" rel="noopener noreferrer" href="https://www.youtube.com/watch?v=rOho8r3Y2_k">https://www.youtube.com/watch?v=rOho8r3Y2_k</a>
                        </div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection
