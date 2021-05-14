<template>
  <form
    method="POST"
    action="/mypage/t/lessons/store"
    @submit="checkForm"
  >
    <div class="l-wrap--title">
      <h1 class="c-headline--screen">
        レッスンを作成する
      </h1>
    </div>
    <div class="l-wrap--body">
      <div class="l-wrap--main l-wrap--detail">
        <modal-add-lesson
          @clicked-increase-button="incrementTotalCount"
          @clicked-reduce-button="decrementTotalCount"
        />
        <div class="l-button--submit">
          <div class="l-button--submit--two">
            <a
              href="/mypage/t/courses"
              class="c-button--square__gray"
            >
              コース一覧に戻る
            </a>
          </div>
          <div class="l-button--submit--two">
            <button
              type="submit"
              name="save"
              :disabled="checkStore"
              class="c-button--square__pink"
              @click="registerCourse"
            >
              レッスンを登録する
            </button>
          </div>
        </div>
      </div>
    </div>
  </form>
</template>

<script>
  import ModalAddLesson from '../modal/AddLesson.vue'
  export default {
    components: {
      'modal-add-lesson': ModalAddLesson, // レッスン作成のコンポーネント
    },
    data() {
      return {
        checkStore: true,
        lessonLength: 0,
      }
    },
    methods: {
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
      createImage(image) {
        const reader = new FileReader()
        // imageをreaderにDataURLとしてattachする
        reader.readAsDataURL(image)
        // readAdDataURLが完了したあと実行される処理
        reader.onload = () => {
          this.lessonSlide = reader.result
        }
      },

      // コースを登録するバリデーションチェック
      checkForm: function (e) {
        if (this.course.title && this.course.category) {
          return true;
        }
        this.errors = [];
        if (!this.course.title) {
          this.errors.push('タイトルは必須です。');
        }
        if (!this.course.category) {
          this.errors.push('カテゴリーは必須です。');
        }
        e.preventDefault();
      },
      //
      incrementTotalCount: function () {
        this.lessonLength += 1;
        console.log(this.lessonLength);
      },
      decrementTotalCount: function () {
        this.lessonLength -= 1;
        console.log(this.lessonLength);
      },
    },
  }
</script>
