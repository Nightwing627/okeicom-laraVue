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
				drawerActive: false,
				searchShow: false,
				isActiveCategory: false,
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
			}
		}
	})
</script>