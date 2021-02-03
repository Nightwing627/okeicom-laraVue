<template>
	<div class="c-button--tab top-tab two-tab">
		<div class="c-button--tab--inner u-w400_pc">
			<div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '1'}" @click.prevent="changeTab('1')">受講予定</div>
			<div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '2'}" @click.prevent="changeTab('2')">受講済み</div>
		</div>
	</div>
	<!-- tab：受講予定 -->
	<div class="l-contentList__list__wrap" v-if="isBarTab === '1'">
        <div class="c-contentList__box" v-for="(lesson, index) in this.lessonlistsDate['data']" :key="index">
			<a class="c-contentList__box__inner" :href="`/lessons/detail/${lesson.id}`">
				<div class="c-contentList__box__img">
					<div class="c-img--cover">
						<img src="/img/common/screen-top.jpg">
					</div>
				</div>
				<div class="c-contentList__box__info">
					<div class="number l-flex">
						<p class="other">
							<span class="stage">第回</span>
							<span class="date">{{ moment(lesson.date).format('M/D') }}({{ moment(lesson.date).format('ddd') }}) {{ moment(lesson.start).format('H:mm') }}-{{ moment(lesson.finish).format('H:mm') }}</span>
						</p>
						<p class="price">¥{{ lesson.price.toLocaleString() }}</p>
					</div>
					<p class="title">{{ lesson['title'] }}</p>
					<p class="detail pc-only">{{ lesson['detail'] }}</p>
					<div class="category">
                        <span v-if="lesson.category1_name">{{ lesson.category1_name }}</span>
                        <span v-if="lesson.category2_name">{{ lesson.category2_name }}</span>
                        <span v-if="lesson.category3_name">{{ lesson.category3_name }}</span>
                        <span v-if="lesson.category4_name">{{ lesson.category4_name }}</span>
                        <span v-if="lesson.category5_name">{{ lesson.category5_name }}</span>
					</div>
				</div>
			</a>
		</div>
	</div>
	<!-- tab：受講済み -->
	<!-- <div class="l-contentList__list__wrap" v-else-if="isBarTab === '2'">
		<div class="c-contentList__box" v-for="(lesson, index) in this.lessonLists" :key="lesson.id">
			<a class="c-contentList__box__inner" href="">
				<div class="c-contentList__box__img">
					<div class="c-img--cover">
						<img src="/img/common/screen-top.jpg">
					</div>
				</div>
				<div class="c-contentList__box__info">
					<div class="number l-flex">
						<p class="other">
							<span class="stage">第二回</span>
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
	</div> -->
</template>
<script>
    import moment from "moment";
    import 'moment/locale/ja';

	export default {
        components: {
        },
        // props: ['appstatus', 'lessons'],
        props: ['appstatus', 'lessonlists'],
		data() {
			return {
                isBarTab: '1',
                moment: moment,
                // status: this.appstatuss,
                lessonlistsDate: this.lessonlists,
                statusDate: this.appstatus,
			}
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

        },
        mounted: function() {
            console.log(this.lessonlistsDate)
        },
		computed: {},
		methods: {
			// 講師詳細：
			changeTab: function(num){
				this.isBarTab = num
			},
		},
		watch: {},
	}
</script>
