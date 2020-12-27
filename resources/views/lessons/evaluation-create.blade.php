@extends('layouts.single')
<!-- タイトル・メタディスクリプション -->
@section('title', '評価完了')
@section('description', '評価完了')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
	<div class="l-wrap--single">
		<div class="l-wrap--title">
			<h1 class="c-headline--screen">講師を評価する</h1>
		</div>
		<div class="l-wrap--body">
			<div class="l-wrap--main l-wrap--detail">
				<div class="l-content--detail">
					<div class="l-content--detail__inner">
						<p class="u-text--sentence">レッスンお疲れ様でした！<br>講師への評価をお願いいたします。</p>
					</div>
				</div>
				<div class="l-content--detail">
					<div class="c-headline--block">講師を評価</div>
					<div class="l-content--detail__inner">
						<div class="l-content--input">
							<p class="l-content--input__headline">評価</p>
							<div class="c-selectBox u-w200">
								<select>
									<option>5（とても良い）</option>
									<option>4（良い）</option>
									<option>3（普通）</option>
									<option>2（悪い）</option>
									<option>1（とても悪い）</option>
								</select>
							</div>
						</div>
						<div class="l-content--input">
							<p class="l-content--input__headline">コメント</p>
							<textarea></textarea>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="l-button--submit">
			<input class="c-button--square__pink" type="subit" name="" value="評価を登録する">
		</div>
	</div>
@endsection


{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>講師を評価</h2>
            </div>
        </div>
    </div>
@endsection
 --}}