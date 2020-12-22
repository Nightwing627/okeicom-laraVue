<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<body>
    <div id="app">
        <header-component></header-component>
        <main>
            @yield('content')
        </main>
    </div>
    @include("../common/footer-single")
</body>
</html>