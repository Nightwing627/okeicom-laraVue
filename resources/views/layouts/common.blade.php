<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("../common/head")
<body>
	<div id="app">
		<header-component></header-component>
		<main>
			@include("../common/breadcrumbs")
			<div class="l-wrap--title">
				<div class="l-wrap">
					<h1 class="c-headline--screen">@yield('title')</h1>
				</div>
			</div>
			<div class="l-wrap--body">
				<div class="l-wrap l-flex">
					@yield('content')
					@include("../common/sidebar-page")
				</div>
			</div>
			@include("../common/lead")
		</main>
	</div>
	@include("../common/footer")
</body>
</html>