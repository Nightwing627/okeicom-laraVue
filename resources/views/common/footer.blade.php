<footer id="footer">
	<div class="l-allWrapper">
		<div class="footer__wrap l-flex">
			<div class="footer__wrap__box footer__lesson">
				<div class="footer__lesson__box">
					<a href="" class="linkBox">
						<img class="sp-only" src="{{ asset('/img/icon-nav-lesson-white.png') }}">
						<img class="pc-only" src="{{ asset('/img/icon-nav-lesson.png') }}">
						<span>レッスン一覧</span>
					</a>
				</div>
				<div class="footer__lesson__box">
					<a href="" class="linkBox">
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
						<li><a href="/news.php">お知らせ</a></li>
						<li><a href="/faq.php">よくある質問</a></li>
						<li><a href="/company.php">会社概要</a></li>
						<li><a href="/contact-us.php">お問い合わせ</a></li>
					</ul>
				</div>
				<div class="footer__list__box">
					<p class="footer__list__title">規約一覧</p>
					<ul class="footer__list__content">
						<li><a href="/terms-service.php">サービス規約</a></li>
						<li><a href="/terms-point.php">ポイント規約</a></li>
						<li><a href="/terms-user.php">受講者規約</a></li>
						<li><a href="/terms-teacher.php">講師規約</a></li>
						<li><a href="/tokushoho.php">特商法に基づく表示</a></li>
					</ul>
				</div>
			</div>
			<div class="footer__wrap__box footer__logo">
				<img src="{{ asset('/img/okeicom-logo-square.png') }}">
			</div>
		</div>
		<p class="copyright">@copyright おけい.com 2020</p>
	</div>
</footer>
<script src="{{ mix('js/app.js') }}"></script>

{{-- <script src="/public/js/vue.js"></script>
<script src="/public/js/ofi.js"></script>
<script src="https://unpkg.com/vuejs-datepicker"></script>
<script>
	objectFitImages();
</script> --}}