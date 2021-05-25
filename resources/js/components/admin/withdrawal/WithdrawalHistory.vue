<template>
  <table class="withdraw-request-table">
    <thead>
      <tr>
        <td>出金リクエスト日時<br>出金完了日</td>
        <td>アカウント</td>
        <td>振込先銀行名<br>その他銀行情報</td>
        <td>振込金額<br>リクエスト金額 / 手数料</td>
      </tr>
    </thead>
    <tbody>
      <tr
        v-for="(target, index) in withdrawalHistories"
        :key="index"
      >
        <td>{{ customDate(target.created_at) }}<br>{{ customDate(target.verified_at) }}</td>
        <td>
          <a
            href=""
            class="u-text--link"
          >
            {{ target.user_name }}
          </a>
        </td>
        <td>
          {{ target.bank_type == 'japan' ? 'ゆうちょ銀行' : target.financial_name }}
          <br>
          {{ target.japan_mark ? target.japan_mark : '' }}
          {{ target.financial_name ? target.financial_name : '' }}
          {{ target.branch_name ? target.branch_name : '' }}
          {{ target.branch_number ? target.branch_number : '' }}
        </td>
        <td style="white-space: nowrap;">{{ customPrice(target.amount - target.fee) }}<br>{{ customPrice(target.amount) }} / {{ customPrice(target.fee) }}</td>
      </tr>
    </tbody>
  </table>
</template>
<script>
  import axios from 'axios'
  import moment from "moment"

  export default {
    data() {
      return {
        // 出金履歴一覧情報
        withdrawalHistories: [],
      }
    },
    created: function() {
      // 出金履歴一覧取得処理
      axios.get('/api/v1/withdrawals', {})
        .then(result => {
          // 管理者の承認が実行されていない出金リクエストを取得する
          this.withdrawalHistories = result.data.filter(date => {
            return date.verified_at !== null;
          });
        })
        .catch(error => {
          console.log(error)
          alert('出金履歴一覧取得時にエラーが発生しました。')
        })
    },
    methods: {
      // カスタマイズ：日付
      customDate: function(date) {
        return moment(date).format('YYYY/MM/DD HH:mm:SS')
      },
      // カスタマイズ：金額
      customPrice: function(price) {
        return `¥${Number(price).toLocaleString()}`
      },
    }
  }
</script>
