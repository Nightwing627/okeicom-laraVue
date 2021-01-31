<template>
	<div class="l-screen">
		<div class="l-screen__title">
			<div class="l-allWrapper">
				<h1 class="headline">検索結果一覧</h1>
			</div>
		</div>
		<div class="l-searchResult">
			<div class="l-allWrapper">
				<div class="l-searchResult__wrap l-flex">
					<div class="c-searchResult__block tab l-flex l-v__center">
						<ul class="c-tab">
							<li class="c-tab--button selected"><a>レッスンから選択</a></li>
							<li class="c-tab--button"><a>先生から検索</a></li>
						</ul>
					</div>
					<div class="c-searchResult__block input l-flex l-v__center">
						<form>
							<div class="c-searchResult__block__inner l-flex">
								<div class="searchText">
									<input
                                        type="text"
                                        :value="keyword"
                                        @input="$emit('input', $event.target.keyword)"
                                    >
								</div>
								<div class="searchDate pc-only">
									<vue-datapicker-lite></vue-datapicker-lite>
								</div>
								<div class="searchSubmit pc-only">
									<input type="submit" name="" value="検索">
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="l-contentList">
		<div class="l-allWrapper">
			<div class="l-contentList__wrap l-flex">
				<sidebar-component></sidebar-component>
				<div class="l-contentList__list">
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
					<div class="l-contentList__list__wrap">
						<div class="c-contentList__box" v-if="lessons.length" v-for="(lesson,index) of lessons" :key="index.id">
							<a class="c-contentList__box__inner">
								<div class="c-contentList__box__img">
									<div class="c-img--cover">
										<img src="/img/common/screen-top.jpg">
									</div>
								</div>
								<div class="c-contentList__box__info">
									<!-- <div class="number l-flex">
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
									</div> -->
									<div class="number l-flex">
										<p class="other">
											<span class="stage">第{{ lesson.number }}回</span>
											<span class="date">{{ moment(lesson.date).format('M/D') }}({{ moment(lesson.date).format('ddd') }}) {{ moment(lesson.start).format('H:mm') }}-{{ moment(lesson.finish).format('H:mm') }}</span>
										</p>
										<p class="price">¥{{ lesson.price.toLocaleString() }}</p>
									</div>
									<p class="title">{{ lesson.title }}</p>
									<p class="detail pc-only">{{ lesson.detail }}</p>
									<div class="category">
										<span>書道</span>
										<span>バレエ</span>
									</div>
									<div class="teacher l-flex l-start l-v__center pc-only">
										<div class="teacherImg">
											<div class="teacherImgInner c-img--round c-img--cover">
												<img src="/img/common/screen-top.jpg">
											</div>
										</div>
										<div class="teacherEvaluation">
											<img src="/img/common/icon-star.png">
											<span class="evaluationNumber">4.8</span>
										</div>
									</div>
								</div>
							</a>
						</div>
						<div class="c-contentList__box" v-if="!lessons.length">レッスンがありません。</div>
					</div>
					<div class="l-pagenation">
						<ul class="l-pagenation__list">
							<li class="selected" v-for="i in 10">
								<a href="">1</a>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import SidebarComponent from './../../components/common/sidebarComponent.vue';
    import DatepickerLite from "vue3-datepicker";
    import axios from 'axios';
    import moment from "moment";
    import 'moment/locale/ja';

	export default {
		components: {
			'sidebar-component': SidebarComponent,
			'vue-datapicker-lite': DatepickerLite,
		},
        props:['lessons', 'keyword'],
        // props: {
        //     keyword : VueTypes.string,                   // 受け取ったキーワード
        //     lessons : VueTypes.shape({                   // 受け取ったレッスンの配列
        //         number : VueTypes.unsignedTinyInteger,
        //         date   : VueTypes.date,
        //         price  : VueTypes.unsignedInteger,
        //         title  : VueTypes.string,
        //         detail : VueTypes.string,
        //     }),
        // },
		data() {
			return {
                moment: moment,
            }
		},
		computed: {},
		watch: {},
        filters: {},
        setup() {
            // 時間を出力する
            function changeToTime(time) {
                if(!time) return ''
                return moment(time).format('HH:mm');
            }
            // 日付を出力する
            function changeToDate(date) {
                if(!date) return ''
                return moment(date).format('M/DD')
            }
            // 3桁毎にカンマをつける
            function priceNumber(price) {
                if (!price) return ''
                return price.toLocaleString()
            }
        },
        updated: function() {
        },
		created: function() {
        },
        moutend: function() {
        },
		methods: {},
	};
</script>
