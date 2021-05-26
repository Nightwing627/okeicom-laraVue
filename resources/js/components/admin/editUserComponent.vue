<template>
  <div class="l-wrap--owner--main single-page">
    <div class="l-wrap--owner--main--inner">
      <div class="l-wrap--owner--header">
        <div class="l-wrap--owner--header--title">
          <a
            href="/owner-admin/users/"
            class="c-link--back"
          >
            ユーザー一覧へ戻る
          </a>
          <p>ユーザー詳細</p>
        </div>
        <div class="l-wrap--owner--header--button">
          <div class="c-button--minus">
            <button
              type="button"
              @click.prevent="deleteUser(user.id)"
            >
              ユーザーを削除する
            </button>
          </div>
        </div>
      </div>
      <div class="l-wrap--owner--body">
        <div class="l-wrap--owner--body--inner">
          <div class="c-list--table">
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  プロフィール画像
                </p>
              </div>
              <div class="c-list--td">
                <div class="c-img--preview u-ml0_pc">
                  <div class="c-img--preview--image c-img--cover">
                    <img :src="data.image">
                  </div>
                  <span class="c-img--preview--button">
                    <div class="c-img--preview--button--inner">
                      <img src="/img/common/icon-camera-black.png">
                      <input
                        ref="file"
                        type="file"
                        @change="setImage"
                      >
                    </div>
                  </span>
                </div>
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  アカウント名
                </p>
                <p class="sub">
                  アカウント名は変更できません。
                </p>
              </div>
              <div class="c-list--td">
                <input
                  v-model="user.account"
                  type="text"
                  name="account"
                  class="c-input--fixed"
                  disabled
                >
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  ユーザーネーム
                </p>
                <p class="sub">
                  サイトに表示する名前です。
                  <br>
                  20文字以内です。
                </p>
              </div>
              <div class="c-list--td">
                <input
                  v-model="user.name"
                  type="text"
                  name="name"
                >
              </div>
            </div>
            <!-- <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  パスワード
                </p>
              </div>
              <div class="c-list--td">
                <input
                  v-model="user.password"
                  type="password"
                  name="password"
                  class="c-input--fixed"
                  disabled
                >
              </div>
            </div> -->
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  性別
                </p>
                <p class="sub">
                  性別は変更できません。
                </p>
              </div>
              <div class="c-list--td">
                <input
                  v-model="user.sex"
                  type="text"
                  name="sex"
                  class="c-input--fixed"
                  disabled
                >
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  国籍
                </p>
              </div>
              <div class="c-list--td">
                <input
                  v-model="user.country_id"
                  type="text"
                  name="country_id"
                  value="日本"
                >
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  言語
                </p>
              </div>
              <div class="c-list--td">
                <input
                  v-model="user.language_id"
                  type="text"
                  name="language_id"
                >
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  都道府県
                </p>
              </div>
              <div class="c-list--td">
                <div class="c-selectBox">
                  <select v-model="user.prerecture_id">
                    <option
                      v-for="(prefecture, index) in prefectures"
                      :key="index"
                      :value="prefecture.id"
                    >
                      {{ prefecture.name }}
                    </option>
                  </select>
                </div>
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  手数料
                </p>
              </div>
              <div class="c-list--td">
                <input
                  v-model="user.commition_rate"
                  type="text"
                  name="commition_rate"
                >
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  カテゴリー
                </p>
              </div>
              <div class="c-list--td">
                <div class="c-selectBox u-mb5">
                  <select v-model="user.category1_id">
                    <option
                      v-for="(category, index) in categories"
                      :key="index"
                      :value="category.id"
                    >
                      {{ category.name }}
                    </option>
                  </select>
                </div>
                <div class="c-selectBox u-mb5">
                  <select v-model="user.category1_id">
                    <option
                      v-for="(category, index) in categories"
                      :key="index"
                      :value="category.id"
                    >
                      {{ category.name }}
                    </option>
                  </select>
                </div>
                <div class="c-selectBox u-mb5">
                  <select v-model="user.category2_id">
                    <option
                      v-for="(category, index) in categories"
                      :key="index"
                      :value="category.id"
                    >
                      {{ category.name }}
                    </option>
                  </select>
                </div>
                <div class="c-selectBox u-mb5">
                  <select v-model="user.category3_id">
                    <option
                      v-for="(category, index) in categories"
                      :key="index"
                      :value="category.id"
                    >
                      {{ category.name }}
                    </option>
                  </select>
                </div>
                <div class="c-selectBox u-mb5">
                  <select v-model="user.category4_id">
                    <option
                      v-for="(category, index) in categories"
                      :key="index"
                      :value="category.id"
                    >
                      {{ category.name }}
                    </option>
                  </select>
                </div>
              </div>
            </div>
            <div class="c-list--tr">
              <div class="c-list--th">
                <p class="main">
                  プロフィール
                </p>
                <p class="sub">
                  1000文字以内です。
                </p>
              </div>
              <div class="c-list--td">
                <textarea
                  v-model="user.profile"
                  name="profile"
                />
              </div>
            </div>
          </div>
        </div>

        <div class="l-button--submit">
          <button
            type="button"
            class="c-button--square__pink"
            @click.prevent="updateUser(user.id)"
          >
            変更内容を保存する
          </button>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
  import axios from 'axios'

	export default {
    props: {
      userId: {
        type: Number,
        required: true
      },
    },
		data() {
			return {
				// 新規登録画像
				data: {
					image: "/img/sample-human.png",
					name: "",
        },
        user: [],
        prefectures: [],
        categories: [],
			}
		},
    created: function() {
      // ユーザー詳細取得API
      axios.get(`/api/v1/users/${this.userId}`)
        .then(result => {
          // 管理者の承認が実行されていない出金リクエストを取得する
          this.user = result.data
          if(this.user.sex === 0) {
            this.user.sex = '不明'
          } else if(this.user.sex === 1) {
            this.user.sex = '男性'
          } else if(this.user.sex === 2) {
            this.user.sex = '女性'
          }
        })
        .catch(result => {
          console.log(result)
          alert('ユーザー詳細取得時にエラーが発生しました。')
        })

      // 都道府県一覧取得API
      axios.get('/api/v1/prefectures')
        .then(result => {
          // 管理者の承認が実行されていない出金リクエストを取得する
          this.prefectures = result.data;
        })
        .catch(result => {
          console.log(result)
          alert('都道府県一覧取得時にエラーが発生しました。')
        })

      // カテゴリー一覧取得API
      axios.get('/api/v1/categories')
        .then(result => {
          this.categories = result.data;
        })
        .catch(result => {
          console.log(result)
          alert('カテゴリー一覧取得時にエラーが発生しました。')
        })
    },
		methods: {
      // ユーザー削除API
      deleteUser(id) {
        console.log(id)
      },
      // ユーザー更新API
      updateUser() {
        const params = this.user;
        axios
          .put(`/api/v1/users/${this.userId}`, params)
          // .put(`/api/v1/users/${this.userId}`, params {
          //   name: this.user.name,
          //   country_id: this.user.country_id,
          //   language_id: this.user.language_id,
          //   prefecture_id: this.user.prefecture_id,
          //   commition_rate: this.user.commition_rate,
          //   category1_id: this.user.category1_id,
          //   category2_id: this.user.category2_id,
          //   category3_id: this.user.category3_id,
          //   category4_id: this.user.category4_id,
          //   category5_id: this.user.category5_id,
          //   profile: this.user.profile,
          // })
          .then(result => {
            alert('ユーザーの更新に成功しました。')
            console.log(result)
          })
          .catch(error => {
            aler('ユーザーの更新に失敗しました。')
            console.log(error)
          })
      },
      deleteUser() {
        axios
          .delete(`/api/v1/users/${this.userId}`)
          .then(result => {
            alert('ユーザーの削除に成功しました。')
            location.href='/owner-admin/users/'
          })
          .catch(error => {
            alert('ユーザーの削除に失敗しました。')
            console.log(error)
          })
      }
			// ユーザーの画像
			setImage(e) {
				const files = this.$refs.file;
				const fileImg = files.files[0];
				if (fileImg.type.startsWith("image/")) {
					this.data.image = window.URL.createObjectURL(fileImg);
					this.data.name = fileImg.name;
					this.data.type = fileImg.type;
				}
			},
		},
	}
</script>
