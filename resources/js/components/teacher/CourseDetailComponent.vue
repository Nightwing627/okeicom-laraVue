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
                <input type="hidden" name="courses_id" v-model="courses_id">
                <input type="hidden" name="_token" v-bind:value="csrf">
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
                        <ul class="couse-detail-img">
                            <li class="couse-detail-img-inner" v-for="(item, index) in couseDetailFiles" :key="index">
                                <div class="c-img--cover">
                                    <img :src="item.url" v-if="item.url !== ''">
                                    <span class="delete-file pc-only" :class="{active: item.isDelete}" @click="deleteFile(index)"></span>
                                    <span class="add-file" :class="{active: item.isAdd}">
                                        <input
                                            type="file"
                                            accept=".jpeg,.jpg,.png,.gif"
                                            :name="'img' + (index + 1)"
                                            :ref="'file' + index"
                                            :class="'target' + index"
                                            @change="uploadFile(index)"
                                        >
                                        <!-- <input
                                            type="file"
                                            ref="'file' + index"
                                            @change="uploadFile(index)"
                                        > -->
                                    </span>
                                </div>
                                <span class="change-file" :class="{active: item.isDelete}">
                                    <span class="change-file-inner">
                                        <img src="/img/icon-camera-black.png">
                                        <input type="file" name="" ref="change" @change.self="changeFile(index)">
                                    </span>
                                </span>
                                <span class="delete-icon sp-only" :class="{active: item.isDelete}" @click="deleteFile(index)">
                                    <img src="/img/icon-dust-black.png">
                                </span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="c-list--tr">
                    <div class="c-list--th">
                        <p class="main">カテゴリー <button @click.prevent="clickfalse">カテゴリー1のcheckboxをfalseにする</button></p>
                    </div>
                    <div class="c-list--td">
                        <ul class="c-list--category">
                            <li v-for="(category, index) in categories" :key="category.id">
                                <input class="non-check" type="checkbox" :ref="'target_' + index" :checked="false" v-model="categoryLists" :value="category.id"><label>{{ category.name }}</label>
                            </li>
                        </ul>
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
                        <textarea name="detail" autocomplete="detail" v-model="detail">{{ courseDate.detail }}</textarea>
                    </div>
                </div>
                <div class="l-button--submit">
                    <button type="submit" name="save" class="c-button--square__pink">変更内容を保存する</button>
                    <button type="submit" name="delete" class="c-button--square__pink">削除する</button>
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
                    <span># {{ index }}</span>
                </div>
                <div class="c-list--courseLesson--title">
                    <p class="title u-text--big u-mb5">{{ lesson.title }}</p>
                    <p class="date u-color--grayNavy u-text--small">{{ moment(lesson.date).format('M/D') }}({{ moment(lesson.date).format('ddd') }}) {{ moment(lesson.start).format('H:mm') }}{{ moment(lesson.finish).format('H:mm') }}</p>
                </div>
                <!-- 開催日を超えた現場は削除 -->
                <div class="c-button--edit">
                    <a href="" class="c-button--edit--link delete">削除</a>
                    <a href="{{ route('mypage.t.lessons.detail', ['id' => lesson->id]) }}" class="c-button--edit--link edit">編集</a>
                </div>
            </div>
            {{ courseDate.category1_id }}
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import moment from "moment";
    import 'moment/locale/ja';

	export default {
        components: {},
        props: ['course', 'categories', 'lessons', 'csrf'],
		data() {
            return {
                // ライブラリ
                moment: moment,
                // propsのdata化
                courseDate: this.course,
                categoriesDate: this.categories,
                lessonsDate: this.lessons,
                // 通常のdata
                isBarTab: '1',
				couseDetailFiles: [
					{ url: "", isAdd: true, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
                ],
                // submitのパラメーター用のdata
                categoryLists: [],
                courses_id: this.courses_id ? this.courses_id : '',
                detail: this.course.detail ? this.course.detail : '',

            }
        },
		created: function() {
            // 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義
            // 画像の初期設定
            if(this.courseDate.img1) {
                this.couseDetailFiles[0].url = '/storage/courses/' + this.courseDate.img1;
                this.couseDetailFiles[0].isAdd = false;
                this.couseDetailFiles[0].isDelete = true;
                this.couseDetailFiles[1].isAdd = true;
                this.couseDetailFiles[1].isDelete = false;
            }
            if(this.courseDate.img2) {
                this.couseDetailFiles[1].url = '/storage/courses/' + this.courseDate.img2;
                this.couseDetailFiles[1].isAdd = false;
                this.couseDetailFiles[1].isDelete = true;
                this.couseDetailFiles[2].isAdd = true;
                this.couseDetailFiles[2].isDelete = false;
            }
            if(this.courseDate.img3) {
                this.couseDetailFiles[2].url = '/storage/courses/' + this.courseDate.img3;
                this.couseDetailFiles[2].isAdd = false;
                this.couseDetailFiles[2].isDelete = true;
                this.couseDetailFiles[3].isAdd = true;
                this.couseDetailFiles[3].isDelete = false;
            }
            if(this.courseDate.img4) {
                this.couseDetailFiles[3].url = '/storage/courses/' + this.courseDate.img4;
                this.couseDetailFiles[3].isAdd = false;
                this.couseDetailFiles[3].isDelete = true;
                this.couseDetailFiles[4].isAdd = true;
                this.couseDetailFiles[4].isDelete = false;
            }
            if(this.courseDate.img5) {
                this.couseDetailFiles[4].url = '/storage/courses/' + this.courseDate.img5;
                this.couseDetailFiles[4].isAdd = false;
                this.couseDetailFiles[4].isDelete = true;
            }
        },
        mounted: function (option) {
            // [初期設定] コースの持つカテゴリーと同じカテゴリーをチェック
            for(let i = 0; i < this.categories.length; i++) {
                // checkboxのvalueを取得
                const checkTarget = this.$refs['target_' + i];
                // if(checkTarget.value == this.courseDate.category1_id) {
                //     checkTarget.checked = true;
                // }
                // if(checkTarget.value == this.courseDate.category2_id) {
                //     checkTarget.checked = true;
                // }
                // if(checkTarget.value == this.courseDate.category3_id) {
                //     checkTarget.checked = true;
                // }
                // if(checkTarget.value == this.courseDate.category4_id) {
                //     checkTarget.checked = true;
                // }
                // if(checkTarget.value == this.courseDate.category5_id) {
                //     checkTarget.checked = true;
                // }
                for(let t = 1; t < 6; t++) {
                    const checkValidation = this.courseDate['category' + t + '_id'];
                    if(checkTarget.value == checkValidation) {
                        checkTarget.checked = true;
                        this.categoryLists.push(checkTarget.value);
                    }
                }
                console.log(this.$refs.target_1)
            }
        },
		computed: {
            // カテゴリーが5つ以上登録できないようにする
            checkCategoriesLimit: function() {

            }
        },
		methods: {
			// タブ色々
			changeTab: function(num){
				this.isBarTab = num
			},
			// setImage(e) {
            //     const files = this.$refs.file;
			// 	const fileImg = files.files[0];
			// 	if (fileImg.type.startsWith("image/")) {
			// 		this.data.image = window.URL.createObjectURL(fileImg);
			// 		this.data.name = fileImg.name;
			// 		this.data.type = fileImg.type;
			// 	}
			// },
			// 画像のアップロード
			uploadFile: function(index) {
                // // ファイルを取得する
				const files = this.$refs['file' + index]
                const fileImg = files.files[0]
                // // 条件に応じて、アップロードを考える
				if (fileImg.type.startsWith("image/")) {
					if(index === 4) {
						this.couseDetailFiles[index].isAdd = false
						this.couseDetailFiles[index].isDelete = true
						this.couseDetailFiles[index].url = window.URL.createObjectURL(fileImg)
					} else {
						this.couseDetailFiles[index].isAdd = false
						this.couseDetailFiles[index].isDelete = true
						this.couseDetailFiles[index].url = window.URL.createObjectURL(fileImg)
						// 次の画像アップロード箇所追加
						this.couseDetailFiles[index+1].isAdd = true
					}
                }
			},
			// 画像の変更
			changeFile: function(index) {
				const files = this.$refs['file' + index]
				const fileImg = files.files[0]
				if (fileImg.type.startsWith("image/")) {
					this.couseDetailFiles[index].url = window.URL.createObjectURL(fileImg)
				}
			},
			// 画像の削除
			deleteFile: function(index) {
				// 選択した画像が5枚目の場合
				this.couseDetailFiles[index].url = ""
				if(index === 4) {
					this.couseDetailFiles[index].isAdd = true
					this.couseDetailFiles[index].isDelete = false
				} else {
					let i = 1
					while(i < 6) {
						if(!this.couseDetailFiles[index+i].url == "") {
							this.couseDetailFiles[index+i-1].url = this.couseDetailFiles[index+i].url
							// 次に配列が存在しない場合
							if(!this.couseDetailFiles[index+i+1]) {
								this.couseDetailFiles[index+i].url = ""
								this.couseDetailFiles[index+i].isAdd = true
								this.couseDetailFiles[index+i].isDelete = false
								break
							}
							i += 1

						} else {
							this.couseDetailFiles[index+i-1].url = ""
							this.couseDetailFiles[index+i-1].isAdd = true
							this.couseDetailFiles[index+i-1].isDelete = false
							this.couseDetailFiles[index+i].isAdd = false
							i = 1
							break
						}
					}
				}
            },
            // axios post
            // submitForm: function () {
            //     // axios postするパラメーターを設定する
            //     const params = new FormData();
            //     params.append('courses_id', this.courses_id);
            //     params.append('detail', this.detail);
            //     // const params = {
            //     //     detail: this.detail
            //     // };
            //     // CORSエラー対策
            //     const CORS_PROXY = "https://cors-anywhere.herokuapp.com/";
            //     // Ajax POST通信
            //     axios.post(CORS_PROXY + '/mypage/t/courses/update', params)
            //         .then(function (response) {
            //             // 取得成功時：画面を更新
            //             alert('成功しました！');
            //             // location.href = 'http://127.0.0.1:8000/mypage/t/courses/detail/' + course.id;
            //         })
            //         .catch(function (response) {
            //             // エラー時：アラートを表示
            //             alert('失敗しました。');
            //         })
            // },
		},
        watch: {},
    }
</script>
