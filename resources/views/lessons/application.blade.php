@extends('layouts.app')

<!-- タイトル・メタディスクリプション -->
@section('title', 'レッスン予約 | おけいcom')
@section('description', 'おけいcomのレッスン予約ページです。')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/lessonApplication.css') }}">
@endpush

<!-- 本文 -->
@section('content')
    <teacher-show-component></teacher-show-component>
@endsection