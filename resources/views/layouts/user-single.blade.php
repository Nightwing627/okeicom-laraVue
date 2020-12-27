<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<body>
	{{-- <div id="app" class="login-user"> --}}
	<div id="app">
		<header-user-component></header-user-component>
		{{-- @include("../common/header-user") --}}
		<main>
			@yield('content')
		</main>
	</div>
	@include("../common/footer-user")
</body>
</html>