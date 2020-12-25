@extends('layouts.owner')

<!-- タイトル・メタディスクリプション -->
@section('title', 'お知らせ一覧 | おけいcom')
@section('description', 'お知らせ一覧')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
	<div class="l-wrap--owner--main">
		<div class="l-wrap--owner--header">
			<div class="l-wrap--owner--header--title">
				<p>お知らせ一覧</p>
			</div>
		</div>
		<div class="l-wrap--owner--body">
			<div class="l-wrap--owner--body--inner">
				<table>
					<thead>
						<tr>
							<td>日時</td>
							<td>タイトル</td>
							<td>配信内容</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<!-- レッスン受講料、取り消し可能 -->
						<?php for($i=0;$i<20;$i++): ?>
							<tr>
								<td style="white-space: nowrap;">2020/12/12 12:00</td>
								<td><a href="" class="u-text--link" target="_blank">タイトルタイトルタイトルタイトル</a></td>
								<!-- 最初の100文字程度？ -->
								<td>ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ</td>
								<td>
									<div class="c-button--edit one-button">
										<a href="" class="c-button--edit--link delete">削除</a>
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