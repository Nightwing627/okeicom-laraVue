
<script src="{{ mix('js/app.js') }}"></script>
{{-- <script src="/public/js/vue.js"></script>
<script src="/public/js/ofi.js"></script>
<script src="https://unpkg.com/vuejs-datepicker"></script>
<script>
	objectFitImages();
</script>
<script>
	Vue.component('modal-search', {
		// 検索モーダル
		template: `
	  	<div class="l-overlay l-modal--search" @click="clickEvent">
			<div class="l-modal--search__content" @click="stopEvent">
				<slot></slot>
			</div>
	    </div>
		`,
		methods: {
			clickEvent: function() {
				this.$emit('from-child')
			},
			stopEvent: function(){
			    event.stopPropagation()
			},
		}
	})
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
				drawerActive: false,
				searchShow: false,
				isActiveCategory: false,
				isBarTab: '1',
				// メニュー
				isMenuUser: false,
				messageFiles: [
				],

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
			// 検索画面を開く
			openSearch: function() {
				this.searchShow = !this.searchShow
			},
			// 検索画面を閉じる
			closeSearch: function() {
				this.searchShow = false
			},
			// [SP]　カテゴリー一覧を表示させる
			swithActiveCategory: function() {
				this.isActiveCategory = !this.isActiveCategory;
			},
			// 講師詳細：
			changeTab: function(num){
				this.isBarTab = num
			},
			// 新規登録の画像の反映
			setImage(e) {
				const files = this.$refs.file;
				const fileImg = files.files[0];
				if (fileImg.type.startsWith("image/")) {
					this.data.image = window.URL.createObjectURL(fileImg);
					this.data.name = fileImg.name;
					this.data.type = fileImg.type;
				}
			},
			// 講師向けよくある質問ボタン
			toggleTeacherAnswer: function(index, content) {
				this.teacherFaqs[index].bodys[content].isAnswerOpen = !this.teacherFaqs[index].bodys[content].isAnswerOpen;
			},
			// 受講者向けよくある質問ボタン
			toggleStudentAnswer: function(index, content) {
				this.studentFaqs[index].bodys[content].isAnswerOpen = !this.studentFaqs[index].bodys[content].isAnswerOpen;
			},
			toggleMenuUser: function() {
				this.isMenuUser = !this.isMenuUser
			},
			uploadFile: function() {
				// 取得した画像ファイルのURLを取得
				let file = this.$refs.preview.files[0]
				this.url = URL.createObjectURL(file)
				// 配列に画像を追加
				this.messageFiles.push({file: this.url})
			},
			deleteFile: function(index) {
				this.messageFiles.splice(index, 1)
			},
		}
	})
</script> --}}