@extends(($user_status == 0)?'layouts.user-single':'layouts.teacher-single')

<!-- タイトル・メタディスクリプション -->
@section('title', 'レッスン予約 | おけいcom')
@section('description', 'おけいcomのレッスン予約ページです。')

<!-- CSS -->
@push('css')
<link rel="stylesheet" href="{{ asset('/css/foundation/single/lessonApplication.css') }}">
@endpush

<!-- 本文 -->
@section('content')
    <div class="l-wrap--single">
        <div class="l-wrap--title">
            <a class="c-link--back u-mb5" href="' . $_SERVER['HTTP_REFERER'] . '">レッスン詳細へ戻る</a>
            <h1 class="c-headline--screen">レッスンを予約する</h1>
        </div>
        <div class="l-wrap--body">
            <div class="l-wrap--main l-wrap--detail">
                <div class="l-content--detail">
                    <div class="c-headline--block">レッスン詳細</div>
                    <div class="l-content--detail__inner l-flex_pc u-pb10_sp">
                        <p class="u-text--big u-mb5_sp">{{ $lesson->separate_comma_price }}</p>
                        <p class="u-text--big">{{ $lesson->date_slash }}({{ $lesson->week }}) {{ $lesson->separate_hyphen_time}}</p>
                    </div>
                    <div class="l-content--detail__inner l-flex">
                        <div class="u-w30per">
                            <div class="c-img--cover">
                                <img src="/storage/courses/{{ $courseImg }}">
                            </div>
                        </div>
                        <div class="u-w70per u-pl15">
                            <p class="c-text--title">{{ $lesson->title }}</p>
                            <p class="c-text--detail pc-only">{{ $lesson->detail}}</p>
                        </div>
                    </div>
                </div>
                <!-- <div class="l-content--detail">
                    <div class="c-headline--block">決済方法</div>
                    <div class="l-content--detail__inner">
                        <ul class="paymentList">
                            <li class="paymentBox">
                                <label>
                                    クレジットカード決済
                                    <input type="radio" name="payment">
                                    <div class="paymentBoxColor"></div>
                                </label>
                                <p class="paymentBoxOther"><a href="" class="u-text--link">別のクレジットカードで決済する</a></p>
                            </li>
                            <li class="paymentBox">
                                <label>
                                    銀行振込
                                    <input type="radio" name="payment">
                                    <div class="paymentBoxColor"></div>
                                </label>
                            </li>
                        </ul>
                    </div>
                </div> -->
                <div class="l-content--detail">
                    <div class="c-headline--block">レッスン料金</div>
                    <div class="l-content--detail__inner">
                        <p class="c-text--title u-textAlign__right u-mb10 u-w100per">合計 {{ $lesson->separate_comma_price }}</p>
                        {{--
                        <table class="lesson-application--sum">
                            <tr>
                                <td>レッスン代金：</td>
                                <td>¥12,000</td>
                            </tr>
                            <tr>
                                <td>クーポン：</td>
                                <td>-¥3,000</td>
                            </tr>
                        </table>
                        --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="l-button--confirm">
            <div class="l-button--confirm__inner">
                <input type="checkbox" name="">
                <label><a href="" class="u-text--link">キャンセルポリシー</a>に同意する</label>
            </div>
        </div>
        <div class="l-button--submit">
            <input class="c-button--square__pink" type="subit" name="" value="決済する">
        </div>
    </div>
@endsection
