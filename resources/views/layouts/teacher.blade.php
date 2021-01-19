<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<!-- CSS -->
<body>
    <div id="app" class="login-user">
        <header-teacher-component></header-teacher-component>
        <main>
            <div class="l-wrap--body">
                
                <div class="l-wrap l-flex">

                    @unless(Request::is('mypage/t'))
                        @include("../common/sidebar-teacher")
                    @endunless
                    <div class="l-wrap--main">
                        <div class="l-wrap--title">
                            <p class="u-color--grayNavy u-text--small">講師管理画面</p>
                            <h1 class="c-headline--screen">@yield('title')</h1>
                        </div>
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
    @include("../common/footer-teacher")
</body>
</html>