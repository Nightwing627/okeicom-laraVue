<template>
    <div class="l-wrap--title">
        <div class="l-wrap">
            <h1 class="c-headline--screen">レッスン一覧</h1>
            <p>{{ lessons.length }}</p>
            <p>{{ categories.length }}</p>
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
                            <a class="c-contentList__box__inner" href="">
                                <div class="c-contentList__box__img">
                                    <div class="c-img--cover">
                                        <img src="/img/screen-top.jpg">
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
                                    <div class="teacher l-flex l-start l-v__center pc-only">
                                        <div class="teacherImg">
                                            <div class="teacherImgInner c-img--round c-img--cover">
                                                <img src="/img/screen-top.jpg">
                                            </div>
                                        </div>
                                        <div class="teacherEvaluation">
                                            <img src="/img/icon-star.png">
                                            <span class="evaluationNumber">4.8</span>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                    <div class="l-pagenation">
                        <ul class="l-pagenation__list">
                            <li class="selected"><a>１</a></li>
                            <li v-for="i in 9"><a href=""></a></li>
                        </ul>
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
        props:['lessons', 'categories'],
        data() {
            return {

            }
        },
        created: function() {
            // 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義
        },
        computed: {},
        methods: {},
        watch: {},
    }

</script>
