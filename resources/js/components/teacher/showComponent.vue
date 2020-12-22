<template>
	<div class="l-wrap--title profile">
		<div class="l-wrap">
			<div class="teacherDetail-profile">
				<div class="teacherDetail-profile-detail">
					<div class="c-img--shadow">
						<div class="c-img--cover c-img--round">
							<img src="/img/screen-top.jpg">
						</div>
					</div>
					
					<p class="u-text--big u-mb10">タイトル</p>
					<div class="c-text--evaluation u-mb5">
						<div class="star">
							<img src="/img/icon-star.png">
							<span class="evaluation">4.8</span>
						</div>
						<p class="review">レビュー 12件</p>
					</div>
					<ul class="c-text--category u-mb5">
						<li>書道</li>
						<li>バレエ</li>
					</ul>
					<div class="teacherDetail-profile-detail-tab u-mb10">
						<div class="tabBox"><span>国籍</span>日本</div>
						<div class="tabBox"><span>言語</span>日本語</div>
						<div class="tabBox"><span>都道府県</span>東京都</div>
					</div>
					<a href="" class="c-button--square__pink">メッセージを送る</a>
				</div>
				<div class="teacherDetail-profile-text">
					<p class="u-text--sentence">講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細講師詳細</p>
				</div>
			</div>
		</div>
	</div>
	<div class="l-wrap--body">
		<div class="l-wrap l-flex">
			<div id="sidebar" class="sidebar__tab">
				<div class="headline pc-only"><p>メニュー</p></div>
				<ul class="sidebar__list">
					<li v-bind:class="{'selected': isBarTab === '1'}"><a @click.prevent="changeTab('1')">レッスン一覧</a></li>
					<li v-bind:class="{'selected': isBarTab === '2'}"><a @click.prevent="changeTab('2')">口コミ</a></li>
				</ul>
			</div>



			<div class="l-wrap--main">
				<!-- tab：レッスン一覧 -->
				<div class="l-contentList__list__wrap" v-if="isBarTab === '1'">
					<div class="c-contentList__box" v-for="i in 10">
						<a class="c-contentList__box__inner" href="">
							<div class="c-contentList__box__img">
								<div class="c-img--cover">
									<img src="/public/img/screen-top.jpg">
								</div>
							</div>
							<div class="c-contentList__box__info">
								<div class="number l-flex">
									<p class="other">
										<span class="stage">第一回</span>
										<span class="date">2/12(金) 17:00-20:00</span>
									</p>
									<p class="price">￥3,000</p>
								</div>
								<p class="title">タイトルタイトルタイトルタイトルタイトルタイトル</p>
								<p class="detail pc-only">詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細詳細</p>
								<div class="category">
									<span>書道</span>
									<span>バレエ</span>
								</div>
							</div>
						</a>
					</div>
				</div>

				<!-- tab：口コミ -->
				<div class="l-list--review" v-else-if="isBarTab === '2'">
					<div class="l-content--review" v-for="i in 10">
						<div class="l-content--review--detail l-flex l-start">
							<div class="l-content--review--img u-mr20_pc u-mr10_sp">
								<div class="c-img--shadow">
									<div class="c-img--cover c-img--round">
										<img src="/public/img/screen-top.jpg">
									</div>
								</div>
							</div>
							<div class="l-content--review--text">
								<p class="u-mb5">TANAKA ATSUSHI</p>
								<div class="c-text--evaluation">
									<div class="star u-mr10">
										<img src="/public/img/icon-star.png">
										<span class="evaluation">4</span>
									</div>
									<span class="u-color--gray u-text--small">2020-12-13 23:00</span>
								</div>
								<div class="c-text--attention bg-gray u-mt15">
									<p>レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細レッスン詳細</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    import SidebarComponent from './../../components/common/sidebarComponent.vue'

	export default {
        components: {
            'sidebar-component': SidebarComponent,
        },
		data() {
			return {
				isBarTab: '1',
			}
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

		},
		computed: {},
		methods: {
			// 講師詳細のタブ切り替え
			changeTab: function(num){
				this.isBarTab = num
			},
		},
		watch: {},
	}
</script>