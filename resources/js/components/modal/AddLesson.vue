<template>
  <div>
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
          v-for="(detail, index) in lessons"
          :key="index"
          class="teacher-course-add-lesson-list"
        >
          <div class="teacher-course-add-lesson-list-detail">
            <p class="date">
              {{ detail.date }}{{ detail.start }}-{{ detail.finish }}
            </p>
            <p class="title">
              {{ detail.title }}
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
      ref="lesson_add_modal"
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
                type="button"
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
                v-model="lesson.title"
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
                        v-model="lesson.publicType"
                        type="radio"
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
                        v-model="lesson.publicType"
                        value="1"
                        type="radio"
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
                        v-model="lesson.broadcastType"
                        type="radio"
                        value="0"
                        :checked="true"
                        @change.prevent="changeBroadcastType(1)"
                      >
                      <div class="color-box" />
                    </label>
                  </div>
                </li>
                <li class="u-mb15">
                  <div class="c-checkbox--fashonable">
                    <label>動画埋め込み
                      <input
                        v-model="lesson.broadcastType"
                        type="radio"
                        value="1"
                        @change.prevent="changeBroadcastType(2)"
                      >
                      <div class="color-box" />
                    </label>
                  </div>
                </li>
                <li>
                  <div class="c-checkbox--fashonable">
                    <label>スライド
                      <input
                        v-model="lesson.broadcastType"
                        type="radio"
                        value="2"
                        @change.prevent="changeBroadcastType(3)"
                      >
                      <div class="color-box" />
                    </label>
                  </div>
                </li>
              </ul>
            </div>
            <div
              v-if="isBroadcastType != 3"
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
              v-if="isBroadcastType === 3"
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
                    v-model="lesson.date"
                    :locale="locale"
                    lang="ja"
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
                  <vue-datepicker
                    lang="ja"
                  />
                  <!-- <vue-timepicker
                    v-model="lesson.start"
                    hour-label="時間"
                    minute-label="分"
                    :minute-interval="5"
                  /> -->
                  <!-- <vue-timepicker
                    format="hh:mm"
                    formatted="hh:mm"
                    only-time
                  /> -->
                </div>
                <div class="l-content--input__three u-w49per_sp">
                  <div class="l-content--input__headline">
                    終了時間
                  </div>
                  <vue-timepicker
                    v-model="lesson.finish"
                    hour-label="時間"
                    minute-label="分"
                    :minute-interval="5"
                  />
                  <!-- <vue-timepicker
                    format="hh:mm"
                    formatted="hh:mm"
                    only-time
                  /> -->
                </div>
              </div>
            </div>
            <div class="l-content--input">
              <p class="l-content--input__headline">
                詳細
              </p>
              <textarea v-model="lesson.detail" />
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
                    v-model="lesson.price"
                    type="text"
                    placeholder="半角数字を入力してください"
                    @input="priceValidate"
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
                  <select v-model="lesson.cancellationFee">
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
  </div>
</template>
<script>
  import moment from "moment"
  import 'moment/locale/ja'
  import VueDatepicker from 'vue2-datepicker'
  import 'vue2-datepicker/index.css';
  import VueTimepicker from 'vue2-timepicker'
  import 'vue2-timepicker/dist/VueTimepicker.css'

  export default {
    components: {
      'vue-datepicker': VueDatepicker,
      'vue-timepicker': VueTimepicker,
    },
    emits: [
      'clicked-reduce-button',
      'clicked-increase-button'
    ],
    data() {
      return {
        // レッスンモーダル
        isLessonModal: false,
        // ブロードキャストナンバー
        isBroadcastType: 1,
        // レッスンの配列
        lessons: [],

        // モーダルの初期設定
        lesson: {
          title: '',
          publicType: 0,
          broadcastType: 0,
          url: '',
          slide: '',
          date : moment(new Date).format('YYYY/MM/DD'),
          start: null,
          finish: null,
          detail: '',
          price: 100,
          cancellationFee: 20,
        },
      }
    },
    methods: {
      // モーダル：表示
      showModal: function() {
        this.isLessonModal = true;
      },
      // モーダル：非表示
      closeModal: function() {
        // モーダルを閉じる
        this.$refs.lesson_add_modal.scrollTop = 0;
        // 配列を初期化する
        this.isLessonModal = false;
      },
      // レッスン：追加する
      addLesson: function() {
        // 連想配列を追加する
        this.lessons.push(this.lesson);
        // 親要素に追加の情報を渡す
        this.$emit('clicked-increase-button');
        // モーダルのトップに移動させる
        this.$refs.lesson_add_modal.scrollTop = 0;
        // モーダルを閉じる
        this.isLessonModal = false;
      },
      // レッスン：更新する
      updateLesson: function() {
      },
      // レッスン：削除する
      deleteLesson: function(index) {
        this.lessons.splice(index, 1);
        // 親要素に削除の情報を渡す
        this.$emit('clicked-reduce-button');
      },
      // レッスンスライドを追加する
      onImageUploaded(e) {
        // event(=e)から画像データを取得する
        const image = e.target.files[0]
        this.createImage(image)
      },
      changeBroadcastType: function(type) {
        this.isBroadcastType = type;
        this.lessonUrl = '';
        this.lessonSlide = '';
      },
      // 金額：半角数字のみのバリデーション
      priceValidate: function() {
        this.lessonPrice = this.lessonPrice.replace(/\D/g, '')
      },
    }
  }
</script>
