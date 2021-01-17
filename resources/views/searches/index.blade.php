@extends('layouts.app')

<!-- タイトル・メタディスクリプション -->
@section('title', '検索結果')
@section('description', 'おけいcomの検索結果ページです。')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/searchResult.css') }}">
<link rel="stylesheet" href="{{ asset('/css/npm/vue3-datepicker.css') }}">
@endpush

<!-- 本文 -->
@section('content')
    <search-component
        keyword="{{ $keyword }}"
        :lessons="{{ $lessons }}"
    >
    </search-component>
@endsection
