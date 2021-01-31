<template>

	<div class="l-wrap--title">
		<div class="l-wrap">
			<h1 class="c-headline--screen">講師一覧</h1>
		</div>
	</div>
	<div class="l-wrap--body">
		<div class="l-wrap l-flex">
			<sidebar-component :categories=categories :link="link" :selected_category=selected_category> </sidebar-component>
			<!-- <?php require_once($_SERVER['DOCUMENT_ROOT'] . '/resources/views/common/sidebar.php'); ?> -->
			<div class="l-wrap--main">
				<div class="l-contentList__list__headline l-flex">
					<div class="headlineContent info">
						<h2 class="title" v-if="selected_category==''">全てのカテゴリーから検索結果一覧を表示</h2>
						<h2 class="title" v-else>{{ selected_category.name }}から検索結果一覧を表示</h2>
						<p class="number">{{ count }}件中 {{ start }}-{{ end }}件を表示</p>
					</div>
					<div class="headlineContent sort l-flex l-v__center">
						<span>並び替え</span>
						<div class="c-selectBox">
							<select class="c-input--gray" onchange="chgOrder()" id="order">
								<option value="0" selected v-if="order=='0'">新着順</option>
								<option value="0" v-else>新着順</option>
								<option value="1" selected v-if="order=='1'">評価が高い順</option>
								<option value="1" v-else>評価が高い順</option>
							</select>
						</div>
					</div>
				</div>
				<div class="l-list--teacher">
					<div class="l-list--teacher__tab three-tab">
						<a v-bind:href="'/teachers'" v-if="selected_category==''">
							<div class="tab-box selected" v-if="sex==''">全て</div>
							<div class="tab-box" v-else>全て</div>
						</a>
						<a v-bind:href="'/teachers/category/'+selected_category.id" v-else>
							<div class="tab-box selected" v-if="sex==''">全て</div>
							<div class="tab-box" v-else>全て</div>
						</a>
						<a v-bind:href="'/teachers?sex=1'" v-if="selected_category==''">
							<div class="tab-box selected" v-if="sex==1">男性</div>
							<div class="tab-box"  v-else>男性</div>
						</a>
						<a v-bind:href="'/teachers/category/'+selected_category.id+'?sex=1'" v-else>
							<div class="tab-box selected" v-if="sex==1">男性</div>
							<div class="tab-box"  v-else>男性</div>
						</a>
						<a v-bind:href="'/teachers?sex=2'" v-if="selected_category==''">
							<div class="tab-box selected" v-if="sex==2">女性</div>
							<div class="tab-box" v-else>女性</div>
						</a>
						<a v-bind:href="'/teachers/category/'+selected_category.id+'?sex=2'" v-else>
							<div class="tab-box selected" v-if="sex==2">女性</div>
							<div class="tab-box" v-else>女性</div>
						</a>
					</div>
					<div class="l-content--teacher l-flex" v-for="user in users" >
						<div class="u-w100">
							<div class="c-img--round c-img--cover"  v-if="user.img!=null">
								<img v-bind:src="'/storage/courses/' + user.img">
							</div>
						</div>
						<div class="u-wflex1 u-pl10">
							<p class="u-text--big u-mb10"><span class="c-text--sex man u-mr10" v-if="user.sex==1">男性</span><span class="c-text--sex woman u-mr10" v-if="user.sex==2">女性</span><a v-bind:href="'/teachers/detail/'+user.id">{{ user.name }}</a></p>
							<div class="c-text--evaluation">
								<div class="star">
									<img src="/img/common/icon-star.png">
									<span class="evaluation">{{ user.ave }}</span>
								</div>
								<p class="review">レビュー {{ user.count }}件</p>
							</div>
							<ul class="c-text--category u-mt10">
								<li v-if="user.cat1!=null">{{ user.cat1 }}</li>
								<li v-if="user.cat2!=null">{{ user.cat2 }}</li>
								<li v-if="user.cat3!=null">{{ user.cat3 }}</li>
								<li v-if="user.cat4!=null">{{ user.cat4 }}</li>
								<li v-if="user.cat5!=null">{{ user.cat5 }}</li>
							</ul>
							<p class="u-text--sentence u-mt10 pc-only">{{ user.profile }}</p>
						</div>
					</div>
				</div>
				<div class="l-pagenation">

					<ul class="l-pagenation__list">
						<li v-for="i in page_cnt" v-bind:class="[i === page ? 'selected': '']">
                            <a v-bind:href="'/teachers?sex=' + sex + '&page=' + i" v-if="selected_category==''">{{ i }}</a>
                            <a v-bind:href="'/teachers/category/'+selected_category.id+'?sex=' + sex + '&page=' + i" v-else>{{ i }}</a>
						</li>
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
			return {
		      link: '/teachers/category/',
		    };
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

		},
		computed: {

		},
		methods: {},
		watch: {},
		props: {
            users: Object,
            categories: Array,
            count: String,
            pager: String,
            sex: Number,
            selected_category: Array,
            order: Number,
            page: Number,
            start: Number,
            end: Number,
            page_cnt: Number,
          },
	}
</script>
