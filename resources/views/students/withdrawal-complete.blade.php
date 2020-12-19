@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>退会完了</h2>
            <p>退会完了しました！</p>
            <p>引き続き、おけい.comをお楽しみくださいませ！</p>
            <a class="" href="{{ route('home') }}">
                トップページに戻る
            </a>
        </div>
    </div>
</div>
@endsection
