<template>
    <!-- モーダル -->
    <div class="lesson-add-modal" v-show="isLessonModal" @click.self="closeModal">
        <form method="POST" action="/mypage/t/lessons/store" enctype="multipart/form-data">
            <input type="hidden" name="_token" :value="csrf">
            <input type="hidden" name="courses_id" :value="course.id">
            <div class="lesson-add-modal-inner">
                <div class="l-content--detail">
                    <div class="l-content--detail__inner">
                        <div class="l-wrap--title">
                            <h1 class="c-headline--screen">レッスンを追加する</h1>
                            <button class="close-modal" @click="closeModal"><img src="/img/common/icon-batsu-white.png"></button>
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">タイトル</p>
                            <input type="text" name="title" v-model="lessonTitle" placeholder="タイトルを入力してください">
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">公開タイプ</p>
                            <ul class="u-pl10">
                                <li class="u-mb15">
                                    <div class="c-checkbox--fashonable">
                                        <label>公開
                                            <input type="radio" name="public" v-model="lessonPublic" value="0" :checked="true">
                                            <div class="color-box"></div>
                                        </label>
                                    </div>
                                </li>
                                <li class="u-mb15">
                                    <div class="c-checkbox--fashonable">
                                        <label>非公開
                                            <input type="radio" name="public" v-model="lessonPublic" value="1">
                                            <div class="color-box"></div>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">放送タイプ</p>
                            <ul class="u-pl10">
                                <li class="u-mb15">
                                    <div class="c-checkbox--fashonable">
                                        <label>生放送
                                            <input type="radio" name="type" v-model="lessonType" value="0" :checked="true" @change.prevent="changeType(1)">
                                            <div class="color-box"></div>
                                        </label>
                                    </div>
                                </li>
                                <li class="u-mb15">
                                    <div class="c-checkbox--fashonable">
                                        <label>動画埋め込み
                                            <input type="radio" name="url" v-model="lessonType" value="1" @change.prevent="changeType(2)">
                                            <div class="color-box"></div>
                                        </label>
                                    </div>
                                </li>
                                <li>
                                    <div class="c-checkbox--fashonable">
                                        <label>スライド
                                            <input type="radio" name="type" v-model="lessonType" value="2" @change.prevent="changeType(3)">
                                            <div class="color-box"></div>
                                        </label>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="l-content--input" v-if="isType != 3">
                            <p class="l-content--input__headline">動画URL</p>
                            <input type="text" name="url" v-model="lessonUrl" placeholder="https://www.youtube.com/">
                        </div>
                        <div class="l-content--input" v-if="isType === 3">
                            <p class="l-content--input__headline">スライドファイル（powerpoint）</p>
                            <input type="file" name="slide" @change="onImageUploaded" placeholder="スライドファイル" accept="application/vnd.openxmlformats-officedocument.presentationml.presentation,.pptx,application/vnd.ms-powerpoint,.ppt,.pot">
                        </div>
                        <!-- <div class="l-content--input">
                            <p class="l-content--input__headline">開催日時</p>
                            <vuejs-datepicker-component name="select_date" value=""></vuejs-datepicker-component>
                        </div> -->
                        <div class="l-content--input">
                            <div class="l-flex">
                                <div class="l-content--input__three u-w100per_sp u-mb21_sp">
                                    <div class="l-content--input__headline">開始日</div>
                                    <vuejs-datepicker-component
                                        name="date"
                                        :value="lessonDate"
                                        @input="val => lessonDate = val"
                                    ></vuejs-datepicker-component>
                                    <!-- <vuejs-datepicker-component
                                        name="select_date"
                                        v-model="lessonDate"
                                    ></vuejs-datepicker-component> -->
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
                            </div>
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">詳細</p>
                            <textarea
                                v-model="lessonDetail"
                                name="detail"
                            ></textarea>
                        </div>
                        <div class="l-content--input">
                            <div class="l-content--input__three">
                                <p class="l-content--input__headline">金額 <span class="u-text--small u-color--grayNavy">（半角数字のみ）</span></p>
                                <div class="accesary-yen">
                                    <input @input="validate" v-model="lessonPrice" type="text" name="price" placeholder="半角数字を入力してください">
                                </div>
                            </div>
                        </div>
                        <div class="l-content--input">
                            <div class="l-content--input__three">
                                <p class="l-content--input__headline">キャンセル手数料</p>
                                <div class="accesary-percent">
                                    <select v-model="lessonCancelRate" name="cancel_rate">
                                        <option v-for="(rate, index) in 100" :key="rate.id">{{ index }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="l-button--submit">
                            <!-- <button v-if="!changeModalEdit" type="button" @click="addLesson" class="c-button--square__pink" :disabled="checkLesson">レッスンを追加する</button> -->
                            <button v-if="!changeModalEdit" type="submit" class="c-button--square__pink" :disabled="checkLesson">レッスンを追加する</button>
                            <button v-else-if="changeModalEdit" type="button" @click="updateLesson" class="c-button--square__pink" :disabled="checkLesson">編集内容を保存する</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>



    <!-- 本文 -->
    <div class="l-wrap--main--inner">
        <div class="c-button--tab top-tab two-tab">
            <div class="c-button--tab--inner u-w400_pc">
                <div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '1'}" @click.prevent="changeTab('1')">コース詳細</div>
                <div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '2'}" @click.prevent="changeTab('2')">レッスン一覧</div>
            </div>
        </div>
        <!-- tab：コース詳細 -->
        <div class="c-list--table" v-if="isBarTab === '1'">
            <form method="POST" action="/mypage/t/courses/update" enctype="multipart/form-data">
            <!-- <form @submit.prevent="submitForm"> -->
                <input type="hidden" name="courses_id" :value="course.id">
                <input type="hidden" name="_token" :value="csrf">
                <!-- <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">URL</p>
                    </div>
                    <div class="c-list--td">
                        <input id="url" class="c-input--fixed" type="text" class="form-control" name="url" value="" readonly>
                    </div>
                </div> -->
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">画像</p>
                    </div>
                    <div class="c-list--td">
                        <select-image
                            :course="course"
                        ></select-image>
                        <!-- <ul class="couse-detail-img">
                            <li class="couse-detail-img-inner" v-for="(item, index) in couseDetailFiles" :key="index">
                                <div class="c-img--cover">
                                    <img :src="item.url" v-if="item.url !== ''">
                                    <span class="delete-file pc-only" :class="{active: item.isDelete}" @click="deleteFile(index)"></span>
                                    <span class="add-file" :class="{active: item.isAdd}">
                                        <input
                                            type="file"
                                            accept="image/*"
                                            :src="item.url"
                                            :name="'img' + (index + 1)"
                                            :id="'img' + (index + 1)"
                                            :ref="'file' + index"
                                            @change="uploadFile(index)"
                                        >
                                    </span>
                                </div>
                                <span class="change-file" :class="{active: item.isChange}">
                                    <span class="change-file-inner">
                                        <button @click.prevent="changeFile(index)">
                                            <img src="/img/common/icon-camera-black.png">
                                        </button>
                                    </span>
                                </span>
                                <span class="delete-icon sp-only" :class="{active: item.isDelete}" @click="deleteFile(index)">
                                    <img src="/img/common/icon-dust-black.png">
                                </span>
                            </li>
                        </ul> -->
                    </div>
                </div>
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">カテゴリー</p>
                    </div>
                    <div class="c-list--td">
                        <select-category
                            :course="course"
                            :categorieslists="categories_list"
                        ></select-category>
                        <!-- <select-list-category-component></select-category-list-component> -->
                        <!-- <ul class="c-list--category">
                            <li v-for="(category, index) in categories_list" :key="category.id">
                                <input class="non-check" name="categories[]" type="checkbox" :ref="'target_' + index" :checked="false" :value="category.id"><label>{{ category.name }}</label>
                            </li>
                        </ul> -->
                    </div>
                </div>
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">タイトル</p>
                    </div>
                    <div class="c-list--td">
                        <input requred name="title" :value="this.courseDate.title">
                    </div>
                </div>
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">詳細</p>
                    </div>
                    <div class="c-list--td">
                        <textarea name="detail" autocomplete="detail">{{ courseDate.detail }}</textarea>
                    </div>
                </div>
                <div class="l-button--submit">
                    <div class="l-button--submit--two">
                        <button type="submit" name="save" class="c-button--square__blue">保存する</button>
                    </div>
                    <div class="l-button--submit--two">
                        <button type="submit" name="delete" class="c-button--square__pink">削除する</button>
                    </div>
                </div>
            </form>
        </div>
        <!-- tab：その他 -->
        <div class="l-contentList__list__wrap" v-else-if="isBarTab === '2'">
            <div class="c-button--add c-list--courseLesson">
                <a @click="showModal">レッスンを追加する</a>
            </div>
            <div class="c-list--courseLesson" v-for="(lesson, index) in lessons" :key="index.id">
                <div class="c-list--courseLesson--num">
                    <span># {{ index + 1}}</span>
                </div>
                <div class="c-list--courseLesson--title">
                    <p class="title u-text--big u-mb5">{{ lesson.title }}</p>
                    <p class="date u-color--grayNavy u-text--small">{{ moment(lesson.date).format('M/D') }} {{ moment(lesson.start).format('H:mm') }}-{{ moment(lesson.finish).format('H:mm') }}</p>
                </div>
                <!-- 開催日を超えた現場は削除 -->
                <div class="c-button--edit">
                    <a class="c-button--edit--link delete">
                        <form method="POST" action="/mypage/t/lessons/delete">
                            <input type="hidden" name="_token" :value="csrf">
                            <input type="hidden" name="lesson_id" :value="lesson.id">
                            <input type="hidden" name="user_id" :value="lesson.user_id">
                            <input type="hidden" name="course_id" :value="lesson.course_id">
                            <button name="delete" type="submit">削除</button>
                        </form>
                    </a>
                    <!-- <a :href="'/mypage/t/lessons/edit/' + lesson.id" class="c-button--edit--link edit">編集</a> -->
                    <a :href="`/mypage/t/lessons/edit/${lesson.id}`" class="c-button--edit--link edit">編集</a>
                </div>
            </div>
            <!-- {{ courseDate.category1_id }} -->
        </div>
    </div>
</template>

<script>
    import axios from 'axios'
    import moment from "moment"
    import 'moment/locale/ja'
    import VueTimepicker from './../../components/common/Vue2TimepickerComponent.vue'
    import VuejsDatepickerComponent from "./../../components/common/VuejsDatepickerComponent.vue"
    import SelectCategory from './../../components/store/SelectListCategoryComponent.vue'
    import SelectImage from './../../components/store/SelectListImageComponent.vue'

	export default {
        components: {
            SelectCategory,
            SelectImage,
            'vue-timepicker': VueTimepicker,
            'vuejs-datepicker-component': VuejsDatepickerComponent,
            moment: moment
        },
        props: ['course', 'categories_list', 'lessons', 'csrf'],
		data() {
            return {
                // ライブラリ
                moment: moment,
                // propsのdata化
                courseDate: this.course,
                // categoriesDate: this.categories_list,
                lessonsDate: [],
                arrayCourseLessons: '',
                // 通常のdata
                isBarTab: '1',
                // [レッスン追加]
                checkLesson: true,        // レッスン
                isLessonModal: false,     // レッスンの有無
                changeModalEdit: false,   // 編集モデル
                isType: 1,
                startFormat: '00:00',
                finishFormat: '00:00',
                minInterval: 5,
                start: {
                    HH: '12',
                    mm: '00',
                },
                finish: {
                    HH: '12',
                    mm: '00',
                },
                // data-picker
                date : String(moment()),
                lessonPrice        : 0,
                // データ登録
                lessonTitle        : '', // <必須> タイトル
                lessonPublic       : 0,  // <必須> 公開・非公開
                lessonType         : 0,  // <必須> レッスンタイプ
                lessonUrl          : '', // URL
                lessonSlide        : '', // PDFファイル
                lessonDate         : moment(new Date).format('YYYY/MM/DD'), // <必須> 日付
                lessonStart        : '12:00', // <必須> 開始時刻
                lessonFinish       : '12:00', // <必須> 終了時刻
                lessonPrice        : 100,  // <必須> 金額
                lessonCancelRate   : 20,  // <必須> キャンセル手数料
                lessonDetail       : '', // 詳細
            }
        },
		created: function() {
            // 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義
            // 画像の初期設
            this.lessonsDate.push(this.lessons)

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
        mounted: function () {
        },
		computed: {
            // カテゴリーが5つ以上登録できないようにする
            checkCategoriesLimit: function() {}
        },
		methods: {
			// タブ色々
			changeTab: function(num){
				this.isBarTab = num
            },
            // コース画像
			setImage(e) {
                const files = this.$refs.file;
                const fileImg = files.files[0];
				if (fileImg.type.startsWith("image/")) {
					this.data.image = window.URL.createObjectURL(fileImg);
					this.data.name = fileImg.name;
					this.data.type = fileImg.type;
				}
			},
			// コース画像 - アップロード
			uploadFile: function(index) {
                // // ファイルを取得する
                const files = this.$refs['file' + index]
                const fileImg = files.files[0]
                const target = this.couseDetailFiles
                if (fileImg.type.startsWith("image/")) {
                    target[index].isAdd = false
                    target[index].isDelete = true
                    target[index].isChange = true
                    target[index].url = window.URL.createObjectURL(fileImg)
                    if (index < 4 && target[index+1].url == "" && target[index+1].isAdd == false) {
                        // 次の画像アップロード箇所追加
                        target[index+1].isAdd = true
                    }
                }
			},
			// コース画像 - 変更
			changeFile: function(index) {
                // 画像のアップロードを起動させる
                this.$refs['file' + index].click();
			},
			// コース画像 - 削除
			deleteFile: function(index) {
                const target = this.couseDetailFiles;
                // クリックした画像が最後の場合
                target[index].url = ""
                if(index == 4) {
                    target[index].url = ""
                    target[index].isAdd = true
                    target[index].isChange = false
                    target[index].isDelete = false
                } else {
                    // クリックした画像が最後以外の場合
                    // クリックした画像の次の画像がない場合
                    if(target[index+1].isAdd == true) {
                        target[index].url = ""
                        target[index].isAdd = true
                        target[index].isChange = false
                        target[index].isDelete = false
                        target[index+1].isAdd = false
                    } else {
                        // クリックした画像の次に画像がある場合
                        let t = 0;
                        for(t; t < 5; t++) {
                            target[index+t].url = target[index+t+1].url
                            if( target[index+t+1].isAdd == true ) break;
                        }
                        target[index+t].url = ""
                        target[index+t].isAdd = true
                        target[index+t].isChange = false
                        target[index+t].isDelete = false
                        if(target[index+t+1].isAdd == true) {
                            target[index+t+1].isAdd = false
                        }
                    }
                }
            },
            // レッスン追加 - モーダル表示
            showModal: function() {
                this.isLessonModal = true;
            },
            // レッスン追加 - モーダル非表示（入力情報を空にする）
            closeModal: function() {
                // 入力情報をリセットする
                this.lessonPublic      = 0;
                this.lessonType        = 0;
                this.lessonUrl         = '';
                this.lessonSlide       = '';
                this.lessonDate        = moment(new Date).format('YYYY/MM/DD');
                this.lessonStart       = '12:00';
                this.lessonFinish      = '12:00';
                this.lessonPrice       = 100;
                this.lessonCancel_rate = 10;
                this.lessonTitle       = '';
                this.lessonDetail      = '';
                // モーダルを閉じる
                this.isLessonModal = false;
                // 編集モーダルをfalseにする
                this.changeModalEdit = false;
            },
            // レッスン追加 - submit時
            addLesson: function() {
                // 日付をフォーマットの通りに変更する
                const momentDate = moment(this.lessonDate).format('YYYY/MM/DD');
                // courseLessonsデータに情報を保存する
                this.lessonsDate.push(...[
                    {
                        title           : this.lessonTitle,
                        public          : this.lessonPublic,
                        type            : this.lessonType,
                        url             : this.lessonUrl ? this.lessonUrl : null,
                        slide           : this.lessonSlide ? this.lessonSlide : null,
                        date            : momentDate,
                        start           : this.lessonStart,
                        finish          : this.lessonFinish,
                        price           : this.lessonPrice,
                        cancel_rate     : this.lessonCancelRate,
                        detail          : this.lessonDetail ? this.lessonDetail : null,
                    }
                ]),
                this.arrayCourseLessons = JSON.stringify(this.lessonsDate);
                // 入力情報をリセットする
                this.lessonPublic      = 0;
                this.lessonType        = 0;
                this.lessonUrl         = '';
                this.lessonSlide       = '';
                this.lessonDate        = moment(new Date).format('YYYY/MM/DD');
                this.lessonStart       = '12:00';
                this.lessonFinish      = '12:00';
                this.lessonPrice       = 100;
                this.lessonCancel_rate = 10;
                this.lessonTitle       = '';
                this.lessonDetail      = '';
                // レッスンモーダルを閉じる
                this.isLessonModal     = false;
                if(this.lessonsDate.length) {
                    this.checkStore = false;
                }
            },
            // レッスン更新
            updateLesson: function() {
                // 日付をフォーマットの通りに変更する
                const momentDate = moment(this.lessonDate).format('YYYY/MM/DD');
                // courseLessonsデータに情報を保存する
                this.lessonsDate.push(...[
                    {
                        title           : this.lessonTitle,
                        public          : this.lessonPublic,
                        type            : this.lessonType,
                        url             : this.lessonUrl,
                        slide           : this.lessonSlide,
                        date            : momentDate,
                        start           : this.lessonStart,
                        finish          : this.lessonFinish,
                        price           : this.lessonPrice,
                        cancel_rate     : this.lessonCancelRate,
                        detail          : this.lessonDetail,
                    }
                ]),
                // 入力情報をリセットする
                this.lessonPublic      = 0;
                this.lessonType        = 0;
                this.lessonUrl         = '';
                this.lessonSlide       = '';
                this.lessonDate        = moment(new Date).format('YYYY/MM/DD');
                this.lessonStart       = '12:00';
                this.lessonFinish      = '12:00';
                this.lessonPrice       = 100;
                this.lessonCancel_rate = 10;
                this.lessonTitle       = '';
                this.lessonDetail      = '';
                // モーダルを閉じる
                this.arrayCourseLessons = JSON.stringify(this.lessonsDate);
                this.isLessonModal = false;
                this.changeModalEdit = false;
            },
		},
        watch: {},
    }
</script>
