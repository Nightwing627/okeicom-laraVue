<template>
	<div id="sidebar">
        <form :action="path">

            <input type="hidden" v-if="target" :value="target" name="is_target">
            <div class="headline pc-only"><p>カテゴリー</p></div>
            <ul class="sidebar__list sp-only" v-if="isActiveCategory">
                <!-- <li v-if="selected_category==''" class="selected" ><a v-bind:href="link">全て</a></li>
                <li v-else><a v-bind:href="link">全て</a></li> -->
                <!-- <li v-bind:class="[category.id === selected_category.id ? 'selected': '']" v-for="category in categories">
                    <a v-bind:href="link + category.id" >{{ category.name }}</a>
                </li> -->
                <li v-for="category in categories">
                    <!-- <a :href="path + '/categories?categories_id=' + category.id">{{ category.name }}</a> -->
                    <button name="categories_id" :value="category.id">
                        {{ category.name }}
                    </button>
                </li>
            </ul>
            <ul class="sidebar__list pc-only">
                <!-- <li class="selected" v-if="selected_category==''" ><a v-bind:href="link">全て</a></li>
                <li v-else><a v-bind:href="link">全て</a></li> -->
                <!-- <li v-bind:class="[category.id === selected_category.id ? 'selected': '']" v-for="category in categories">
                    <a v-bind:href="link + category.id">{{ category.name }}</a>
                </li> -->
                <li v-for="category in categories" :class="[ category.id == this.nowCategory ? 'selected' : '' ]">
                    <button name="categories_id" :value="category.id">
                        {{ category.name }}
                    </button>
                    <!-- <a :href="path + '/categories?categories_id=' + category.id">{{ category.name }}</a> -->
                </li>
            </ul>
            <div class="c-openButton sp-only">
                <a @click.prevent="toggleActiveCategory">
                    <span v-if="!isActiveCategory"><img src="/img/common/icon-arrow-down-blue.png">全てのカテゴリー一覧を見る</span>
                    <span class="close" v-else="!isActiveCategory">閉じる</span>
                </a>
            </div>
        </form>
	</div>
</template>

<script>
    export default {
        props: ['categories', 'categories_id', 'path', 'target'],
		data(){
			return {
				isActiveCategory: false,
                nowCategory: this.categories_id,
			}
		},
		// props: {
        //     categories: Array,
        //     selected_category: Array,
        //     link: String,
        // },
        mounted: function () {},
		methods: {
			// [SP]　カテゴリー一覧を表示させる
			toggleActiveCategory: function() {
				this.isActiveCategory = !this.isActiveCategory;
			},
        },
	}
</script>
