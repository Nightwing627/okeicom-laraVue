<template>
    <div class="message-input-icon l-flex">
        <span class="file">
            <img src="/img/icon-message-file.png">
            <input type="file" ref="preview" name="" @change="uploadFile">
        </span>
        <span class="submit">
            <img src="/img/icon-message-send.png">
            <button name="save" type="submit"></button>
        </span>
    </div>
</template>
<script>
	export default {
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
