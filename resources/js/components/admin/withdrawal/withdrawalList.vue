<template>
  <table class="withdraw-request-table">
    <thead>
      <tr>
        <td>出金リクエスト日時</td>
        <td>ユーザー</td>
        <td>振込先銀行名<br>その他情報</td>
        <td>リクエスト金額<br>金額 / 手数料</td>
        <td />
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(withdrawal, index) in withdrawals"
        :key="index"
      >
        <td>{{ withdrawal.created_at }}</td>
        <td>
          <a
            href=""
            class="u-text--link"
          >
            アカウント名
          </a>
        </td>
        <td>ゆうちょ銀行<br>その他情報</td>
        <td style="white-space: nowrap;">¥{{ withdrawal.withdrawal }}<br>¥{{ withdrawal.amount }} / ¥{{ withdrawal.fee }}</td>
        <td>
          <div class="c-button--edit">
            <button
              class="c-button--edit--link delete"
              @click="verifiedButton(withdrawal.id)"
            >
              振込完了
            </button>
          </div>
        </td>
      </tr>
    </tbody>
  </table>
</template>
<script>
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
    axios.get('/api/v1/withdrawals', {})
      .then(result => {
        // 出金リクエスト
        this.withdrawals = []
        this.withdrawals = result.data
        // 出金リクエスト一覧の値を加工する
        this.withdrawals.forEach((value, i) => {
          this.withdrawals[i].created_at = moment(this.withdrawals[i].created_at).format('Y年M月D日 HH:mm:ss');
          this.withdrawals[i].withdrawal = Number(this.withdrawals[i].amount - this.withdrawals[i].fee).toLocaleString();
          this.withdrawals[i].amount     = this.withdrawals[i].amount.toLocaleString();
          this.withdrawals[i].fee        = this.withdrawals[i].fee.toLocaleString();
        })
      })
      .catch(result => {
        console.log(result)
        alert('出金リクエスト一覧取得時にエラーが発生しました。')
      })
    },
    methods: {
      verifiedButton: function(id) {
        axios.put(`/api/v1/withdrawals/${id}`)
          .then((response) => {
            console.log(response)
          })
          .catch((error) => {
            console.log(error)
          })
      },
    },
	}
</script>
