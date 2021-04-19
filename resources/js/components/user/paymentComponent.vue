<template>
    <!--
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
    -->
    <div class="l-content--detail">
        <div class="c-headline--block">振込先情報</div>
        <!--
        <div class="l-content--detail__inner" v-if="isBarTab === '1'">
            <div class="l-content--input">
                <p class="l-content--input__headline">口座番号</p>
                <p>ゆうちょ（末尾：5452）</p>
            </div>
        </div>
        <div class="l-content--detail__inner" v-if="isBarTab === '2'">
        -->
        <div class="l-content--detail__inner">
            <div class="c-button--tab two-tab">
                <div class="c-button--tab--inner">
                    <div class="c-button--tab--box" v-bind:class="{'selected': isBankPanel === '0'}" @click.prevent="changeBankTab('0')">ゆうちょ</div>
                    <div class="c-button--tab--box" v-bind:class="{'selected': isBankPanel === '1'}" @click.prevent="changeBankTab('1')">その他</div>
                    <input type="hidden" name="bank_type" v-model="bankType">
                </div>
            </div>
            <div class="l-content--panel" v-if="isBankPanel === '0'">
                <div class="l-content--input">
                    <p class="l-content--input__headline">口座記号</p>
                    <input type="text" name="yucho_mark" placeholder="12345" :value="this.bankDate.mark ?? ''" required="required">
                </div>
                <div class="l-content--input">
                    <p class="l-content--input__headline">口座番号</p>
                    <input type="text" name="yucho_number" placeholder="1234567" :value="this.bankDate.japan_number ?? ''" required="required">
                </div>
                <div class="l-content--input">
                    <p class="l-content--input__headline">口座名義人</p>
                    <input type="text" name="yucho_name" placeholder="ヤマダタロウ（全角カタカナ）" :value="this.bankDate.japan_name ?? ''" required="required">
                </div>
            </div>
            <div class="l-content--panel" v-else-if="isBankPanel === '1'">
                <div class="l-content--input">
                    <p class="l-content--input__headline">金融機関名</p>
                    <input type="text" name="other_financial_name" placeholder="ABC銀行" :value="this.bankDate.financial_name ?? ''" required="required">
                </div>
                <div class="l-content--input u-w50per">
                    <p class="l-content--input__headline">支店名</p>
                    <input type="text" name="other_branch_name" placeholder="本店" :value="this.bankDate.branch_name ?? ''" required="required">
                </div>
                <div class="l-content--input u-w50per">
                    <p class="l-content--input__headline">支店番号</p>
                    <input type="text" name="other_branch_number" placeholder="123" :value="this.bankDate.branch_number ?? ''" required="required">
                </div>
                <div class="l-content--input u-w50per">
                    <p class="l-content--input__headline">口座種別</p>
                    <div class="c-selectBox">
                        <select name="other_type" :value="bankType" required="required">
                            <option value="0">普通</option>
                            <option value="1">当座</option>
                        </select>
                    </div>
                </div>
                <div class="l-content--input">
                    <p class="l-content--input__headline">口座番号</p>
                    <input type="text" name="other_number" placeholder="1234567" :value="this.bankDate.other_number" required="required">
                </div>
                <div class="l-content--input">
                    <p class="l-content--input__headline">口座名義人</p>
                    <input type="text" name="other_name" placeholder="ヤマダタロウ（全角カタカナ）" :value="this.bankDate.other_name" required="required">
                </div>
            </div>
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
        components: {
        },
		data() {
			return {
				isBarTab: this.target ?? '0',
				// ゆうちょ or その他銀行
                isBankPanel: '1',
                bankType: this.bankDate.type ?? '0',
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
			// ゆうちょ or その他銀行
			changeBankTab: function(num){
                this.isBankPanel = num
                this.bankType = num
			},
		},
		watch: {},
	}
</script>
