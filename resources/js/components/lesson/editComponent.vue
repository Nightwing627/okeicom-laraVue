<template>
    <div class="l-modal" :class="{open: isParticipantDetail}" @click.self="openDetail">
        <div class="l-modal--wrap">
            <div class="close-button">
                <span class="close-icon" @click.prevent="openDetail"><img src="/img/common/icon-batsu-white.png"></span>
            </div>
            <div class="l-modal--wrap--inner" v-if="currentUser">
                <div class="l-modal--content">
                    <div class="l-modal--header">
                        <div class="l-modal--header--img">
                            <div class="c-img--cover c-img--round">
                                <img :src="'/storage/profile/' + currentUser.img">
                            </div>
                        </div>
                        <div class="l-modal--header--button">
                            <ul>
                                <li class="message"><a :href="`/mypage/t/messages/${ currentUser.user_id }`">メッセージを送る</a></li>
                                <li class="reject"><a @click="remove()">参加を拒否する</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="l-modal--content">
                    <div class="l-modal--name">
                        <p class="sub">アカウント名</p>
                        <p class="main">{{ currentUser.name }}</p>
                    </div>
                </div>
                <div class="l-modal--detail">
                    <div class="l-modal--detail--box l-modal--content">
                        <p class="sub">性別</p>
                        <p class="main">
                            <span v-if="currentUser.sex == 0">不明</span>
                            <span v-if="currentUser.sex == 1">男性</span>
                            <span v-if="currentUser.sex == 2">女性</span>
                        </p>
                    </div>
                    <!-- <div class="l-modal--detail--box l-modal--content">
                        <p class="sub">年齢</p>
                        <p class="main">{{ currentUser.age }}歳</p>
                    </div> -->
                    <div class="l-modal--detail--box l-modal--content">
                        <p class="sub">都道府県</p>
                        <p class="main">{{ currentUser.pref ?? '未設定' }}</p>
                    </div>
                </div>
                <div class="l-modal--content border-none">
                    <div class="l-modal--profile">
                        <p class="sub">プロフィール</p>
                        <p class="main">{{ currentUser.profile ?? '未設定' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="l-wrap--main--inner">
        <div class="c-button--tab top-tab two-tab">
            <div class="c-button--tab--inner u-w400_pc">
                <div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '1'}" @click.prevent="changeTab('1')">レッスン詳細</div>
                <div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '2'}" @click.prevent="changeTab('2')">参加者一覧</div>
            </div>
        </div>
        <!-- tab：レッスン詳細 -->
        <!-- <div class="c-list--table" v-if="isBarTab === '1'"> -->
        <div class="c-list--table" v-if="isBarTab === '1'">
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">タイトル</p>
                </div>
                <div class="c-list--td">
                    <input type="text" name="title" placeholder="タイトルを入力してください" v-model="lessonTitle">
                </div>
            </div>
            <!-- case：放送タイプが動画埋め込みの場合 -->
            <div class="c-list--tr" v-if="this.lesson.type === 0 || 1">
                <div class="c-list--th">
                    <p class="main">URL</p>
                </div>
                <div class="c-list--td">
                    <input type="text" name="url" placeholder="https://www.youtube.com/" v-model="lessonUrl">
                </div>
            </div>
            <!-- case：放送タイプがスライドの場合 -->
            <div class="c-list--tr" v-if="this.lesson.type === 2">
                <div class="c-list--th">
                    <p class="main">スライドファイル（powerpoint）</p>
                </div>
                <div class="c-list--td">
                    <input type="file" name="slide" placeholder="スライドファイル" accept="application/vnd.openxmlformats-officedocument.presentationml.presentation,.pptx,application/vnd.ms-powerpoint,.ppt">
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">開催日時</p>
                </div>
                <div class="c-list--td">
                    <div class="l-flex">
                        <div class="l-content--input__three u-w100per_sp u-mb21_sp">
                            <div class="l-content--input__headline">開始日</div>
                            <vuejs-datepicker-component
                                name="date"
                                :value="lessonDate"
                                @input="val => lessonDate = val"
                            ></vuejs-datepicker-component>
                        </div>
                        <div class="l-content--input__three u-w49per_sp">
                            <div class="l-content--input__headline">開始時間</div>
                            <vue-timepicker
                                name="start"
                                hour-label="時間"
                                minute-label="分"
                                :value="lessonStart"
                                @input="val => lessonStart = val"
                                :minute-interval="5"
                            ></vue-timepicker>
                        </div>
                        <div class="l-content--input__three u-w49per_sp">
                            <div class="l-content--input__headline">終了時間</div>
                            <vue-timepicker
                                name="finish"
                                hour-label="時間"
                                minute-label="分"
                                :value="lessonFinish"
                                @input="val => lessonFinish = val"
                                :minute-interval="5"
                            >
                            </vue-timepicker>
                        </div>
                        <!-- <div class="l-content--input__two">
                            <div class="l-content--input__headline">開始時間</div>
                            <vue-timepicker
                                hour-label="時間"
                                minute-label="分"
                                :value="lessonStart"
                                @input="val => lessonStart = val"
                                :minute-interval="5"
                            ></vue-timepicker>

                        </div>
                        <div class="l-content--input__two">
                            <div class="l-content--input__headline">終了時間</div>

                            <vue-timepicker
                                hour-label="時間"
                                minute-label="分"
                                :value="lessonFinish"
                                @input="val => lessonFinish = val"
                                :minute-interval="5"
                            >
                            </vue-timepicker>
                        </div> -->
                    </div>
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">詳細</p>
                </div>
                <div class="c-list--td">
                    <textarea
                        v-model="lessonDetail"
                        name="detail"
                    ></textarea>
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">金額</p>
                </div>
                <div class="c-list--td">
                    <div class="accesary-yen l-content--input__three">
                        <input @input="validate" v-model="lessonPrice" type="text" name="price" placeholder="半角数字を入力してください">
                    </div>
                    <!-- <input type="" name="" placeholder="半角数字を入力してください"> -->
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">キャンセル手数料</p>
                </div>
                <div class="c-list--td">
                    <div class="c-selectBox u-w100">
                        <!-- <select>
                            <option v-for="item in 100">{{item}}%</option>
                        </select> -->
                        <select v-model="lessonCancelRate" name="cancel_rate">
                            <option v-for="(rate, index) in 100" :key="rate.id">{{ index }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="l-button--submit">
                <button type="submit" class="c-button--square__pink" :disabled="checkLesson">変更内容を保存する</button>
                <!-- <input type="subit" name="" value="変更内容を保存する" class="c-button--square__pink"> -->
            </div>
        </div>
        <!-- tab：参加者一覧 -->
        <div class="l-contentList__list__wrap"  v-if="isBarTab === '2'">
            <div class="c-list--courseLesson" v-for="(application, index) in applications">
                <div class="c-list--courseLesson--num">
                    <div class="c-img--round c-img--cover">
                        <img v-bind:src="'/storage/profile/' + application.img">
                    </div>
                </div>
                <div class="c-list--courseLesson--title u-pl10">
                    <p class="title u-text--big u-mb5">{{ application.name }}</p>
                    <p class="date u-color--grayNavy u-text--small">{{ datetotime(application.created_at) }}</p>
                </div>
                <!-- 開催日を超えた現場は削除 -->
                <div class="c-button--edit">
                    <a class="c-button--edit--link edit" @click.prevent="openDetail(application)">詳細</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    import moment from "moment"
    import 'moment/locale/ja'
    import { datetotime } from '../library/filters.ts'

    import VueTimepicker from './../../components/common/Vue2TimepickerComponent.vue'

    import VuejsDatepickerComponent from "./../../components/common/VuejsDatepickerComponent.vue"
	export default {
        props: {
            lesson: {
                type: Object
            },
            // users: {
            //     type: [Object]
            // },
            applications: {
                type: Array
            },
        },
		components: {
            'vue-timepicker': VueTimepicker,
            'vuejs-datepicker-component': VuejsDatepickerComponent,
		},
		data() {
			return {
                isBarTab: '1',
                // 参加者詳細モーダル
                isParticipantDetail: false,
                currentUser: null,
                lessonCancelRate: '',
                checkLesson: true,
                // レッスン情報を代入
                lessonTitle      : this.lesson.title ?? '',
                lessonUrl        : this.lesson.url ?? '',
                lessonDetail     : this.lesson.detail ?? '',
                lessonDate       : this.lesson.date ?? '',
                lessonStart      : moment(this.lesson.start).format() ?? '',
                lessonFinish     : moment(this.lesson.finish).format() ?? '',
                lessonPrice      : this.lesson.price ?? '',
                lessonCancelRate : this.lesson.cancel_rate ?? '',
            }
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

            // [レッスン追加]ボタンのバリデーションチェック
            this.$watch(
                () => [this.$data.lessonTitle, this.$data.lessonDate, this.$data.lessonStart, this.$data.lessonFinish, this.$data.lessonPrice, this.$data.lessonCancelRate],
                (type, date, start, finish, price, cancel, title) => {
                    if(!this.lessonTitle == '' && !this.lessonDate == '' && !this.lessonStart == '' && !this.lessonFinish == '' && !this.lessonPrice == '' && !this.lessonCancelRate == '') {
                        this.checkLesson = false;
                    } else {
                        this.checkLesson = true;
                    }
                }
            )
        },
        setup () {
            return {
                datetotime
            }
        },
		computed: {},
		methods: {
            changeTab(tab) {
                this.isBarTab = tab
            },
            // 参加者詳細モーダル
			openDetail: function(currentUser) {
                this.isParticipantDetail =! this.isParticipantDetail
                this.currentUser = currentUser
			},
            remove() {
                axios.post('/mypage/t/block-application', {userId: this.currentUser.id, lessonId: this.lesson.id})
                    .then(result => {
                        location.reload();
                    })
                    .catch(result => {
                    })
            }
        },
		watch: {},
	}
</script>
