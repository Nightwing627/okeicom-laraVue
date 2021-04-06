<template>
    <div class="l-modal" :class="{open: isParticipantDetail}" @click.self="openDetail">
        <div class="l-modal--wrap">
            <div class="close-button">
                <span class="close-icon" @click.prevent="openDetail"><img src="/public/img/icon-batsu-white.png"></span>
            </div>
            <div class="l-modal--wrap--inner" v-if="currentUser">
                <div class="l-modal--content">
                    <div class="l-modal--header">
                        <div class="l-modal--header--img">
                            <div class="c-img--cover c-img--round">
                                <img  v-bind:src="'/storage/profile/' + currentUser.img">
                            </div>
                        </div>
                        <div class="l-modal--header--button">
                            <ul>
                                <li class="message"><a href="">メッセージを送る</a></li>
                                <li class="reject"><a href="">参加を拒否する</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="l-modal--content">
                    <div class="l-modal--name">
                        <p class="sub">アカウント名</p>
                        <p class="main">{{currentUser.name}}</p>
                    </div>
                </div>
                <div class="l-modal--detail">
                    <div class="l-modal--detail--box l-modal--content">
                        <p class="sub">性別</p>
                        <p class="main">{{currentUser.sex == 0 ? "男性"　: "女性" }}</p>
                    </div>
                    <div class="l-modal--detail--box l-modal--content">
                        <p class="sub">年齢</p>
                        <p class="main">{{currentUser.age}}歳</p>
                    </div>
                    <div class="l-modal--detail--box l-modal--content">
                        <p class="sub">都道府県</p>
                        <p class="main">北海道</p>
                    </div>
                </div>
                <div class="l-modal--content border-none">
                    <div class="l-modal--profile">
                        <p class="sub">プロフィール</p>
                        <p class="main">{{currentUser.profile}}</p>
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
                    <input type="" name="" placeholder="タイトルを入力してください">
                </div>
            </div>
            <!-- case：放送タイプが動画埋め込みの場合 -->
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">URL</p>
                </div>
                <div class="c-list--td">
                    <input type="" name="" placeholder="https://www.youtube.com/">
                </div>
            </div>
            <!-- case：放送タイプがスライドの場合 -->
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">スライドファイル（powerpoint）</p>
                </div>
                <div class="c-list--td">
                    <input type="file" name="" placeholder="スライドファイル" accept="application/vnd.openxmlformats-officedocument.presentationml.presentation,.pptx,application/vnd.ms-powerpoint,.ppt">
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">開催日時</p>
                </div>
                <div class="c-list--td">
                    <div class="l-flex">
                        <div class="l-content--input__two">
                            <div class="l-content--input__headline">開始時間</div>
                            <div class="l-flex l-start">
                                <div class="l-content--input__two u-w100_pc">
                                    <select>
                                        <option v-for="item in 24">{{item - 1}}</option>
                                    </select>
                                </div>
                                <div class="l-content--input__two u-w100_pc">
                                    <select>
                                        <option v-for="item in 60">{{item - 1}}</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="l-content--input__two">
                            <div class="l-content--input__headline">終了時間</div>
                            <div class="l-flex l-start">
                                <div class="l-content--input__two u-w100_pc">
                                    <select>
                                        <option v-for="item in 24">{{item - 1}}</option>
                                    </select>
                                </div>
                                <div class="l-content--input__two u-w100_pc">
                                    <select>
                                        <option v-for="item in 24">{{item - 1}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">詳細</p>
                </div>
                <div class="c-list--td">
                    <textarea></textarea>
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">金額</p>
                </div>
                <div class="c-list--td">
                    <input type="" name="" placeholder="半角数字を入力してください">
                </div>
            </div>
            <div class="c-list--tr">
                <div class="c-list--th">
                    <p class="main">キャンセル手数料</p>
                </div>
                <div class="c-list--td">
                    <div class="c-selectBox u-w100">
                        <select>
                            <option v-for="item in 100">{{item}}%</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="l-button--submit">
                <input type="subit" name="" value="変更内容を保存する" class="c-button--square__pink">
            </div>
        </div>
        <!-- tab：その他 -->
        <div class="l-contentList__list__wrap"  v-if="isBarTab === '2'">
            <div class="c-list--courseLesson" v-for="user in users">
                <div class="c-list--courseLesson--num">
                    <div class="c-img--round c-img--cover">
                        <img v-bind:src="'/storage/profile/' + user.img">
                    </div>
                </div>
                <div class="c-list--courseLesson--title u-pl10">
                    <p class="title u-text--big u-mb5">{{user.name}}</p>
                    <p class="date u-color--grayNavy u-text--small">10/20(土) 12:00</p>
                </div>
                <!-- 開催日を超えた現場は削除 -->
                <div class="c-button--edit">
                    <a class="c-button--edit--link edit" @click.prevent="openDetail(user)">詳細</a>
                </div>
            </div>
        </div>
    </div>
</template>
<script>

	export default {
        props: {
            lesson: {
                type: Object
            },
            users: {
                type: [Object]
            },
        },
		components: {
		},
		data() {
			return {
                isBarTab: '1',
                // 参加者詳細モーダル
                isParticipantDetail: false,
                currentUser: null,
            }
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

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
			}
        },
		watch: {},
	}
</script>
