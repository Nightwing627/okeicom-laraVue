<template>
	<modal-search v-show="searchShow" @from-child="closeSearch">
		<form action="">
			<div class="l-modal--search__input">
				<input class="c-input--gray" type="text">
			</div>
		</form>
	</modal-search>
	<header id="header">
		<div class="menu-user" :class="{'open': isMenuUser}">
			<div class="menu-user--inner">
				<div class="menu-user--change">
					<a href="" class="u-text--link">講師に切り替える</a>	
				</div>
				<ul class="menu-user--content">
					<li><a href="">受講レッスン</a></li>
					<li><a href="">メッセージ</a></li>
					<li><a href="">プロフィール</a></li>
					<li><a href="">クレジットカード情報</a></li>
					<li><a href="">銀行口座情報</a></li>
					<li><a href="">入出金管理</a></li>
				</ul>
				<ul class="menu-user--content">
					<li><a href="">レッスンを探す</a></li>
					<li><a href="">講師を探す</a></li>
					<li><a href="">ログアウト</a></li>
				</ul>
			</div>
		</div>
		<div class="l-flex">
			<div class="header__left l-flex l-v__center">
				<div class="header__logo">
					<img class="sp-only" src="/img/okeicom-logo-square.png">
					<img class="pc-only" src="/img/okeicom-logo-side.png">
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
							<img src="/public/img/icon-search-pink.png" alt="検索アイコン">
							<span>検索</span>
						</a>
					</li>
					<li>
						<a href="">
							<img src="/public/img/icon-chat-pink.png" alt="チャットアイコン">
							<span>チャット</span>
						</a>
					</li>
					<li>
						<a @click="openDrawer">
							<img src="/img/icon-header-menu-bold-pink.png" alt="ハンバーガーメニューアイコン">
							<span>メニュー</span>
						</a>
					</li>
					<li class="menu-profile">
						<a class="c-img--shadow" @click.prevent="toggleMenuUser">
							<div class="c-img--cover c-img--round">
								<img src="/img/screen-top.jpg" alt="メニューアイコン">
							</div>
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
				<div class="header__icon pc-only">
					<ul class="l-flex">
						<li>
							<a href="">
								<img src="/img/icon-chat-pink.png" alt="チャットアイコン">
								<span>チャット</span>
							</a>
						</li>
						<li class="menu-profile">
							<a class="c-img--shadow" @click.prevent="toggleMenuUser">
								<div class="c-img--cover c-img--round">
									<img src="/img/screen-top.jpg" alt="メニューアイコン">
								</div>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<nav-component></nav-component>
	</header>
</template>

<script>
	import NavComponent from './../../components/common/nav.vue'
	export default {
		components: {
			'nav-component': NavComponent,
		},
		data() {
			return {
				drawerActive: false,
				searchShow: false,
				isMenuUser: false,
			}
		},
		created: function() {
		    // 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義
		},
		computed: {},
		methods: {

			// 検索画面を開く
			openSearch: function() {
				this.searchShow = !this.searchShow
			},
			// 検索画面を閉じる
			closeSearch: function() {
				this.searchShow = false
			},
			// ドロワーを開く
			openDrawer: function() {
				this.drawerActive = true
			},
			// ドロワーを閉じる
			closeDrawer: function() {
				this.drawerActive = false
			},
			// ユーザーメニューを開く
			toggleMenuUser: function() {
				this.isMenuUser = !this.isMenuUser
			},
		},
		watch: {},
	}
</script>