<footer id="footer" class="footer__single">
	<div class="l-allWrapper">
		<p class="copyright">@copyright おけい.com 2020</p>
	</div>
</footer>
<script src="/public/js/vue.js"></script>
<script src="/public/js/ofi.js"></script>
<script src="https://unpkg.com/vuejs-datepicker"></script>
<script>
	objectFitImages();
</script>
<script>
	var app = new Vue({
		el: '#app',
		components: {
			'vuejs-datepicker':vuejsDatepicker
		},
		data(){
			return {
				drawerActive: false,
				isActiveCategory: false,
				isBarTab: '1',
				// メニュー
				isMenuUser: false,
				couseDetailFiles: [
					{ url: "", isAdd: true, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
					{ url: "", isAdd: false, isDelete: false },
				],
				DatePickerFormat: 'yyyy-MM-dd',
				ja: {
					language: 'Japanese',
					months: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
					monthsAbbr: ['1月', '2月', '3月', '4月', '5月', '6月', '7月', '8月', '9月', '10月', '11月', '12月'],
					days: ['日', '月', '火', '水', '木', '金', '土'],
					rtl: false,
					ymd: 'yyyy-MM-dd',
					yearSuffix: '年'
				},
				isType: '1',
				isParticipantDetail: false,
			}
		},
		methods: {
			// ドロワーを開く
			openDrawer: function() {
				this.drawerActive = true
			},
			// ドロワーを閉じる
			closeDrawer: function() {
				this.drawerActive = false
			},
			// タブ色々
			changeTab: function(num){
				this.isBarTab = num
			},
			// 放送タイプ
			changeType: function(type) {
				this.isType = type
			},
			toggleMenuUser: function() {
				this.isMenuUser = !this.isMenuUser
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
				let files = this.$refs.file[index]
				let fileImg = files.files[0]
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