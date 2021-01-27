@extends('layouts.user')

<!-- タイトル・メタディスクリプション -->
@section('title', 'ダッシュボード')
@section('description', '受講者ダッシュボード')

<!-- CSS -->
@push('css')
@endpush

<!-- 本文 -->
@section('content')
    <user-lesson-component></user-lesson-component>
@endsection


{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a class="" href="{{ route('mypage.u.attendance-lessons', ['applications_status' => 0]) }}">
                @if($applications_status == 1)@else●@endif 受講予定
            </a>
            <a class="" href="{{ route('mypage.u.attendance-lessons', ['applications_status' => 1]) }}">
                @if($applications_status == 1)●@endif 受講済み
            </a>

            @foreach($lessons as $lesson)
                <p>
                    {{ $lesson->kanji_number }}
                    {{ $lesson->add_week_date }}
                    {{ $lesson->separate_hyphen_time }}
                    {{ $lesson->separate_comma_price }}
                </p>
                <a class="" href="{{ route('lessons.detail', ['id' => $lesson->id]) }}">
                    {{ $lesson->title }}
                </a>
                <p>{{ $lesson->detail }}</p>
                <p>{{ $lesson->category1_name }} {{ $lesson->category2_name }} {{ $lesson->category3_name }}</p>
                <p>{{ $lesson->user_name }}</p>
                <hr>
            @endforeach
            {{ $lessons->links('vendor.pagination.simple-tailwind') }}
        </div>
    </div>
</div>
@endsection --}}
