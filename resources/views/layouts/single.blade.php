<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<body>
    <div id="app" class="login-user @if(request()->is('*messages*')) l-message @endif">

        @if(Auth::user())
            @if( Auth::user()->status == 0 )
                <header-user-component logout="{{ route('logout') }}" :csrf="{{ json_encode(csrf_token()) }}" user-img="{{ Auth::user()->img }}"></header-user-component>
            @elseif( Auth::user()->status == 1 )
                <header-teacher-component teacherlink="1" logout="{{ route('logout') }}" :csrf="{{ json_encode(csrf_token()) }}" user-img="{{ Auth::user()->img }}"></header-teacher-component>
            @endif
        @else
            <header-component :csrf="{{ json_encode(csrf_token()) }}"></header-component>
        @endif
        <main>
            @yield('content')
        </main>
    </div>
    @include("../common/footer-single")
</body>
</html>
