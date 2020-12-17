@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <h2>メッセージ詳細</h2>
            <div class="col-12">
                @php
                    if(!$message_details->isEmpty()) {
                        $break_date = '';
                        foreach ($message_details as $message_detail) {
                            if($break_date != $message_detail->separate_hyphen_created_at) {
                                echo $message_detail->separate_hyphen_created_at;
                                echo '<hr>';
                            }
                            $break_date = $message_detail->separate_hyphen_created_at;

                            // 自分か相手かの判断方法↓ フロント実装後このコメントは削除してください
                            if($partner_users_id == $message_detail->user_send_id) {
                                echo '相手';
                            } else {
                                echo '自分';
                            }
                            echo '<p>' . $message_detail->users_name . ' ' . $message_detail->created_time . '</p>';
                            echo '<p>'. $message_detail->message_detail . '</p>';
                            if ($message_detail->file) {
                                echo '<p>'. $message_detail->public_path_file . '</p>';
                            }
                        }
                    } else {
                        echo 'メッセージはありません';
                    }
                @endphp

                @if(!$message_details->isEmpty())
                    <form method="POST" action="{{ route('mypage.u.messages.send') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="partner_users_id" name="partner_users_id" value="{{ $partner_users_id }}">

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
                                <label title="ファイル" class="@error('file') is-invalid @enderror btn btn-primary mr-2">
                                    <input type="file" accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.png,.jpeg,.jpg,.gif" id="file" name="file" style="display:none">
                                    ファイル
                                </label>
                                @error('file')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror

                                <button name="save" type="submit" class="btn btn-primary">
                                    送信
                                </button>
                            </div>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
