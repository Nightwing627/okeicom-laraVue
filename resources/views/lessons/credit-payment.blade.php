@extends('layouts.single')

<!-- タイトル・メタディスクリプション -->
@section('title', 'クレジットカード決済 | おけいcom')
@section('description', 'おけいcomのクレジットカード決済ページです。')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/lessonApplication.css') }}">
@endpush

<!-- 本文 -->
@section('content')
	<div class="l-wrap--single">
		<div class="l-wrap--title">
			<a class="c-link--back u-mb5" href="">予約確認画面へ戻る</a>
			<h1 class="c-headline--screen">クレジットカード決済</h1>
		</div>
		<div class="l-wrap--body">
			<div class="l-wrap--main l-wrap--detail">
				<div class="l-content--detail">
					<div class="c-headline--block">金額</div>
					<div class="l-content--detail__inner">
						<p class="u-textAlign__center u-text--big">¥9,000</p>
					</div>
				</div>
				<div class="l-content--detail">
					<div class="c-headline--block">クレジットカード情報</div>
					<div class="l-content--detail__inner">
						<div class="l-content--input">
							<p class="l-content--input__headline">クレジットカード番号</p>
							<input type="" name="" placeholder="0000111122223333">
						</div>
						<div class="l-content--input">
							<div class="l-flex">
								<div class="l-content--input__two">
									<div class="l-content--input__headline">有効期限（年）</div>
									<input type="" name="" placeholder="21">
								</div>
								<div class="l-content--input__two">
									<div class="l-content--input__headline">有効期限（月）</div>
									<input type="" name="" placeholder="00">
								</div>
							</div>
							
						</div>
						<div class="l-content--input">
							<p class="l-content--input__headline">カード名義人</p>
							<input type="" name="" placeholder="SAMPLE SAMPLE">
						</div>
						<div class="l-content--input">
							<p class="l-content--input__headline">セキュリティコード</p>
							<input type="" name="" class="u-w150" placeholder="000">
						</div>
					</div>
				</div>
			</div>
		</div>
		{{-- <div class="l-button--confirm">
			<div class="l-button--confirm__inner">
				<input type="checkbox" name="" id="class">
				<label for="class">クレジットカード情報を登録する（自動的にメインになります）</label>
			</div>
		</div> --}}
		<div class="l-button--submit">
			<input class="c-button--square__pink" type="subit" name="" value="決済する">
		</div>
	</div>
@endsection