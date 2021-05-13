@extends('layouts.teacher-single')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'コース作成')
@section('description', 'コース作成')

{{-- CSS --}}
@push('css')
  <link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherCourseAdd.css') }}">
  <link rel="stylesheet" href="{{ asset('/css/foundation/single/teacherCourseDetail.css') }}">
@endpush

{{-- 本文 --}}

@section('content')
  @if($errors->any())
    <div class="l-alart errorAlart" role="alert">
      @foreach ($errors->all() as $error)
        <p>{{ $error ?? '' }}</p>
      @endforeach
    </div>
  @endif
  @if (session('flash_message'))
    <div class="flash_message">
      <p>{{ session('flash_message') }}</p>
    </div>
  @endif
  <div class="l-wrap--single">
    <form method="POST" action="/mypage/t/courses/store" enctype="multipart/form-data">
      @csrf
      <course-create-component :categories-list={{ $categories }} />
    </form>
  </div>
@endsection
