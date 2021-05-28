<template>
  <ul
    ref="categoryCheckbox"
    class="c-list--category"
  >
    <li
      v-for="(category, index) in categories"
      :key="category.id"
    >
      <!-- <input
        ref="targetCheckcbox"
        name="categories[]"
        type="checkbox"
        :checked="false"
        :value="index"
        @click="categorySubmit('target' + index)"
      > -->
      <input
        ref="targetCheckcbox"
        name="categories[]"
        type="checkbox"
        :checked="false"
        :value="index"
        @click="categorySubmit(index)"
      >
      <label>{{ category.name }}</label>
    </li>
  </ul>
</template>
<script>
  export default {
    props: {
      course: {
        type: Object,
        required: false,
        default () {}
      },
      user: {
        type: Object,
        required: false,
        default () {}
      },
      categoryList: {
        type: Array,
        required: true,
      }
      // 5/26 20:43 非表示
      // categories: {
      //   type: String,
      //   required: false,
      //   default: ''
      // },
    },
    emits: ['addCategory', 'reduceCategory'],
    data() {
      return {
        // props周り
        courseProp: this.course ?? '',
        userProp: this.user ?? '',
        // バリデーション カテゴリー確認
        checkbox: 0,
        categories: this.categoryList,
      }
    },
    mounted: function() {
      // [初期設定] コースの持つカテゴリーと同じカテゴリーをチェック
      let checkProp = ''
      if(this.courseProp) {
        checkProp = this.courseProp
      } else if(this.userProp) {
        checkProp = this.userProp
      }
      // カテゴリーの配列を取得する
      let checkArray = []
      for(let i = 1; i < 6; i++) {
        if(checkProp['category' + i + '_id'] !== null) {
          checkArray.push(checkProp['category' + i + '_id'])
        }
      }

      // forEachから同じ値を設定する
      checkArray.forEach((id) => {
        this.$refs.targetCheckcbox[id]['checked'] = true
      })

      // console.log(checkProp['category1_id']);
      // const checkArray = checkProp.
      // if(checkProp) {
      //   for(let i = 0; i < this.categories.length; i++) {
      //     // checkboxのvalueを取得
      //     const checkTarget = this.$refs['target' + i];
      //     for(let t = 1; t < 6; t++) {
      //       const checkValidation = checkProp['category' + t + '_id'];
      //       console.log(checkValidation)
      //       if(checkTarget.value == checkValidation) {
      //         checkTarget.checked = true;
      //       }
      //     }
      //   }
      // }
    },
    methods: {
      categorySubmit: function(id) {
        // const vals = $('input[name~"categories"]:checked').map(function() {
        //     return $(this).val();
        // }).get();
        // if(this.$refs[ref]['checked']) {
        //   if (this.checkbox < 5) {
        //     this.checkbox += 1
        //     this.$emit("addCategory")
        //   } else {
        //     this.$refs[ref]['checked'] = false
        //   }
        // } else {
        //   this.$emit("reduceCategory")
        //   this.checkbox -= 1
        // }
        if(this.$refs.targetCheckcbox[id]['checked']) {
          if (this.checkbox < 5) {
            this.checkbox += 1
            this.$emit("addCategory")
          } else {
            this.$refs.targetCheckcbox[id]['checked'] = false
          }
        } else {
          this.$emit("reduceCategory")
          this.checkbox -= 1
        }
      }
    },
  }
</script>
