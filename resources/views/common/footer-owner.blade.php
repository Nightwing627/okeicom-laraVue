<script src="/public/js/vue.js"></script>
<script src="/public/js/ofi.js"></script>
<script src="https://unpkg.com/vuejs-datepicker"></script>
<script>
	var app = new Vue({
		el: '#app',
		components: {
			'vuejs-datepicker':vuejsDatepicker
		},
		data(){
			return {
				// 新規登録画像
				data: {
					image: "/public/img/sample-human.png",
					name: "",
				},
				isBarTab: '1',
				// コースの画像
				couseDetailFiles: [
					{ url: "", isAdd: true, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
				],
				isParticipantDetail: false,
			}
		},
		methods: {
			// コース詳細：タブ切り替え
			changeTab: function(num){
				this.isBarTab = num
			},
			// ユーザーの画像
			setImage(e) {
				const files = this.$refs.file;
				const fileImg = files.files[0];
				if (fileImg.type.startsWith("image/")) {
					this.data.image = window.URL.createObjectURL(fileImg);
					this.data.name = fileImg.name;
					this.data.type = fileImg.type;
				}
			},
			// 画像の変更
			changeFile: function(index) {
				let files = this.$refs.change[index]
				let fileImg = files.files[0]
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
						// 次の画像がない場合
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
			openDetail: function() {
				this.isParticipantDetail =! this.isParticipantDetail
			}
		}
	})
</script>