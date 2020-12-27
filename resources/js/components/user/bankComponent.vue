<template>
	<div class="c-button--tab top-tab two-tab">
		<div class="c-button--tab--inner u-w400_pc">
			<div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '1'}" @click.prevent="changeTab('1')">ゆうちょ</div>
			<div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '2'}" @click.prevent="changeTab('2')">その他</div>
		</div>
	</div>
	<!-- tab：ゆうちょ -->
	<div class="c-list--table" v-if="isBarTab === '1'">
		<!-- <div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">振込方法</p>
			</div>
			<div class="c-list--td">
				<ul>
					<li class="u-mb10">
						<div class="c-checkbox--fashonable">
							<label>支店名
								<input type="radio" name="how">
								<div class="color-box"></div>
							</label>
						</div>
					</li>
					<li>
						<div class="c-checkbox--fashonable">
							<label>記号番号
								<input type="radio" name="how">
								<div class="color-box"></div>
							</label>
						</div>
					</li>
				</ul>
			</div>
		</div> -->
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">口座記号</p>
			</div>
			<div class="c-list--td">
				<input class="u-w300_pc" placeholder="12345">
			</div>
		</div>
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">口座番号</p>
			</div>
			<div class="c-list--td">
				<input class="u-w300_pc" placeholder="1234567">
			</div>
		</div>
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">口座名義人</p>
			</div>
			<div class="c-list--td">
				<input class="u-w300_pc" type="" name="" placeholder="ヤマダタロウ（全角カタカナ）">
			</div>
		</div>
		<!-- <div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">セキュリティコード</p>
			</div>
			<div class="c-list--td">
				<input type="" name="" class="c-input--fixed" disabled value="aaaa">
			</div>
		</div> -->
		<!-- <div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">メインにする</p>
			</div>
			<div class="c-list--td">
				<input type="checkbox" name="">
			</div>
		</div> -->
		<div class="l-button--submit u-pb20_sp">
			<input type="subit" name="" value="変更内容を保存する" class="c-button--square__pink">
		</div>
	</div>
	<!-- tab：その他 -->
	<div class="c-list--table" v-else-if="isBarTab === '2'">
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">金融機関名</p>
			</div>
			<div class="c-list--td">
				<input class="u-w300_pc" type="" name="" placeholder="金融機関名を入力">
			</div>
		</div>
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">支店名</p>
			</div>
			<div class="c-list--td">
				<input class="u-w300_pc" type="" name="" placeholder="支店名を入力">
			</div>
		</div>
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">預金種目</p>
			</div>
			<div class="c-list--td">
				<div class="c-selectBox u-w100">
					<select>
						<option>普通</option>
						<option>当座</option>
					</select>
				</div>
			</div>
		</div>
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">口座番号</p>
			</div>
			<div class="c-list--td">
				<input class="u-w300_pc" type="" name="" placeholder="1234567">
			</div>
		</div>
		<!-- <div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">セキュリティコード</p>
			</div>
			<div class="c-list--td">
				<input type="" name="" class="c-input--fixed" disabled value="aaaa">
			</div>
		</div> -->
		<!-- <div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">メインにする</p>
			</div>
			<div class="c-list--td">
				<input type="checkbox" name="">
			</div>
		</div> -->
		<div class="l-button--submit u-pb20_sp">
			<input type="subit" name="" value="変更内容を保存する" class="c-button--square__pink">
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
		},
		watch: {},
	}
</script>