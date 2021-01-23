<template>
    <div class="c-list--td">
        <div class="c-img--preview u-ml0_pc">
            <div class="c-img--preview--image c-img--cover">
                <img :src="data.image">
            </div>
            <span class="c-img--preview--button">
                <div class="c-img--preview--button--inner">
                    <img src="/img/icon-camera-black.png">
                    <input type="file" ref="file" @change="setImage"/>
                </div>
            </span>
        </div>
    </div>
</template>
<script>
	export default {
        components: {
        },
		data() {
			return {
				data: {
					image: "/img/sample-human.png",
					name: "",
				},
			}
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

		},
		computed: {},
		methods: {
			// 新規登録の画像の反映
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
		watch: {},
	}
</script>
