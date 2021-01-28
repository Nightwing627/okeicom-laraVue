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
                        <ul class="couse-detail-img">
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
                                        <!-- <input
                                            type="file"
                                            ref="'file' + index"
                                            @change="uploadFile(index)"
                                        > -->
                                    </span>
                                </div>
                                <span class="change-file" :class="{active: item.isChange}">
                                    <span class="change-file-inner">
                                        <button @click.prevent="changeFile(index)">
                                            <img src="/img/icon-camera-black.png">
                                        </button>
                                        <!-- <input type="file" ref="change" @change.self="changeFile(index)"> -->
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
                        <p class="main">カテゴリー</p>
                    </div>
                    <div class="c-list--td">
                        <ul class="c-list--category">
                            <li v-for="(category, index) in categories_list" :key="category.id">
                                <input class="non-check" name="categories[]" type="checkbox" :ref="'target_' + index" :checked="false" :value="category.id"><label>{{ category.name }}</label>
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
                        <textarea name="detail" autocomplete="detail">{{ courseDate.detail }}</textarea>
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
        props: ['course', 'categories_list', 'lessons', 'csrf'],
		data() {
            return {
                // ライブラリ
                moment: moment,
                // propsのdata化
                courseDate: this.course,
                categoriesDate: this.categories_list,
                lessonsDate: this.lessons,
                // 通常のdata
                isBarTab: '1',
				couseDetailFiles: [
					{ url: "", isAdd: true, isDelete: false, isChange: false },
					{ url: "", isAdd: false, isDelete: false, isChange: false },
					{ url: "", isAdd: false, isDelete: false, isChange: false },
					{ url: "", isAdd: false, isDelete: false, isChange: false },
					{ url: "", isAdd: false, isDelete: false, isChange: false },
                ],

            }
        },
		created: function() {
            // 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義
            // 画像の初期設
            if(this.courseDate.img1) {
                this.couseDetailFiles[0].url = '/storage/courses/' + this.courseDate.img1;
                // this.couseDetailFiles[0].url = createObjectURL(this.courseDate.img1);
                this.couseDetailFiles[0].isAdd = false;
                this.couseDetailFiles[0].isDelete = true;
                this.couseDetailFiles[0].isChange = true;
                this.couseDetailFiles[1].isAdd = true
                this.couseDetailFiles[1].isDelete = false;
            }
            if(this.courseDate.img2) {
                this.couseDetailFiles[1].url = '/storage/courses/' + this.courseDate.img2;
                this.couseDetailFiles[1].isAdd = false;
                this.couseDetailFiles[1].isDelete = true;
                this.couseDetailFiles[1].isChange = true;
                this.couseDetailFiles[2].isAdd = true;
                this.couseDetailFiles[2].isDelete = false;
            }
            if(this.courseDate.img3) {
                this.couseDetailFiles[2].url = '/storage/courses/' + this.courseDate.img3;
                this.couseDetailFiles[2].isAdd = false;
                this.couseDetailFiles[2].isDelete = true;
                this.couseDetailFiles[2].isChange = true;
                this.couseDetailFiles[3].isAdd = true;
                this.couseDetailFiles[3].isDelete = false;
            }
            if(this.courseDate.img4) {
                this.couseDetailFiles[3].url = '/storage/courses/' + this.courseDate.img4;
                this.couseDetailFiles[3].isAdd = false;
                this.couseDetailFiles[3].isDelete = true;
                this.couseDetailFiles[3].isChange = true;
                this.couseDetailFiles[4].isAdd = true;
                this.couseDetailFiles[4].isDelete = false;
            }
            if(this.courseDate.img5) {
                this.couseDetailFiles[4].url = '/storage/courses/' + this.courseDate.img5;
                this.couseDetailFiles[4].isAdd = false;
                this.couseDetailFiles[4].isDelete = true;
                this.couseDetailFiles[4].isChange = true;
            }
        },
        mounted: function (option) {
            // [確認用]
            // [初期設定] コースの持つカテゴリーと同じカテゴリーをチェック
            for(let i = 0; i < this.categories_list.length; i++) {
                // checkboxのvalueを取得
                const checkTarget = this.$refs['target_' + i];
                for(let t = 1; t < 6; t++) {
                    const checkValidation = this.courseDate['category' + t + '_id'];
                    if(checkTarget.value == checkValidation) {
                        checkTarget.checked = true;
                    }
                }
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
                // // 条件に応じて、アップロードを考える
				// if (fileImg.type.startsWith("image/")) {
				// 	if(index === 4) {
				// 		this.couseDetailFiles[index].isAdd = false
				// 		this.couseDetailFiles[index].isDelete = true
				// 		this.couseDetailFiles[index].isChange = true
				// 		this.couseDetailFiles[index].url = window.URL.createObjectURL(fileImg)
				// 	} else {
				// 		this.couseDetailFiles[index].isAdd = false
				// 		this.couseDetailFiles[index].isDelete = true
				// 		this.couseDetailFiles[index].isChange = true
				// 		this.couseDetailFiles[index].url = window.URL.createObjectURL(fileImg)
				// 		// 次の画像アップロード箇所追加
				// 		this.couseDetailFiles[index+1].isAdd = true
				// 	}
                // }
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
                this.$refs['file' + index].click();
                // console.log('aaa')
                // const files = this.$refs['file' + index]
                // const fileImg = files.files[0]
                // console.log(fileImg)
				// if (fileImg.type.startsWith("image/")) {
				// 	this.couseDetailFiles[index].url = window.URL.createObjectURL(fileImg)
				// }
			},
			// 画像の削除
			deleteFile: function(index) {
                // 選択した画像が5枚目の場合
				// this.couseDetailFiles[index].url = ""
				// if(index === 4) {
				// 	this.couseDetailFiles[index].isAdd = true
				// 	this.couseDetailFiles[index].isDelete = false
				// } else {
                //     // 選択した画像が5枚目以外の場合
                //     this.couseDetailFiles[index].isAdd = true
				// 	let i = 1
				// 	while(i < 6) {
				// 		if(!this.couseDetailFiles[index+i].url == "") {
				// 			this.couseDetailFiles[index+i-1].url = this.couseDetailFiles[index+i].url
				// 			// 次に配列が存在しない場合
				// 			if(!this.couseDetailFiles[index+i+1]) {
				// 				this.couseDetailFiles[index+i].url = ""
				// 				this.couseDetailFiles[index+i].isAdd = true
				// 				this.couseDetailFiles[index+i].isDelete = false
				// 				break
				// 			}
				// 			i += 1

				// 		} else {
				// 			this.couseDetailFiles[index+i-1].url = ""
				// 			this.couseDetailFiles[index+i-1].isAdd = true
				// 			this.couseDetailFiles[index+i-1].isDelete = false
				// 			this.couseDetailFiles[index+i].isAdd = false
				// 			i = 1
				// 			break
				// 		}
				// 	}
                // }

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

                // 画像の配列を定義
                // const targetImg = this.couseDetailFiles;

                // // 画像1枚目は削除不可
                // if(this.couseDetailFiles[index+1].url == null && this.couseDetailFiles[index-1].url == null) {
                //     window.alert('1枚目は削除できません');
                //     return;
                // } else {
                //     targetImg[index].url = ""
                //     targetImg[index].isAdd = true
                //     targetImg[index].isDelete = false
                //     // 選択した画像が5枚目以外の場合、次のisAddをfalseにする必要がある
                //     if(!index == 4) {
                //         // 画像が最後の場合
                //         let i = 1
                //         while(i < 6) {
                //             if(!targetImg[index+i].url == "") {
                //                 targetImg[index+i-1].url = targetImg[index+i].url
                //                 // 次に配列が存在しない場合
                //                 if(!targetImg[index+i+1]) {
                //                     targetImg[index+i].url = ""
                //                     targetImg[index+i].isAdd = true
                //                     targetImg[index+i].isDelete = false
                //                     break
                //                 }
                //                 i += 1

                //             } else {
                //                 targetImg[index+i-1].url = ""
                //                 targetImg[index+i-1].isAdd = true
                //                 targetImg[index+i-1].isDelete = false
                //                 targetImg[index+i].isAdd = false
                //                 i = 1
                //                 break
                //             }
                //         }
                //     }
                // }
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
