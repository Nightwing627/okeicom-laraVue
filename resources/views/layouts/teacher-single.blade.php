<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<!-- CSS -->
<body>
    <div id="app" class="login-user @if(request()->is('*messages*')) l-message @endif">
        <header-teacher-component :csrf="{{json_encode(csrf_token())}}" user-img="{{ Auth::user()->img }}"></header-teacher-component>
        <main>
            @yield('content')
        </main>
    </div>
    @include("../common/footer-teacher")
</body>
</html>
