<template>
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
                                            <img src="/img/icon-camera-black.png">
                                        </button>
                                    </span>
                                </span>
                                <span class="delete-icon sp-only" :class="{active: item.isDelete}" @click="deleteFile(index)">
                                    <img src="/img/icon-dust-black.png">
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
                <a href="">レッスンを追加する</a>
            </div>
            <div class="c-list--courseLesson" v-for="(lesson, index) in lessonsDate" :key="index.id">
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
                    <a :href="'/mypage/t/lessons/edit/' + lesson.id" class="c-button--edit--link edit">編集</a>
                </div>
            </div>
            <!-- {{ courseDate.category1_id }} -->
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import moment from "moment";
    import SelectCategory from './../../components/store/SelectListCategoryComponent.vue';
    import SelectImage from './../../components/store/SelectListImageComponent.vue';

	export default {
        components: {
            SelectCategory,
            SelectImage,
        },
        props: ['course', 'categories_list', 'lessons', 'csrf'],
		data() {
            return {
                // ライブラリ
                moment: moment,
                // propsのdata化
                courseDate: this.course,
                // categoriesDate: this.categories_list,
                lessonsDate: this.lessons,
                // 通常のdata
                isBarTab: '1',

            }
        },
		created: function() {
            // 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義
            // 画像の初期設
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
			setImage(e) {
                const files = this.$refs.file;
                const fileImg = files.files[0];
				if (fileImg.type.startsWith("image/")) {
					this.data.image = window.URL.createObjectURL(fileImg);
					this.data.name = fileImg.name;
					this.data.type = fileImg.type;
				}
			},
			// 画像のアップロード
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
			// 画像の変更
			changeFile: function(index) {
                // 画像のアップロードを起動させる
                this.$refs['file' + index].click();
			},
			// 画像の削除
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
		},
        watch: {},
    }
</script>
