<template>
	<div id="sidebar">
		<div class="headline pc-only"><p>カテゴリー</p></div>
		<ul class="sidebar__list sp-only" v-if="isActiveCategory">
			<li class="selected" v-if="selected_category==''" ><a v-bind:href="link">全て</a></li>
			<li  v-else ><a v-bind:href="link">全て</a></li>
			<li v-bind:class="[category.id === selected_category.id ? 'selected': '']" v-for="category in categories"><a v-bind:href="link + category.id" >{{ category.name }}</a></li>

		</ul>
		<ul class="sidebar__list pc-only">
			<li class="selected" v-if="selected_category==''" ><a v-bind:href="link">全て</a></li>
			<li  v-else ><a v-bind:href="link">全て</a></li>
			<li v-bind:class="[category.id === selected_category.id ? 'selected': '']"  v-for="category in categories" ><a v-bind:href="link + category.id">{{ category.name }}</a></li>

		</ul>
		<div class="c-openButton sp-only">
			<a @click.prevent="toggleActiveCategory">
				<span v-if="!isActiveCategory"><img src="/img/icon-arrow-down-blue.png">全てのカテゴリー一覧を見る</span>
				<span class="close" v-else="!isActiveCategory">閉じる</span>
			</a>
		</div>
	</div>
</template>
<script>
    export default {
		data(){
			return {

				isActiveCategory: false,
			}
		},
		methods: {
			// [SP]　カテゴリー一覧を表示させる
			toggleActiveCategory: function() {
				this.isActiveCategory = !this.isActiveCategory;
			},
		},
		props: {
            categories: Array,
            selected_category: Array,
            link: String,
       },
	}
</script>