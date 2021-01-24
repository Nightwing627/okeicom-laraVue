<footer id="footer">
	<div class="l-allWrapper">
		<div class="footer__wrap l-flex">
			<div class="footer__wrap__box footer__lesson">
				<div class="footer__lesson__box">
					<a href="/lessons" class="linkBox">
						<img class="sp-only" src="{{ asset('/img/icon-nav-lesson-white.png') }}">
						<img class="pc-only" src="{{ asset('/img/icon-nav-lesson.png') }}">
						<span>レッスン一覧</span>
					</a>
				</div>
				<div class="footer__lesson__box">
					<a href="/teachers" class="linkBox">
						<img class="sp-only" src="{{ asset('/img/icon-grass-white.png') }}">
						<img class="pc-only" src="{{ asset('/img/icon-grass.png') }}">
						<span>先生一覧</span>
					</a>
				</div>
			</div>
			<div class="footer__wrap__box footer__list">
				<div class="footer__list__box">
					<p class="footer__list__title">会社情報</p>
					<ul class="footer__list__content">
						<li><a href="/news">お知らせ</a></li>
						<li><a href="/tokushoho">特商法に基づく表示</a></li>
						<li><a href="/contact">お問い合わせ</a></li>
					</ul>
				</div>
				<div class="footer__list__box">
					<p class="footer__list__title">規約一覧</p>
					<ul class="footer__list__content">
						<li><a href="/terms-user">受講者規約</a></li>
						<li><a href="/terms-teacher">講師規約</a></li>
						<li><a href="/faq-user">受講者よくある質問</a></li>
						<li><a href="/faq-teacher">講師よくある質問</a></li>
						<li><a href="/cancel-user">受講者キャンセルポリシー</a></li>
						<li><a href="/cancel-teacher">講師キャンセルポリシー</a></li>
						<li><a href="/flow">料金決済の流れ</a></li>
					</ul>
				</div>
			</div>
			<div class="footer__wrap__box footer__logo">
				<img src="{{ asset('/img/okeicom-logo-square.png') }}">
			</div>
		</div>
		<p class="copyright">@copyright おけい.com 2021</p>
	</div>
</footer>
<script src="{{ mix('js/app.js') }}"></script>
