@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>キャンセルリクエスト一覧</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('mypage.t.cancel.do') }}">
                @csrf

                @foreach($cancels as $cancel)
                    <input type="checkbox" id="cancels" name="cancels[]" value="{{ $cancel->id }}">
                    <p>
                        {{ $cancel->created_at }}
                    </p>
                    <p>
                        {{ $cancel->users_name }}
                        {{ $cancel->users_img }}
                    </p>
                    レッスン <a class="" href="{{ route('lessons.detail', ['id' => $cancel->lessons_id]) }}">{{ route('lessons.detail', ['id' => $cancel->lessons_id]) }}</a>
                    <p>
                        キャンセル理由<br>
                        {{ $cancel->reason }}
                    </p>
                    <hr>
                @endforeach

                <div class="form-group row mb-0">
                    <div class="col-md-3 offset-md-4">
                        <button name="save" type="submit" class="btn btn-primary">
                            {{ __('Approval') }}
                        </button>
                    </div>
                    <div class="col-md-3">
                        <button name="delete" type="submit" class="btn btn-primary">
                            {{ __('Denial') }}
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
