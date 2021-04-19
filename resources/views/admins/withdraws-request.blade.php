
@extends('layouts.owner')

{{--  タイトル・メタディスクリプション  --}}
@section('title', '出金リクエスト | おけいcom')
@section('description', '出金リクエスト')

{{--  CSS  --}}
@push('css')
@endpush

{{--  本文  --}}
@section('content')
	<div class="l-wrap--owner--main">
		<div class="l-wrap--owner--main--inner">
			<div class="l-wrap--owner--header">
				<div class="l-wrap--owner--header--title">
					<p>出金リクエスト一覧</p>
				</div>
			</div>
			<div class="l-wrap--owner--body">
				<div class="l-wrap--owner--body--inner">
					<table class="withdraw-request-table">
						<thead>
							<tr>
								<td>出金リクエスト日時</td>
								<td>アカウント</td>
								<td>振込先銀行名<br>その他情報</td>
								<td>リクエスト金額</td>
								<td></td>
							</tr>
						</thead>
						<tbody>
							<?php for($i=0;$i<20;$i++): ?>
								<tr>
									<td>2020/12/12 10:33</td>
									<td><a href="" class="u-text--link">アカウント名</a></td>
									<td>ゆうちょ銀行<br>その他情報</td>
									<td>¥200,000</td>
									<td>
										<div class="c-button--edit">
											<a href="" class="c-button--edit--link delete">完了</a>
										</div>
									</td>
								</tr>
							<?php endfor; ?>
						</tbody>
					</table>
				</div>
				<div class="pagenation-list">
					<ul>
						<li class="now">１</li>
						<?php for($i=2;$i<10;$i++): ?>
							<li><a href=""><?php echo $i; ?></a></li>
						<?php endfor; ?>
					</ul>
				</div>
			</div>
		</div>
	</div>
@endsection
