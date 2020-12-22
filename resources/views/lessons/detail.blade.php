@extends('layouts.app')

<!-- タイトル・メタディスクリプション -->
@section('title', 'レッスン詳細')
@section('description', 'おけいcomの詳細ページです。')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/lessonDetail.css') }}">
@endpush

<!-- 本文 -->
@section('content')
    <lesson-show-component></lesson-show-component>
@endsection
