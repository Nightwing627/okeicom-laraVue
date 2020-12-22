@extends('layouts.app')

<!-- タイトル・メタディスクリプション -->
@section('title', 'おけいcom')
@section('description', 'おけいcomのページ概要です。')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/searchResult.css') }}">
@endpush

<!-- 本文 -->
@section('content')
    <lesson-index-component></lesson-index-component>
@endsection

{{--
// カテゴリー一覧

@foreach($categories as $category)
<a class="" href="{{ route('lessons.categories', ['categories_id' => $category->id]) }}">
{{ $category->name }}
</a>
@endforeach
--}}


{{--
// レッスン一覧

@foreach($lessons as $lesson)
{{ $lesson->kanji_number }}
{{ $lesson->add_week_date }}
{{ $lesson->separate_hyphen_time }}
{{ $lesson->category1_name }} {{ $lesson->category2_name }} {{ $lesson->category3_name }}
{{ $lesson->title }}
{{ $lesson->detail }}
{{ $lesson->user_name }}
@endforeach
--}}


{{--
// ページネーション

{{ $lessons->links('vendor.pagination.simple-tailwind') }}
--}}
