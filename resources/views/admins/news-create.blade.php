@extends('layouts.owner')

<!-- タイトル・メタディスクリプション -->
@section('title', 'お知らせ新規作成 | おけいcom')
@section('description', 'お知らせ新規作成')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
	<div class="l-wrap--owner--main single-page">
		<div class="l-wrap--owner--main--inner">
			<div class="l-wrap--owner--header">
				<div class="l-wrap--owner--header--title">
					<a href="" class="c-link--back">お知らせ一覧へ戻る</a>
					<p>お知らせ作成</p>
				</div>
			</div>
			<div class="l-wrap--owner--body">
				<div class="l-wrap--owner--body--inner u-mb10">
					<div class="l-wrap--owner--body--news">
						<input type="text" name="" placeholder="タイトル">
					</div>
				</div>
				<div class="l-wrap--owner--body--inner">

					<div class="l-wrap--owner--body--news">
						<textarea placeholder="本文"></textarea>
					</div>
				</div>
				<div class="l-button--submit">
					<input type="subit" name="" value="投稿する" class="c-button--square__pink">
				</div>
			</div>
		</div>
	</div>
@endsection
