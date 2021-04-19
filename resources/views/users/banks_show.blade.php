@extends((Auth::user()->status == 0)?'layouts.user':'layouts.teacher')

{{--  タイトル・メタディスクリプション  --}}
@section('title', '銀行情報')
@section('description', '銀行情報')

{{--  CSS  --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/dashboard.css') }}">
@endpush

{{--  JS  --}}
@push('js')
@endpush

{{--  本文  --}}
@section('content')
    {{--  エラーメッセージ  --}}
    @if ($errors->any())
        <div class="l-alart errorAlart" role="alert">
            @foreach ($errors->all() as $error)
            <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    {{--  ゆうちょ銀行  --}}
	<div class="c-list--table">
        @if($target === 0)
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">金融機関名</p>
                </div>
                <div class="c-list--td">
                    <p>ゆうちょ銀行</p>
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">口座記号</p>
                </div>
                <div class="c-list--td">
                    <p>@if(isset($bankDate->mark))  {{ $bankDate->mark }}  @endif</p>
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">口座番号</p>
                </div>
                <div class="c-list--td">
                    <p>@if(isset($bankDate->number)) {{ $bankDate->number }} @endif</p>
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">口座名義人</p>
                </div>
                <div class="c-list--td">
                    <p>@if(isset($bankDate->name)) {{ $bankDate->name }} @endif</p>
                </div>
            </div>
        @elseif($target === 1)
            {{--  その他銀行  --}}
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">金融機関名</p>
                </div>
                <div class="c-list--td">
                    <p>@if(isset($bankDate->name)) {{ $bankDate->name }} @endif</p>
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">支店名</p>
                </div>
                <div class="c-list--td">
                    <p>@if(isset($bankDate->branch_name)) {{ $bankDate->branch_name }} @endif</p>
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">支店番号</p>
                </div>
                <div class="c-list--td">
                    <p>@if(isset($bankDate->branch_number)) {{ $bankDate->branch_number }} @endif</p>
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">預金種目</p>
                </div>
                <div class="c-list--td">
                    <p>@if($bankDate->type == 0)普通@elseif($bankDate->type == 1)当座@endif</p>
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">口座番号</p>
                </div>
                <div class="c-list--td">
                    <p>@if(isset($bankDate->number)) {{ $bankDate->number }} @endif</p>
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">口座名義人</p>
                </div>
                <div class="c-list--td">
                    <p>@if(isset($bankDate->name)) {{ $bankDate->name }} @endif</p>
                </div>
            </div>
        @endif
    </div>
    <div class="l-button--submit">
        @if(Auth::user()->status == 0)
            <a class="c-button--square__pink" href="{{ route('mypage.u.bank.edit') }}">銀行情報を変更する</a>
        @elseif(Auth::user()->status == 1)
            <a class="c-button--square__pink" href="{{ route('mypage.t.bank.edit') }}">銀行情報を変更する</a>
        @endif
    </div>
@endsection
