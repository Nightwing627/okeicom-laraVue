<template>
	<div class="l-wrap--title">
		<div class="l-wrap">
			<h1 class="c-headline--screen">講師一覧</h1>
		</div>
	</div>
	<div class="l-wrap--body">
		<div class="l-wrap l-flex">
			<sidebar-component></sidebar-component>
			<!-- <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/resources/views/common/sidebar.php'); ?> -->
			<div class="l-wrap--main">
				
				<div class="l-contentList__list__headline l-flex">
					<div class="headlineContent info">
						<h2 class="title">全てのカテゴリーから検索結果一覧を表示</h2>
						<p class="number">1,000件中 1-20件を表示</p>
					</div>
					<div class="headlineContent sort l-flex l-v__center">
						<span>並び替え</span>
						<div class="c-selectBox">
							<select class="c-input--gray">
								<option>新着順</option>
								<option>開催日が近い順</option>
								<option>参加者が多い順</option>
								<option>評価が高い順</option>
								<option>料金が安い順</option>
							</select>
						</div>
					</div>
				</div>
				<div class="l-list--teacher">
					<!-- <div class="l-list--teacher__tab three-tab">
						<div class="tab-box selected">全て</div>
						<div class="tab-box">男性</div>
						<div class="tab-box">女性</div>
					</div> -->
					<div class="l-content--teacher l-flex" v-for="i in 10">
						<div class="u-w100">
							<div class="c-img--round c-img--cover">
								<img src="/img/screen-top.jpg">
							</div>
						</div>
						<div class="u-wflex1 u-pl10">
							<p class="u-text--big u-mb10"><span class="c-text--sex woman u-mr10">女性</span>佐藤 真衣</p>
							<div class="c-text--evaluation">
								<div class="star">
									<img src="/img/icon-star.png">
									<span class="evaluation">4.8</span>
								</div>
								<p class="review">レビュー 12件</p>
							</div>
							<ul class="c-text--category u-mt10">
								<li>書道</li>
								<li>バレエ</li>
							</ul>
							<p class="u-text--sentence u-mt10 pc-only">ああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああああ</p>
						</div>
					</div>
				</div>
				<div class="l-pagenation">
					<ul class="l-pagenation__list">
						<li class="selected" v-for="i in 10"><a>１</a></li>
					</ul>
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
			return {}
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

		},
		computed: {},
		methods: {},
		watch: {},
	}
</script>