<template>
	<div class="l-wrap--single">
		<div class="l-wrap--title">
			<a class="c-link--back u-mb5">取引一覧へ戻る</a>
			<h1 class="c-headline--screen">出金リクエスト</h1>
		</div>
		<div class="l-wrap--body">
			<div class="l-wrap--main l-wrap--detail">
				<div class="l-content--detail">
					<div class="c-headline--block">出金額</div>
					<div class="l-content--detail__inner">
						<div class="user-pament-total">
							<p>¥30,000</p>
						</div>
					</div>
				</div>
				<div class="l-content--detail">
					<div class="c-headline--block">決済方法</div>
					<div class="l-content--detail__inner">
						<ul>
							<li class="u-mb20">
								<div class="c-checkbox--fashonable">
									<label>登録済み銀行口座にリクエスト
										<input type="radio" name="how" @change="changeTab('1')" :checked="true">
										<div class="color-box"></div>
									</label>
								</div>
							</li>
							<li>
								<div class="c-checkbox--fashonable">
									<label>その他銀行にリクエスト
										<input type="radio" name="how" @change="changeTab('2')">
										<div class="color-box"></div>
									</label>
								</div>
							</li>
						</ul>
					</div>
				</div>
				<div class="l-content--detail">
					<div class="c-headline--block">振込先情報</div>
					<div class="l-content--detail__inner" v-if="isBarTab === '1'">
						<div class="l-content--input">
							<p class="l-content--input__headline">口座番号</p>
							<p>ゆうちょ（末尾：5452）</p>
						</div>
					</div>
					<div class="l-content--detail__inner" v-if="isBarTab === '2'">
						<div class="c-button--tab two-tab">
							<div class="c-button--tab--inner">
								<div class="c-button--tab--box" v-bind:class="{'selected': isBankPanel === '1'}" @click.prevent="changeBankTab('1')">ゆうちょ</div>
								<div class="c-button--tab--box" v-bind:class="{'selected': isBankPanel === '2'}" @click.prevent="changeBankTab('2')">その他</div>
							</div>
						</div>
						<div class="l-content--panel" v-if="isBankPanel === '1'">
							<div class="l-content--input">
								<p class="l-content--input__headline">口座記号</p>
								<input type="" name="" placeholder="12345">
							</div>
							<div class="l-content--input">
								<p class="l-content--input__headline">口座番号</p>
								<input type="" name="" placeholder="1234567">
							</div>
							<div class="l-content--input">
								<p class="l-content--input__headline">口座名義人</p>
								<input type="" name="" placeholder="ヤマダタロウ（全角カタカナ）">
							</div>
						</div>
						<div class="l-content--panel" v-else-if="isBankPanel === '2'">
							<div class="l-content--input">
								<p class="l-content--input__headline">金融機関名</p>
								<input type="" name="" placeholder="ABC銀行">
							</div>
							<div class="l-content--input u-w50per">
								<p class="l-content--input__headline">支店番号</p>
								<input type="" name="" placeholder="123">
							</div>
							<div class="l-content--input u-w50per">
								<p class="l-content--input__headline">支店名</p>
								<input type="" name="" placeholder="本店">
							</div>
							<div class="l-content--input u-w50per">
								<p class="l-content--input__headline">口座種別</p>
								<div class="c-selectBox">
									<select>
										<option>普通</option>
										<option>当座</option>
									</select>
								</div>
							</div>
							<div class="l-content--input">
								<p class="l-content--input__headline">口座番号</p>
								<input type="" name="" placeholder="1234567">
							</div>
							<div class="l-content--input">
								<p class="l-content--input__headline">口座名義人</p>
								<input type="" name="" placeholder="ヤマダタロウ（全角カタカナ）">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="l-button--submit">
			<input class="c-button--square__pink" type="subit" name="" value="出金リクエスト確定">
		</div>
	</div>
</template>
<script>
	
	export default {
        components: {
        },
		data() {
			return {
				isBarTab: '1',
				// ゆうちょ or その他銀行
				isBankPanel: '1',
			}
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

		},
		computed: {},
		methods: {
			// 講師詳細：
			changeTab: function(num){
				this.isBarTab = num
			},
			// ゆうちょ or　その他銀行
			changeBankTab: function(num){
				this.isBankPanel = num
			},
		},
		watch: {},
	}
</script>