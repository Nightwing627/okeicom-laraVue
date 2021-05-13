<template>
  <div class="l-wrap--title">
    <h1 class="c-headline--screen">
      コースを作成する
    </h1>
  </div>
  <div class="l-wrap--body">
    <div class="l-wrap--main l-wrap--detail">
      <modal-lesson />
      <div class="l-button--submit">
        <div class="l-button--submit--two">
          <button
            type="button"
            class="c-button--square__pink"
            @click="backPage"
          >
            コース一覧に戻る
          </button>
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
</template>

<script>
  // ajax通信
  import ModalLesson from '../modal/CourseLesson.vue'
  export default {
    components: {
      'modal-lesson': ModalLesson, // レッスン作成のコンポーネント
    },
    methods: {
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
      createImage(image) {
        const reader = new FileReader()
        // imageをreaderにDataURLとしてattachする
        reader.readAsDataURL(image)
        // readAdDataURLが完了したあと実行される処理
        reader.onload = () => {
          this.lessonSlide = reader.result
        }
      },
    },
  }
</script>
