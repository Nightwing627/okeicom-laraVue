<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<!-- CSS -->
<body>
    <div id="app">
        <header-teacher-component></header-teacher-component>
        <main>
            @yield('content')
        </main>
    </div>
    @include("../common/footer-teacher")
</body>
</html>