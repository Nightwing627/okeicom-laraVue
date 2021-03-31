<template>
    <div class="message-input-inner">
        <div class="message-input-area">
            <textarea id="message_detail" class="form-control @error('message_detail') is-invalid @enderror" name="message_detail" required cols="50" rows="5" v-model="message" placeholder="メッセージを入力してください"></textarea>
        </div>
        <div class="message-input-other l-flex">
            <div class="message-input-img l-flex">
                <div class="message-input-img-box c-img--cover" v-for="(i, index) in messageFiles" :key="index">
                    <img :src="messageFiles[index].file">
                    <span class="deleteButton" @click="deleteFile(index)"></span>
                </div>
            </div>
            <div class="message-input-icon l-flex">
                <span class="file">
                    <img src="/img/common/icon-message-file.png">
                    <input
                        type="file"
                        ref="preview"
                        name="message_file[]"
                        :name="message_file"
                        accept=".pdf,.doc,.docx,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,.xls,.xlsx,application/vnd.ms-excel,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,.png,.jpeg,.jpg,.gif"
                        @change="uploadFile">
                </span>
                <span class="submit">
                    <img src="/img/common/icon-message-send.png">
                    <button name="save" type="submit"></button>
                </span>
            </div>
        </div>
    </div>
</template>
<script>
	export default {
        props: ['message'],
        components: {
        },
		data() {
			return {
				messageFiles: [],
			}
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

		},
		computed: {},
		methods: {

			uploadFile: function() {
				// 取得した画像ファイルのURLを取得
				let file = this.$refs.preview.files[0]
				this.url = URL.createObjectURL(file)
				// 配列に画像を追加
				this.messageFiles.push({file: this.url})
			},
			deleteFile: function(index) {
				this.messageFiles.splice(index, 1)
			},
		},
		watch: {},
	}
</script>
