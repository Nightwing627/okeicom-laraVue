<template>
    <ul ref="categoryCheckbox" class="c-list--category">
        <li v-for="(category, index) in categoriesDate" :key="category.id">
            <input
                name="categories[]"
                type="checkbox"
                :ref="'target' + index"
                :checked="false"
                :value="category.id"
                @click="categorySubmit('target' + index)"
            >
            <label>{{ category.name }}</label>
        </li>
    </ul>
</template>
<script>
	export default {
        components: {},
        props: ['categorieslists', 'course'],
		data() {
            return {
                courseDate: this.course ?? '',
                categoriesDate: this.categorieslists ?? '',
                // バリデーション カテゴリー確認
                checkbox: 0,
            }
        },
		created: function() {},
        mounted: function () {
            // [初期設定] コースの持つカテゴリーと同じカテゴリーをチェック
            if(this.courseDate) {
                for(let i = 0; i < this.categoriesDate.length; i++) {
                    // checkboxのvalueを取得
                    const checkTarget = this.$refs['target' + i];
                    for(let t = 1; t < 6; t++) {
                        const checkValidation = this.courseDate['category' + t + '_id'];
                        if(checkTarget.value == checkValidation) {
                            checkTarget.checked = true;
                        }
                    }
                }
            }
        },
		computed: {
            // カテゴリーが5つ以上登録できないようにする
            checkCategoriesLimit: function() {},
            // カテゴリーのcheckedの数を数える
            checkedNumber: function() {

            }
        },
		methods: {
            categorySubmit: function(ref) {
                // const vals = $('input[name~"categories"]:checked').map(function() {
                //     return $(this).val();
                // }).get();
                if(this.$refs[ref]['checked']) {
                    this.$emit("addCategory")
                } else {
                    this.$emit("reduceCategory")
                }

            }
        },
    }
</script>
