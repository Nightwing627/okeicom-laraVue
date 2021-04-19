<template>
	<div class="c-button--tab top-tab two-tab">
		<div class="c-button--tab--inner u-w400_pc">
			<div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '0'}" @click.prevent="changeTab('0')">ゆうちょ</div>
			<div class="c-button--tab--box" v-bind:class="{'selected': isBarTab === '1'}" @click.prevent="changeTab('1')">その他</div>
		</div>
	</div>
	<!-- tab：ゆうちょ -->
	<div class="c-list--table" v-if="isBarTab === '0'">
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
				<input class="u-w300_pc" type="number" name="yucho_mark" placeholder="12345" required="required" :value="this.bankDate.mark ?? ''">
			</div>
		</div>
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">口座番号</p>
			</div>
			<div class="c-list--td">
				<input class="u-w300_pc" type="number" name="yucho_number" placeholder="1234567" required="required" :value="this.bankDate.japan_number ?? ''">
			</div>
		</div>
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">口座名義人</p>
			</div>
			<div class="c-list--td">
				<input class="u-w300_pc" type="text" name="yucho_name" placeholder="ヤマダタロウ（全角カタカナ）" required="required" :value="this.bankDate.japan_name ?? ''">
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
            <button type="submit" class="c-button--square__pink">変更内容を保存する</button>
		</div>
	</div>
	<!-- tab：その他 -->
	<div class="c-list--table" v-else-if="isBarTab === '1'">
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">金融機関名</p>
			</div>
			<div class="c-list--td">
				<input class="u-w300_pc" type="text" name="other_financial_name" placeholder="金融機関名を入力" :value="this.bankDate.financial_name ?? ''" required="required">
			</div>
		</div>
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">支店名</p>
			</div>
			<div class="c-list--td">
				<input class="u-w300_pc" type="text" name="other_branch_name" placeholder="支店名を入力" :value="this.bankDate.branch_name ?? ''" required="required">
			</div>
		</div>
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">支店番号</p>
			</div>
			<div class="c-list--td">
				<input class="u-w300_pc" type="number" name="other_branch_number" placeholder="000" :value="this.bankDate.branch_number ?? ''" required="required">
			</div>
		</div>
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">預金種目</p>
			</div>
			<div class="c-list--td">
				<div class="c-selectBox u-w100">
					<!-- <select name="other_type" v-model="banktype" required="required"> -->
                    <select name="other_type" :value="banktype" required="required">
						<option value="0">普通</option>
						<option value="1">当座</option>
					</select>
				</div>
			</div>
		</div>
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">口座番号</p>
			</div>
			<div class="c-list--td">
				<input class="u-w300_pc" type="number" name="other_number" placeholder="1234567" :value="this.bankDate.other_number" required="required">
			</div>
		</div>
		<div class="c-list--tr">
			<div class="c-list--th">
				<p class="main">口座名義人</p>
			</div>
			<div class="c-list--td">
				<input class="u-w300_pc" type="text" name="other_name" placeholder="口座名義人を入力" :value="this.bankDate.other_name" required="required">
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
            <button type="submit" class="c-button--square__pink">変更内容を保存する</button>
		</div>
	</div>
</template>
<script>
	export default {
        props: {
            bankDate: {
                type: Array
            },
            target: {
                type: Number
            },
        },
        components: {},
		data() {
			return {
                isBarTab: this.target ?? '0',
                banktype: this.bankDate.type ?? '0',
			}
		},
		created: function() {
            // 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義
        },
		computed: {},
		methods: {
			changeTab: function(num){
				this.isBarTab = num
			},
		},
		watch: {},
	}
</script>
