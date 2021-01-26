<template>
    <div class="c-lessonDetail__img l-flex">
        <div class="c-lessonDetail__img__thumb c-img--cover">
            <img src="/img/screen-top.jpg">
        </div>
        <ul class="c-lessonDetail__img__list">
            <li><img src="/img/screen-top.jpg"></li>
            <li><img src="/img/screen-top.jpg"></li>
            <li><img src="/img/screen-top.jpg"></li>
            <li><img src="/img/screen-top.jpg"></li>
            <li><img src="/img/screen-top.jpg"></li>
        </ul>
    </div>
    {{ imgLists }}
</template>
<script>
	export default {
        props: ['imgLists'],
		components: {},
		data: function() {
			return {
                // imgLists: [
                //     { id: 1, img: this.imgLists[0] },
                //     { id: 2, img: this.imgLists[1] },
                //     { id: 3, img: this.imgLists[2] },
                //     { id: 4, img: this.imgLists[3] },
                //     { id: 5, img: this.imgLists[4] },
                // ]
            }
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

		},
		computed: {},
		methods: {},
		watch: {},
	}
</script>
