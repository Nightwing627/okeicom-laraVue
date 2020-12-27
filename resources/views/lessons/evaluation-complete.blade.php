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
			<h1 class="c-headline--screen">評価完了</h1>
		</div>
		<div class="l-wrap--body">
			<div class="l-wrap--main l-wrap--detail">
				<div class="l-content--detail">
					<div class="l-content--detail__inner">
						<p class="u-text--sentence">評価登録が完了しました。</p>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection

{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>講師の評価完了</h2>
            </div>
        </div>
    </div>
@endsection
 --}}