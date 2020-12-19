@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>退会</h2>
            <p>退会した場合、以下のことができなくなってしまいます。</p>
            <ul>
                <li>契約済みのレッスンが見れなくなる</li>
                <li>現在保有しているポイントが返金されない</li>
                <li>レッスンの予約</li>
            </ul>
            <form method="POST" action="{{ route('mypage.u.withdrawal.store') }}">
                @csrf
                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            {{ __('Withdrawal') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
