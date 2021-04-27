<template>
    <!-- モーダル -->
    <div class="lesson-add-modal" v-show="isLessonModal" @click.self="closeModal">
        <div class="lesson-add-modal-inner">
            <div class="l-content--detail">
                <div class="l-content--detail__inner">
                    <div class="l-wrap--title">
                        <h1 class="c-headline--screen" v-if="!changeModalEdit">レッスンを追加する</h1>
                        <h1 class="c-headline--screen" v-else-if="changeModalEdit">レッスンを編集する</h1>
                        <button class="close-modal" @click="closeModal"><img src="/img/common/icon-batsu-white.png"></button>
                    </div>
                    <div class="l-content--input">
                        <p class="l-content--input__headline">タイトル</p>
                        <input type="text" v-model="lessonTitle" placeholder="タイトルを入力してください">
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
                                        <input type="radio" v-model="lessonType" value="0" :checked="true" @change.prevent="changeType(1)">
                                        <div class="color-box"></div>
                                    </label>
                                </div>
                            </li>
                            <li class="u-mb15">
                                <div class="c-checkbox--fashonable">
                                    <label>動画埋め込み
                                        <input type="radio" v-model="lessonType" value="1" @change.prevent="changeType(2)">
                                        <div class="color-box"></div>
                                    </label>
                                </div>
                            </li>
                            <li>
                                <div class="c-checkbox--fashonable">
                                    <label>スライド
                                        <input type="radio" v-model="lessonType" value="2" @change.prevent="changeType(3)">
                                        <div class="color-box"></div>
                                    </label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="l-content--input" v-if="isType != 3">
                        <p class="l-content--input__headline">動画もしくはZOOM URL</p>
                        <input type="text" v-model="lessonUrl" placeholder="https://www.youtube.com/">
                    </div>
                    <div class="l-content--input" v-if="isType === 3">
                        <p class="l-content--input__headline">スライドファイル（powerpoint）</p>
                        <input type="file" @change="onImageUploaded" placeholder="スライドファイル" accept="application/vnd.openxmlformats-officedocument.presentationml.presentation,.pptx,application/vnd.ms-powerpoint,.ppt,.pot">
                    </div>
                    <!-- <div class="l-content--input">
                        <p class="l-content--input__headline">開催日時</p>
                        <vuejs-datepicker-component name="select_date" value=""></vuejs-datepicker-component>
                    </div> -->
                    <div class="l-content--input">
                        <div class="l-flex">
                            <div class="l-content--input__three u-w100per_sp u-mb21_sp">
                                <div class="l-content--input__headline">開始日</div>
                                <vuejs-datepicker-component :value="lessonDate" @input="val => lessonDate = val"></vuejs-datepicker-component>
                                <!-- <vuejs-datepicker-component
                                    name="select_date"
                                    v-model="lessonDate"
                                ></vuejs-datepicker-component> -->
                            </div>
                            <div class="l-content--input__three u-w49per_sp">
                                <div class="l-content--input__headline">開始時間</div>
                                <vue-timepicker
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
                        <textarea v-model="lessonDetail"></textarea>
                    </div>
                    <div class="l-content--input">
                        <div class="l-content--input__three">
                            <p class="l-content--input__headline">金額 <span class="u-text--small u-color--grayNavy">（半角数字のみ）</span></p>
                            <div class="accesary-yen">
                                <input @input="validate" v-model="lessonPrice" type="text" placeholder="半角数字を入力してください">
                            </div>
                        </div>
                    </div>
                    <div class="l-content--input">
                        <div class="l-content--input__three">
                            <p class="l-content--input__headline">キャンセル手数料</p>
                            <div class="accesary-percent">
                                <select v-model="lessonCancelRate">
                                    <option v-for="(rate, index) in 100" :key="rate.id">{{ index }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="l-button--submit">
                        <button v-if="!changeModalEdit" type="button" @click="addLesson" class="c-button--square__pink" :disabled="checkLesson">レッスンを追加する</button>
                        <button v-else-if="changeModalEdit" type="button" @click="updateLesson" class="c-button--square__pink" :disabled="checkLesson">編集内容を保存する</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- フォーム -->
    <!-- <form method="POST" action="{{ route('mypage.t.courses.create') }}" enctype="multipart/form-data"> -->
    <form method="POST" action="/mypage/t/courses/store" enctype="multipart/form-data">
        <input type="hidden" name="_token" :value="csrf">
        <input type="hidden" name="lessons" v-model="arrayCourseLessons">
        <div class="l-wrap--title">
            <a href="/mypage/t/courses" class="c-link--back u-mb5">コース一覧へ戻る</a>
            <h1 class="c-headline--screen">コースを作成する</h1>
        </div>
        <div class="l-wrap--body">
            <div class="l-wrap--main l-wrap--detail" v-show="page1">
                <div class="l-content--detail">
                    <div class="teacher-course-add-step">
                        <div class="teacher-course-add-step-panel now">
                            <span>ステップ１</span>
                            <p>コース情報を登録</p>
                        </div>
                        <div class="teacher-course-add-step-panel">
                            <span>ステップ２</span>
                            <p>レッスン情報を登録</p>
                        </div>
                    </div>
                </div>
                <div class="l-content--detail">
                    <div class="c-headline--block">詳細</div>
                    <div class="l-content--detail__inner">
                        <div class="l-content--input">
                            <p class="l-content--input__headline">タイトル</p>
                            <input
                                id="title"
                                name="title"
                                class="form-control"
                                type="text"
                                v-on:keyup="validationCheck"
                                v-model="course.title"
                                placeholder="タイトルを入力してください"
                            >
                            <p class="l-alart__text errorAlart" v-if="errors.title">{{ errors.title[0] }}</p>
                            <!-- <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title') }}" required autocomplete="title" autofocus placeholder="タイトルを入力してください"> -->
                        </div>
                        <div class="l-content--input">
                            <p class="l-content--input__headline">コース詳細</p>
                            <textarea
                                id="detail"
                                class="form-control"
                                name="detail"
                                v-model="course.detail"
                            >
                            </textarea>
                            <p class="l-alart__text errorAlart" v-if="errors.detail">{{ errors.detail[0] }}</p>
                            <!-- <textarea id="detail" class="form-control @error('detail') is-invalid @enderror" name="detail" required autocomplete="detail" cols="50" rows="10">{{ old('detail') }}</textarea> -->
                        </div>
                    </div>
                </div>
                <div class="l-content--detail">
                    <div class="c-headline--block">画像を選択</div>
                    <div class="l-content--detail__inner">
                        <select-image
                            @add="addImage"
                            @remove="removeImage"
                            :old="old"
                        ></select-image>
                    </div>
                </div>
                <div class="l-content--detail">
                    <div class="c-headline--block">カテゴリーを選択</div>
                    <div class="l-content--detail__inner">
                        <select-category
                            @addCategory="addCheckbox"
                            @reduceCategory="reduceCheckbox"
                            :categorieslists="categories_list"
                            :categories="old.categories"
                        ></select-category>
                    </div>
                </div>
            </div>
            <div class="l-wrap--main l-wrap--detail" v-show="page2">
                <div class="l-content--detail">
                    <div class="teacher-course-add-step">
                        <div class="teacher-course-add-step-panel">
                            <span>ステップ１</span>
                            <p>コース情報を登録</p>
                        </div>
                        <div class="teacher-course-add-step-panel now">
                            <span>ステップ２</span>
                            <p>レッスン情報を登録</p>
                        </div>
                    </div>
                </div>
                <div class="l-content--detail">
                    <!-- <teacher-course-relate-lesson-component></teacher-course-relate-lesson-component> -->
                    <div class="teacher-course-add-lesson">
                        <div class="c-button--add u-mb0 border-dashed">
                            <a @click="showModal" class="u-w100per u-textAlign__center">レッスンを追加</a>
                        </div>
                        <div class="teacher-course-add-lesson-list" v-for="(lesson, index) in courseLessons" :key="lesson.id">
                            <div class="teacher-course-add-lesson-list-detail">
                                <p class="date">{{ lesson.date }}　{{ lesson.start }}-{{ lesson.finish }}</p>
                                <p class="title">{{ lesson.title }}</p>
                            </div>
                            <div class="c-button--edit">
                                <a class="c-button--edit--link delete" @click="deleteLesson(index)">削除</a>
                                <a class="c-button--edit--link edit" @click="editLesson(index)">編集</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="l-button--submit" v-show="page1">
            <button class="c-button--square__pink" type="button" @click="nextPage" :disabled="checkNextStep">ステップ2に進む</button>
        </div>
        <div class="l-button--submit" v-show="page2">
            <div class="l-button--submit--two">
                <button type="button" class="c-button--square__pink" @click="backPage">ステップ1に戻る</button>
            </div>
            <div class="l-button--submit--two">
                <button type="submit" @click="registerCourse" name="save" class="c-button--square__pink" :disabled="checkStore">登録する</button>
            </div>
        </div>
    </form>
</template>
<script>
    // ajax通信
    import axios from "axios"
    // moment js
    import moment from "moment"
    import 'moment/locale/ja'
    // timepicker
    // import VueTimepicker from 'vue2-timepicker/src'
    import VueTimepicker from './../../components/common/Vue2TimepickerComponent.vue'
    // import VueTimepicker from 'vue3-timepicker'
    // datapicker
    import VuejsDatepickerComponent from "./../../components/common/VuejsDatepickerComponent.vue"
    // その他
    import SelectCategory from './../../components/store/SelectListCategoryComponent.vue';
    import SelectImage from './../../components/store/SelectListImageComponent.vue';

    // // `beforeDestroy` has been renamed to `beforeUnmount`修正
    // import { createApp } from 'vue'
    // import App from './../../components/App.vue'
    // import CKEditor from '@ckeditor/ckeditor5-vue'
    // const app = createApp( App )
    // app.use( CKEditor )
    // app.mount( '#app' )
    // watch method用

	export default {
        components: {
            SelectCategory,
            SelectImage,
            'vue-timepicker': VueTimepicker,
            'vuejs-datepicker-component': VuejsDatepickerComponent,
            moment: moment
        },
        props: [
            'course',
            'categories_list',
            'csrf',
            'old',
            'errors',
            'img1',
            'img2',
            'img3',
            'img4',
            'img5',
        ],
		data() {
            return {
                // [修正] page1 true / page2 false
                page1: true,
                page2: false,
                courseLessons: [],
                arrayCourseLessons: '',
                // courseLessons: [
                //     {public: 0 ,type: 0, url: 'https://wwww.yuotube.com', slide: '', date: '2020-12-31', start: '00:00:00', finish: '00:00:00', price: '300', cancel_rate: '30', title: 'title', detail: 'dtaildetaildtaildetaildtaildetail'},
                //     {public: 0 ,type: 0, url: 'https://wwww.yuotube.com', slide: '', date: '2020-12-31', start: '00:00:00', finish: '00:00:00', price: '300', cancel_rate: '30', title: 'title', detail: 'dtaildetaildtaildetaildtaildetail'},
                //     {public: 0 ,type: 0, url: 'https://wwww.yuotube.com', slide: '', date: '2020-12-31', start: '00:00:00', finish: '00:00:00', price: '300', cancel_rate: '30', title: 'title', detail: 'dtaildetaildtaildetaildtaildetail'},
                //     {public: 0 ,type: 0, url: 'https://wwww.yuotube.com', slide: '', date: '2020-12-31', start: '00:00:00', finish: '00:00:00', price: '300', cancel_rate: '30', title: 'title', detail: 'dtaildetaildtaildetaildtaildetail'},
                // ],
                // 次のステップへ
                checkNextStep: true,
                // [ステップ1]
                course : {
                    title: this.old.title ?? '', // タイトル
                    detail: this.old.detail ?? '', // 詳細
                    category: this.old.category ?? 0 // カテゴリー
                },
                // categoryValidation: 0,    // カテゴリー
                validationNumber: 0,
                // [ステップ2]
                checkStore: true,
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
                currendEditIndex   : null
            }
        },
		created: function() {
            // [ステップ1]のボタンのバリデーションチェック
            this.$watch(
                () => [this.$data.course.category, this.$data.course.title, this.validationNumber],
                // valueやoldValueの型は上で返した配列になる
                (value, oldValue) => {
                    console.log(value, oldValue)
                    if(this.course.category == 0 || this.course.title == '' || this.validationNumber == 0) {
                        this.checkNextStep = true;
                    } else if (this.course.category > 0 && !this.course.title == '' && this.validationNumber > 0) {
                        this.checkNextStep = false;
                    }
                }
            ),
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
        watch: {
        },
		methods: {
            // [ステップ1]
            // バリデーション：カテゴリーの値
            addCheckbox: function() {
                if (this.course.category  < 5) {
                    this.course.category += 1;
                }
            },
            reduceCheckbox: function() {
                this.course.category -= 1;
            },
            // バリデーション：画像の値
            addImage: function() {
                this.validationNumber += 1
            },
            removeImage: function() {
                this.validationNumber -= 1
            },
            // ステップ1の次へボタン
            nextPage: function() {
                window.scrollTo({
                    top: 0,
                })
                this.page1 = false
                this.page2 = true
            },

            // [ステップ2]
            // ステップ2の戻るボタン
            backPage: function() {
                window.scrollTo({
                    top: 0,
                })
                this.page1 = true
                this.page2 = false
            },
            // [レッスン追加]
			// 放送タイプを選択して、必要な情報を保存する
			changeType: function(type) {
                this.isType = type;
                this.lessonUrl = '';
                this.lessonSlide = '';
            },
            // 金額：半角数字のみのバリデーション
            validate: function() {
                this.lessonPrice = this.lessonPrice.replace(/\D/g, '')
            },
            // レッスンを追加する
            addLesson: function() {
                // 日付をフォーマットの通りに変更する
                const momentDate = moment(this.lessonDate).format('YYYY/MM/DD');
                // courseLessonsデータに情報を保存する
                this.courseLessons.push(...[
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
                this.arrayCourseLessons = JSON.stringify(this.courseLessons);
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
                if(this.courseLessons.length) {
                    this.checkStore = false;
                }
            },
            // レッスン編集画面表示
            editLesson: function(index) {
                this.currendEditIndex = index
                // 値がある場合は追加する
                this.lessonTitle        = this.courseLessons[index].title;
                this.lessonPublic       = this.courseLessons[index].public;
                this.lessonType         = this.courseLessons[index].type;
                this.lessonUrl          = this.courseLessons[index].url;
                this.lessonSlide        = this.courseLessons[index].slide;
                this.lessonDate         = this.courseLessons[index].date;
                this.lessonStart        = this.courseLessons[index].start;
                this.lessonFinish       = this.courseLessons[index].finish;
                this.lessonPrice        = this.courseLessons[index].price;
                this.lessonCancelRate   = this.courseLessons[index].cancel_rate;
                this.lessonDetail       = this.courseLessons[index].detail;
                // モーダルを表示
                this.changeModalEdit = true;
                this.isLessonModal = true;
            },
            // レッスンを更新する
            updateLesson: function() {
                // 日付をフォーマットの通りに変更する
                const momentDate = moment(this.lessonDate).format('YYYY/MM/DD');
                // courseLessonsデータに情報を保存する
                this.courseLessons[this.currendEditIndex] =
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
                    },
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
                this.arrayCourseLessons = JSON.stringify(this.courseLessons);
                this.isLessonModal = false;
                this.changeModalEdit = false;
            },
            // レッスンを削除する
            deleteLesson: function(index) {
                this.courseLessons.splice(index, 1);
                if(!this.courseLessons.length) {
                    this.checkStore = true;
                }
                this.arrayCourseLessons = JSON.stringify(this.courseLessons);
            },
            // モーダルを表示
            showModal: function() {
                this.isLessonModal = true;
            },
            // モーダルを非表示
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
            // レッスンスライドを追加する
            onImageUploaded(e) {
                // event(=e)から画像データを取得する
                const image = e.target.files[0]
                this.createImage(image)
            },
            createImage(image) {
                const reader = new FileReader()
                // imageをreaderにDataURLとしてattachする
                reader.readAsDataURL(image)
                // readAdDataURLが完了したあと実行される処理
                reader.onload = () => {
                    this.lessonSlide = reader.result
                }
            },
            // registerCourse: function() {
            //     const params = new URLSearchParams();
            //     params.append('user', 1);
            //     axios.post('/mypage/t/course/store', params)
            //         .then(result => {
            //             console.log('登録が完了しました。')
            //             location.href = '/mypage/t/courses'
            //         })
            //         .catch(result => {
            //             console.log('登録が失敗しました')
            //             location.href = '/mypage/t/courses/store'
            //             errorHandling.errorMessage(result)
            //         })
            // },
        },
    }
</script>
