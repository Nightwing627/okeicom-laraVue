<template>
    <ul ref="categoryCheckbox" class="c-list--category">
        <li v-for="(category, index) in categoriesDate" :key="category.id">
            <input
                name="categories[]"
                type="checkbox"
                :ref="'target' + index"
                :checked="false"
                :value="category.id"
                v-model="checkcategories"
                @click="categorySubmit('target' + index)"
            >
            <label>{{ category.name }}</label>
        </li>
    </ul>
</template>
<script>
	export default {
        components: {},
        props: ['categorieslists', 'course', 'user', 'categories'],
		data() {
            return {
                categoriesDate: this.categorieslists ?? '',
                courseDate: this.course ?? '',
                userDate: this.user ?? '',
                // バリデーション カテゴリー確認
                checkbox: 0,
            }
        },
		created: function() {
            console.log(this.categories)
        },
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
            if(this.userDate) {
                for(let i = 0; i < this.categoriesDate.length; i++) {
                    // checkboxのvalueを取得
                    const checkTarget = this.$refs['target' + i];
                    for(let t = 1; t < 6; t++) {
                        const checkValidation = this.userDate['category' + t + '_id'];
                        if(checkTarget.value == checkValidation) {
                            checkTarget.checked = true;
                        }
                    }
                }
            }
        },
		computed: {
        },
		methods: {
            categorySubmit: function(ref) {
                // const vals = $('input[name~"categories"]:checked').map(function() {
                //     return $(this).val();
                // }).get();
                if(this.$refs[ref]['checked']) {
                    if (this.checkbox < 5) {
                        this.checkbox += 1
                        this.$emit("addCategory")
                    } else {
                        this.$refs[ref]['checked'] = false
                    }
                } else {
                    this.$emit("reduceCategory")
                    this.checkbox -= 1
                }

            }
        },
    }
</script>
