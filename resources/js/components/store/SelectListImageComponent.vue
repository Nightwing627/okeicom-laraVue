<template>
    <ul class="couse-detail-img">
        <li class="couse-detail-img-inner" v-for="(item, index) in couseDetailFiles" :key="index">
            <div class="c-img--cover">
                <img :src="item.url" v-if="item.url !== ''">
                <span class="delete-file pc-only" :class="{active: item.isDelete}" @click="deleteFile(index)"></span>
                <span class="add-file" :class="{active: item.isAdd}">
                    <input type="file" accept="image/*"
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
                        <img src="/img/common/icon-camera-black.png">
                    </button>
                </span>
            </span>
            <span class="delete-icon sp-only" :class="{active: item.isDelete}" @click="deleteFile(index)">
                <img src="/img/common/icon-dust-black.png">
            </span>
        </li>
    </ul>
</template>
<script>
	export default {
        components: {},
        props: ['course', 'old'],
        data() {
            return {
                courseDate: this.course ?? '',
				couseDetailFiles: [
					{ url: "", isAdd: true, isDelete: false, isChange: false },
					{ url: "", isAdd: false, isDelete: false, isChange: false },
					{ url: "", isAdd: false, isDelete: false, isChange: false },
					{ url: "", isAdd: false, isDelete: false, isChange: false },
					{ url: "", isAdd: false, isDelete: false, isChange: false },
                ],
                // validationNumber: 100,
            }
        },
        created: function() {
            // 画像の初期設定
            if(this.courseDate.img1) {
                this.couseDetailFiles[0].url = '/storage/courses/' + this.courseDate.img1;
                this.couseDetailFiles[0].isAdd = false;
                this.couseDetailFiles[0].isDelete = false;
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
        mounted: function () {
        },
        watch: {
        },
        computed: {},
        methods: {
            // 画像のアップロード
			uploadFile: function(index) {
                // // ファイルを取得する
                const files = this.$refs['file' + index]
                const fileImg = files.files[0]
                if (fileImg.size > 1048576) {
                    alert('ファイルの上限サイズ1MBを超えています')
                } else {
                    const target = this.couseDetailFiles
                    if (fileImg.type.startsWith("image/")) {
                        target[index].isAdd = false
                        target[index].isChange = true
                        target[index].url = window.URL.createObjectURL(fileImg)
                        if (index < 4 && target[index+1].url == "" && target[index+1].isAdd == false) {
                            // 次の画像アップロード箇所追加
                            target[index+1].isAdd = true
                        }
                        if(!index == 0) {
                            target[index].isDelete = true
                        }
                    }
                    // バリデーション用
                    this.validationNumber += 1
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
                    this.$emit('add');
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

                const target = this.couseDetailFiles
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
                this.validationNumber -= 1
                this.$emit('remove');

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
            }
        },
    }
</script>
