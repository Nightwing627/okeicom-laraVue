@extends(($user_status == 0)?'layouts.user':'layouts.teacher')

{{-- タイトル・メタディスクリプション --}}
@section('title', 'メッセージ一覧')
@section('description', 'メッセージ一覧')

{{-- CSS --}}
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/userMessage.css') }}">
@endpush

{{-- 本文 --}}
@section('content')
    <div class="message-sidebar">
        @if(!$partner_users->isEmpty())
            @foreach($partner_users as $partner_user)
            <div class="message-user">
                <a href="{{ route('mypage.t.messages.detail', ['partner_users_id' => $partner_user->users_id]) }}">
                    <div class="message-sidebar-list-box l-flex l-v__top">
                        <div class="l-flex l-v__center">
                            <div class="u-w40"><span class="u-color--red">{{ $partner_user->is_all_read ? '既読' : '未読' }}</span></div>
                            <div class="u-w55">
                                <div class="message-sidebar-list-box-img">
                                    <div class="c-img--cover">
                                        <img src="/storage/profile/{{ $partner_user->users_img }}">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="u-wflex1">
                            <p class="u-text--big" >{{ $partner_user->users_name }}</p>
                            <p class="u-color--gray u-mt5" id = "{{ $partner_user->users_name }}">{{ Str::limit($partner_user->message_detail, 60) }}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        @else
            @if(Agent::isMobile())
                <p>メッセージはありません</p>
            @endif
        @endif
    </div>
    <script>
        var names = JSON.parse(localStorage.getItem("users"));
        function iterate(item) {
            document.getElementById(item).innerHTML = localStorage.getItem(item);
        }
        names.forEach(iterate);
    </script>
@endsection








{{--
@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @if(!$partner_users->isEmpty())
                @foreach($partner_users as $partner_user)
                    <div>
                        @if(Agent::isMobile())
                            <a class="" href="{{ route('mypage.u.messages.detail', ['partner_users_id' => $partner_user->users_id]) }}">
                                {{ $partner_user->is_all_read ? '既読' : '未読' }}<br>
                                {{ $partner_user->users_name }}
                                {{ $partner_user->users_img }}
                                {{ $partner_user->separate_hyphen_created_at }} {{ $partner_user->created_time }}<br>
                                {{ $partner_user->message_detail }}
                            </a>
                        @else
                            <a class="" href="{{ route('mypage.u.messages', ['partner_users_id' => $partner_user->users_id]) }}">
                                {{ $partner_user->users_name }}
                                {{ $partner_user->users_img }}
                            </a>
                        @endif
                    </div>
                @endforeach
            @else
                @if(Agent::isMobile())
                    <p>メッセージはありません</p>
                @endif
            @endif
        </div>
        @if(!Agent::isMobile())
            <div class="col-md-8">
                @php
                    if(!$partner_users->isEmpty()) {
                        $break_date = '';
                        foreach ($message_details as $message_detail) {
                            if($break_date != $message_detail->separate_hyphen_created_at) {
                                echo $message_detail->separate_hyphen_created_at;
                                echo '<hr>';
                            }
                            $break_date = $message_detail->separate_hyphen_created_at;

                            echo '<p>' . $message_detail->users_name . ' ' . $message_detail->created_time . '</p>';
                            echo '<p>'. $message_detail->message_detail . '</p>';
                            if ($message_detail->file1) {
                                echo '<p>'. $message_detail->public_path_file1 . '</p>';
                            }
                            if ($message_detail->file2) {
                                echo '<p>'. $message_detail->public_path_file2 . '</p>';
                            }
                            if ($message_detail->file3) {
                                echo '<p>'. $message_detail->public_path_file3 . '</p>';
                            }
                        }
                    } else {
                        echo 'メッセージはありません';
                    }
                @endphp

                @if(!$partner_users->isEmpty())
                    <form method="POST" action="{{ route('mypage.u.messages.send') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="partner_users_id" name="partner_users_id" value="{{ $message_details[0]->partner_users_id }}">

                        <div class="form-group row">
                            <div class="col-12">
                                <textarea id="message_detail" class="form-control @error('message_detail') is-invalid @enderror" name="message_detail" required cols="50" rows="5" placeholder="メッセージを入力"></textarea>

                                @error('message_detail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-3">
                                <label title="ファイル" class="btn btn-primary mr-2">
                                    <input type="file" id="message_file" name="message_file[]" accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.png,.jpeg,.jpg,.gif" style="display:none" multiple>
                                    ファイル(最大3つ)
                                </label>
                                @if ($errors->any())
                                    @foreach ($errors->get('message_file') as $message)
                                        <li>{{ $message }}</li>
                                    @endforeach
                                    @foreach ($errors->get('message_file.*') as $messages)
                                        @foreach ($messages as $message)
                                            <li>{{ $message }}</li>
                                        @endforeach
                                    @endforeach
                                @endif

                                <button name="save" type="submit" class="btn btn-primary">
                                    送信
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection
 --}}
