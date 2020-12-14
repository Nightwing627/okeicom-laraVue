@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>受講者ダッシュボード</h2>
            <div>
                <a class="" href="{{ route('mypage.u.attendance-lessons') }}">
                    {{ __('Menu Attendance Lesson') }}
                </a>
            </div>
            <div>
                <a class="" href="{{ route('mypage.u.messages') }}">
                    {{ __('Menu Messages') }}
                </a>
            </div>
            <div>
                <a class="" href="{{ route('mypage.u.profile') }}">
                    {{ __('Menu Profile') }}
                </a>
            </div>
            <div>
                <a class="" href="{{ route('mypage.u.creditcards') }}">
                    {{ __('Menu CreditCard') }}
                </a>
            </div>
            <div>
                <a class="" href="{{ route('mypage.u.index') }}">
                    {{ __('Menu Bank') }}
                </a>
            </div>
            <div>
                <a class="" href="{{ route('mypage.u.trade') }}">
                    {{ __('Menu Trade') }}
                </a>
            </div>
            <div>
                <a class="" href="{{ route('lessons.index') }}">
                    {{ __('Menu Search Lesson') }}
                </a>
            </div>
            <div>
                <a class="" href="{{ route('teachers.index') }}">
                    {{ __('Menu Search Teacher') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
