@extends('layouts.owner')

<!-- タイトル・メタディスクリプション -->
@section('title', 'ユーザー一覧 | おけいcom')
@section('description', 'ユーザー')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
	<div class="l-wrap--owner--main">
		<div class="l-wrap--owner--main--inner">
			<div class="l-wrap--owner--header">
				<div class="l-wrap--owner--header--title">
					<p>ユーザー一覧</p>
				</div>
				<div class="l-wrap--owner--header--button">
					<div class="c-button--add">
						<a href="">ユーザーを追加する</a>
					</div>
				</div>
			</div>
			<div class="l-wrap--owner--body">
				<div class="l-wrap--owner--body--inner">
					<table class="user-table">
						<thead>
							<tr>
								<td>アカウント名<br>お名前</td>
								<td>性別 / カテゴリー<br>国籍 / 言語 / 都道府県</td>
								<td>プロフィール</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<?php for($i=0;$i<10;$i++): ?>
								<tr>
									<td>アカウント名<br>お名前</td>
									<td>性別 / カテゴリー<br>国籍 / 言語 / 都道府県</td>
									<td>プロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィールプロフィール</td>
									<td>
										<div class="c-button--edit">
											<a href="" class="c-button--edit--link delete">削除</a>
											<a href="" class="c-button--edit--link edit">編集</a>
										</div>
									</td>
								</tr>
							<?php endfor; ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
@endsection