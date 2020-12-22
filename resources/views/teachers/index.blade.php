@extends('layouts.app')

<!-- タイトル・メタディスクリプション -->
@section('title', '講師一覧 | おけいcom')
@section('description', 'おけいcomの講師一覧ページ概要です。')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/teacher.css') }}">
@endpush

<!-- 本文 -->
@section('content')
    <teacher-index-component></teacher-index-component>
@endsection