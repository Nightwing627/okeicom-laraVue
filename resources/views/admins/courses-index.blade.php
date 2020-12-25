@extends('layouts.owner')

<!-- タイトル・メタディスクリプション -->
@section('title', 'コース一覧 | おけいcom')
@section('description', 'コース一覧')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
<div class="l-wrap--owner--main">
		<div class="l-wrap--owner--header">
			<div class="l-wrap--owner--header--title">
				<p>コース一覧</p>
			</div>
		</div>
		<div class="l-wrap--owner--body">
			<div class="l-wrap--owner--body--inner">
				<table>
					<thead>
						<tr>
							<td>コースタイトル<br>コースカテゴリー</td>
							<td>コース詳細</td>
							<td>講師名</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php for($i=0;$i<20;$i++): ?>
							<tr>
								<td>コースタイトル<br><span class="u-text--small u-color--grayNavy">カテゴリー1 / カテゴリー2 / カテゴリー3</span></td>
								<td>コース詳細</td>
								<td><a href="" class="u-text--link">講師名</a></td>
								<td>
									<div class="c-button--edit">
										<a href="" class="c-button--edit--link delete">削除</a>
										<a href="" class="c-button--edit--link edit">詳細</a>
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
@endsection