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
    <teacher-index-component :count={{ $count }} :order={{ $order }}  :page={{ $page }} :sex='{{ $sex }}' :start={{ $start }} :end={{ $end }} :page_cnt={{ $page_cnt }}  :users={{ $users }} :categories={{ $categories }} :selected_category={{ $selected_category }}></teacher-index-component>
@endsection