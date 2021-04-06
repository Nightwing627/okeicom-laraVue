@extends('layouts.teacher')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'レッスン詳細')
@section('description', 'レッスン詳細')

{{-- CSS --}}
@push('css')
    <link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherCourseDetail.css') }}">
@endpush

{{-- 本文 --}}
@section('content')
    <lesson-edit-component :lesson="{{$lesson}}" :users="{{$users}}"></lesson-edit-component>
@endsection
