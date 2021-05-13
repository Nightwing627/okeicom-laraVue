<template>
  <div class="l-content--detail">
    <div class="teacher-course-add-lesson">
      <div class="c-button--add u-mb0 border-dashed">
        <a
          class="u-w100per u-textAlign__center"
          @click="showModal"
        >
          レッスンを追加
        </a>
      </div>
      <div
        v-for="(lesson, index) in courseLessons"
        :key="lesson.id"
        class="teacher-course-add-lesson-list"
      >
        <div class="teacher-course-add-lesson-list-detail">
          <p class="date">
            {{ lesson.date }}{{ lesson.start }}-{{ lesson.finish }}
          </p>
          <p class="title">
            {{ lesson.title }}
          </p>
        </div>
        <div class="c-button--edit">
          <a
            class="c-button--edit--link delete"
            @click="deleteLesson(index)"
          >
            削除
          </a>
          <a
            class="c-button--edit--link edit"
            @click="editLesson(index)"
          >
            編集
          </a>
        </div>
      </div>
    </div>
  </div>
  <div
    v-show="isLessonModal"
    class="lesson-add-modal"
    @click.self="closeModal"
  >
    <div class="lesson-add-modal-inner">
      <div class="l-content--detail">
        <div class="l-content--detail__inner">
          <div class="l-wrap--title">
            <h1
              v-if="!changeModalEdit"
              class="c-headline--screen"
            >
              レッスンを追加する
            </h1>
            <h1
              v-else-if="changeModalEdit"
              class="c-headline--screen"
            >
              レッスンを編集する
            </h1>
            <button
              class="close-modal"
              @click="closeModal"
            >
              <img src="/img/common/icon-batsu-white.png">
            </button>
          </div>
          <div class="l-content--input">
            <p class="l-content--input__headline">
              タイトル
            </p>
            <input
              v-model="lessonTitle"
              type="text"
              placeholder="タイトルを入力してください"
            >
          </div>
          <div class="l-content--input">
            <p class="l-content--input__headline">
              公開タイプ
            </p>
            <ul class="u-pl10">
              <li class="u-mb15">
                <div class="c-checkbox--fashonable">
                  <label>公開
                    <input
                      v-model="lessonPublic"
                      type="radio"
                      name="public"
                      value="0"
                      :checked="true"
                    >
                    <div class="color-box" />
                  </label>
                </div>
              </li>
              <li class="u-mb15">
                <div class="c-checkbox--fashonable">
                  <label>非公開
                    <input
                      v-model="lessonPublic"
                      type="radio"
                      name="public"
                      value="1"
                    >
                    <div class="color-box" />
                  </label>
                </div>
              </li>
            </ul>
          </div>
          <div class="l-content--input">
            <p class="l-content--input__headline">
              放送タイプ
            </p>
            <ul class="u-pl10">
              <li class="u-mb15">
                <div class="c-checkbox--fashonable">
                  <label>生放送
                    <input
                      v-model="lessonType"
                      type="radio"
                      value="0"
                      :checked="true"
                      @change.prevent="changeType(1)"
                    >
                    <div class="color-box" />
                  </label>
                </div>
              </li>
              <li class="u-mb15">
                <div class="c-checkbox--fashonable">
                  <label>動画埋め込み
                    <input
                      v-model="lessonType"
                      type="radio"
                      value="1"
                      @change.prevent="changeType(2)"
                    >
                    <div class="color-box" />
                  </label>
                </div>
              </li>
              <li>
                <div class="c-checkbox--fashonable">
                  <label>スライド
                    <input
                      v-model="lessonType"
                      type="radio"
                      value="2"
                      @change.prevent="changeType(3)"
                    >
                    <div class="color-box" />
                  </label>
                </div>
              </li>
            </ul>
          </div>
          <div
            v-if="isType != 3"
            class="l-content--input"
          >
            <p class="l-content--input__headline">
              動画もしくはZOOM URL
            </p>
            <input
              v-model="lessonUrl"
              type="text"
              placeholder="https://www.youtube.com/"
            >
          </div>
          <div
            v-if="isType === 3"
            class="l-content--input"
          >
            <p class="l-content--input__headline">
              スライドファイル（powerpoint）
            </p>
            <input
              type="file"
              placeholder="スライドファイル"
              accept="application/vnd.openxmlformats-officedocument.presentationml.presentation,.pptx,application/vnd.ms-powerpoint,.ppt,.pot"
              @change="onImageUploaded"
            >
          </div>
          <div class="l-content--input">
            <div class="l-flex">
              <div class="l-content--input__three u-w100per_sp u-mb21_sp">
                <div class="l-content--input__headline">
                  開始日
                </div>
                <vue-datepicker
                  :value="lessonDate"
                  @input="val => lessonDate = val"
                />
                <!-- <vuejs-datepicker-component
                    name="select_date"
                    v-model="lessonDate"
                ></vuejs-datepicker-component> -->
              </div>
              <div class="l-content--input__three u-w49per_sp">
                <div class="l-content--input__headline">
                  開始時間
                </div>
                <vue-timepicker
                  hour-label="時間"
                  minute-label="分"
                  :value="lessonStart"
                  :minute-interval="5"
                  @input="val => lessonStart = val"
                />
              </div>
              <div class="l-content--input__three u-w49per_sp">
                <div class="l-content--input__headline">
                  終了時間
                </div>
                <vue-timepicker
                  hour-label="時間"
                  minute-label="分"
                  :value="lessonFinish"
                  :minute-interval="5"
                  @input="val => lessonFinish = val"
                />
              </div>
            </div>
          </div>
          <div class="l-content--input">
            <p class="l-content--input__headline">
              詳細
            </p>
            <textarea v-model="lessonDetail" />
          </div>
          <div class="l-content--input">
            <div class="l-content--input__three">
              <p class="l-content--input__headline">
                金額
                <span class="u-text--small u-color--grayNavy">
                  （半角数字のみ
                </span>
              </p>
              <div class="accesary-yen">
                <input
                  v-model="lessonPrice"
                  type="text"
                  placeholder="半角数字を入力してください"
                  @input="validate"
                >
              </div>
            </div>
          </div>
          <div class="l-content--input">
            <div class="l-content--input__three">
              <p class="l-content--input__headline">
                キャンセル手数料
              </p>
              <div class="accesary-percent">
                <select v-model="lessonCancelRate">
                  <option
                    v-for="(rate, index) in 100"
                    :key="rate.id"
                  >
                    {{ index }}
                  </option>
                </select>
              </div>
            </div>
          </div>
          <div class="l-button--submit">
            <button
              v-if="!changeModalEdit"
              type="button"
              class="c-button--square__pink"
              :disabled="checkLesson"
              @click="addLesson"
            >
              レッスンを追加する
            </button>
            <button
              v-else-if="changeModalEdit"
              type="button"
              class="c-button--square__pink"
              :disabled="checkLesson"
              @click="updateLesson"
            >
              編集内容を保存する
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import moment from "moment"
  import 'moment/locale/ja'
  import VueTimepicker from 'vue3-timepicker'
  import VueDatepicker from "vue3-datepicker"

  export default {
    components: {
      'vue-timepicker': VueTimepicker,
      'vue-datepicker': VueDatepicker,
    },
    data() {
      return {
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
        currendEditIndex   : null,
        courseLessons: [],
        arrayCourseLessons: '',
      }
    },
    created: function() {
      // バリデーションチェック：レッスン追加時
      this.$watch(
        () => [this.$data.lessonTitle, this.$data.lessonDate, this.$data.lessonStart, this.$data.lessonFinish, this.$data.lessonPrice, this.$data.lessonCancelRate],
        // (type, date, start, finish, price, cancel, title) => {
        () => {
          if(!this.lessonTitle == '' && !this.lessonDate == '' && !this.lessonStart == '' && !this.lessonFinish == '' && !this.lessonPrice == '' && !this.lessonCancelRate == '') {
            this.checkLesson = false;
          } else {
            this.checkLesson = true;
          }
        }
      )
    },
    methods: {
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
      // レッスンスライドを追加する
      onImageUploaded(e) {
        // event(=e)から画像データを取得する
        const image = e.target.files[0]
        this.createImage(image)
      },
    }
  }
</script>
