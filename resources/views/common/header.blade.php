<modal-search v-show="searchShow" @from-child="closeSearch">
	<form action="">
		<div class="l-modal--search__input">
			<input class="c-input--gray" type="text">
		</div>
	</form>
</modal-search>
<header id="header">
	<div class="l-flex">
		<div class="header__left l-flex l-v__center">
			<div class="header__logo">
				<img class="sp-only" src="{{ asset('/img/okeicom-logo-square.png') }}" alt="">
				<img class="pc-only" src="{{ asset('/img/okeicom-logo-side.png') }}">
			</div>
			<nav class="header__menu pc-only">
				<ul class="l-flex">
					<li><a href="">レッスン一覧</a></li>
					<li><a href="">講師一覧</a></li>
				</ul>
			</nav>
		</div>
		<div class="header__right l-flex l-v__center">
			<ul class="header__icon l-flex l-v__bottom sp-only">
				<li>
					<a @click="openSearch">
						<img src="{{ asset('/img/icon-header-search-bold.png') }}" alt="検索アイコン">
						<span>検索</span>
					</a>
				</li>
				<li>
					<a href="">
						<img src="{{ asset('/img/icon-header-add-bold.png') }}" alt="登録アイコン">
						<span>新規登録</span>
					</a>
				</li>
				<li>
					<a href="">
						<img src="{{ asset('/img/icon-header-login-bold.png') }}" alt="ログインアイコン">
						<span>ログイン</span>
					</a>
				</li>
				<li>
					<a @click="openDrawer">
						<img src="{{ asset('/img/icon-header-menu-bold.png') }}" alt="ハンバーガーメニューアイコン">
						<span>メニュー</span>
					</a>
				</li>
			</ul>
			<div class="header__search pc-only">
				<form class="l-flex">
					<div class="header__search__text">
						<input class="c-input--gray" type="text" name="" placeholder="キーワードを入力">
					</div>
					<div class="header__search__submit">
						<input type="submit" name="" value="検索">
					</div>
				</form>
			</div>
			<div class="header__link pc-only">
				<ul class="l-flex">
					<li class="header__link__register"><a href="">会員登録</a></li>
					<li class="header__link__login"><a href="">ログイン</a></li>
				</ul>
			</div>
		</div>
	</div>
	@include("../common/nav")
</header>