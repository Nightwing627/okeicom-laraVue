<template>
    <table class="withdraw-request-table">
        <thead>
            <tr>
                <td>出金リクエスト日時</td>
                <td>アカウント</td>
                <td>振込先銀行名<br>その他情報</td>
                <td>リクエスト金額</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(value, index) in withdrawals" :key="index">
                <td>{{ value.created_at }}</td>
                <td><a href="" class="u-text--link">アカウント名</a></td>
                <td>ゆうちょ銀行<br>その他情報</td>
                <td>¥200,000</td>
                <td>
                    <div class="c-button--edit">
                        <button class="c-button--edit--link delete">完了</button>
                    </div>
                </td>
            </tr>
        </tbody>
    </table>
</template>
<script>
    // vue3でvue2のようなことをするときに必要
    import axios from 'axios'
    import moment from "moment"

    export default {
        components: {
        },
		data() {
			return {
                // 出金一覧リクエスト一覧情報
                withdrawals: [],
			}
        },
        created: function() {
            axios.get('/api/v1/announcements', {})
                .then(result => {
                    this.withdrawals = []
                    this.withdrawals = result.data
                })
                .catch(result => {
                    console.log(result)
                    alert('出金リクエスト一覧取得時にエラーが発生しました。')
                })
        },
        mounted () {},
	}
</script>
