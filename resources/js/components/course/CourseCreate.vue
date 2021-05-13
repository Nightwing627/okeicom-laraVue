<template>
  <input
    v-model="arrayCourseLessons"
    type="hidden"
    name="lessons"
  >
  <div class="l-wrap--title">
    <a
      href="/mypage/t/courses"
      class="c-link--back u-mb5"
    >
      コース一覧へ戻る
    </a>
    <h1 class="c-headline--screen">
      コースを作成する
    </h1>
  </div>
  <div class="l-wrap--body">
    <div
      v-show="page1"
      class="l-wrap--main l-wrap--detail"
    >
      <!-- <div class="l-content--detail">
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
      </div> -->
      <div class="l-content--detail">
        <div class="c-headline--block">
          詳細
        </div>
        <div class="l-content--detail__inner">
          <div class="l-content--input">
            <p class="l-content--input__headline">
              タイトル
            </p>
            <input
              id="title"
              v-model="courseDetail.title"
              name="title"
              class="form-control"
              type="text"
              placeholder="タイトルを入力してください"
              @keyup="validationCheck"
            >
            <!-- <p
              v-if="errors.title"
              class="l-alart__text errorAlart"
            >
              {{ errors.title[0] }}
            </p> -->
          </div>
          <div class="l-content--input">
            <p class="l-content--input__headline">
              コース詳細
            </p>
            <textarea
              id="detail"
              v-model="courseDetail.detail"
              class="form-control"
              name="detail"
            />
            <!-- <p
              v-if="errors.detail"
              class="l-alart__text errorAlart"
            >
              {{ errors.detail[0] }}
            </p> -->
          </div>
        </div>
      </div>
      <div class="l-content--detail">
        <div class="c-headline--block">
          画像を選択
        </div>
        <div class="l-content--detail__inner">
          <select-image
            :old="old"
            @add="addImage"
            @remove="removeImage"
          />
        </div>
      </div>
      <div class="l-content--detail">
        <div class="c-headline--block">
          カテゴリーを選択
        </div>
        <div class="l-content--detail__inner">
          <select-category
            :categories-list="categoriesList"
            :categories="old.categories"
            @addCategory="addCheckbox"
            @reduceCategory="reduceCheckbox"
          />
        </div>
      </div>
    </div>
  </div>
  <div
    class="l-button--submit"
  >
    <button
      class="c-button--square__pink"
      type="button"
      :disabled="createCourse"
      @click="nextPage"
    >
      コースを登録する
    </button>
  </div>
</template>
<script>
  // ajax通信
  import SelectCategory from './../../components/store/SelectListCategoryComponent.vue'
  import SelectImage from './../../components/store/SelectListImageComponent.vue'

  export default {
    components: {
      'select-category': SelectCategory, // カテゴリー選択のコンポーネント
      'select-image': SelectImage, // 画像選択のコンポーネント
    },
    props: {
      course: {
        type: String,
        required: true
      },
      categoriesList: {
        type: Array,
        required: true
      },
      csrf: {
        type: String,
        required: true
      },
      old: {
        type: Array,
        required: true
      },
      error: {
        type: Array,
        required: true
      },
    },
    data() {
      return {
        createCourse: true,
        // [ステップ1]
        courseDetail : {
          title: this.old.title ?? '', // タイトル
          detail: this.old.detail ?? '', // 詳細
          category: this.old.category ?? 0 // カテゴリー
        },
        // categoryValidation: 0,    // カテゴリー
        validationNumber: 0,
        // [ステップ2]
        checkStore: true,
      }
    },
    created: function() {
      // [ステップ1]のボタンのバリデーションチェック
      this.$watch(
        () => [this.$data.courseDetail.category, this.$data.courseDetail.title, this.validationNumber],
        // valueやoldValueの型は上で返した配列になる
        // (value, oldValue) => {
        () => {
          if(this.courseDetail.category == 0 || this.courseDetail.title == '' || this.validationNumber == 0) {
            this.createCourse = true;
          } else if (this.courseDetail.category > 0 && !this.courseDetail.title == '' && this.validationNumber > 0) {
            this.createCourse = false;
          }
        }
      )
    },
    methods: {
      // [ステップ1]
      // バリデーション：カテゴリーの値
      addCheckbox: function() {
        if (this.courseDetail.category  < 5) {
          this.courseDetail.category += 1;
        }
      },
      reduceCheckbox: function() {
        this.cocourseDetailurse.category -= 1;
      },
      // バリデーション：画像の値
      addImage: function() {
        this.validationNumber += 1
      },
      removeImage: function() {
        this.validationNumber -= 1
      },

    },
  }
</script>
