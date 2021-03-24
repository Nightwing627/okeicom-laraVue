<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<body>
	<div id="app" class="login-user @if(request()->is('*messages*')) l-message @endif">
		<header-user-component :csrf="{{json_encode(csrf_token())}}" user-img="{{ Auth::user()->img }}"></header-user-component>
		<main>
			@yield('content')
		</main>
	</div>
	@include("../common/footer-user")
</body>
</html>
