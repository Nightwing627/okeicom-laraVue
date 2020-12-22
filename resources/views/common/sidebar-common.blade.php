<div id="sidebar">
	<div class="headline pc-only"><p>その他ページ</p></div>
	<ul class="sidebar__list long sp-only" v-if="isActiveCategory">
		<li class="selected"><a href="">お知らせ一覧</a></li>
		<li><a href="">講師規約</a></li>
		<li><a href="">講師キャンセルポリシー</a></li>
		<li><a href="">講師よくある質問</a></li>
		<li><a href="">受講者規約</a></li>
		<li><a href="">受講者キャンセルポリシー</a></li>
		<li><a href="">受講者よくある質問</a></li>
		<li><a href="">特定商取引法に基づく表記</a></li>
		<li><a href="">料金決済の流れ</a></li>
	</ul>
	<ul class="sidebar__list pc-only" v-if="">
		<li class="selected"><a href="">お知らせ一覧</a></li>
		<li><a href="">講師規約</a></li>
		<li><a href="">講師キャンセルポリシー</a></li>
		<li><a href="">講師よくある質問</a></li>
		<li><a href="">受講者規約</a></li>
		<li><a href="">受講者キャンセルポリシー</a></li>
		<li><a href="">受講者よくある質問</a></li>
		<li><a href="">特定商取引法に基づく表記</a></li>
		<li><a href="">料金決済の流れ</a></li>
	</ul>
	<div class="c-openButton sp-only">
		<a @click.prevent="swithActiveCategory">
			<span v-if="!isActiveCategory"><img src="/public/img/icon-arrow-down-blue.png">その他ページ一覧</span>
			<span class="close" v-else="!isActiveCategory">閉じる</span>
		</a>
	</div>
</div>