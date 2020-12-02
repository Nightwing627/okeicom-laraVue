@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">会員登録完了</div>

                    <div class="card-body">
                        <p>ご登録いただき、ありがとうございました。</p>
                        <a class="" href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
