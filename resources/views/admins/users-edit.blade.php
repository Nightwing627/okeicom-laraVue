{{-- @extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>(管理者専用ページ)</h2>
                <h2>ユーザ編集</h2>
            </div>
        </div>
    </div>
@endsection --}}


@extends('layouts.owner')

<!-- タイトル・メタディスクリプション -->
@section('title', 'ユーザー詳細 | おけいcom')
@section('description', 'ユーザー詳細')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
	<admin-user-edit-component></admin-user-edit-component>
@endsection