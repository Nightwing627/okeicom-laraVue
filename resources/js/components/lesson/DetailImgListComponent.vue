<template>
    <div class="c-lessonDetail__img l-flex">
        <div class="c-lessonDetail__img__thumb c-img--cover">
            <img :src="'/storage/courses/' + thumbImage">
        </div>
        <ul class="c-lessonDetail__img__list">
            <!-- <li><img src="/storage/courses/'{{ thumbLists[0].img }}'"></li> -->
            <li v-for="(thumb, index) in thumbLists" :key="index" @click="changeThumb">
                <img v-if="!(thumb.img==unll)" :src="'/storage/courses/' + thumb.img">
            </li>
        </ul>
    </div>
</template>
<script>
	export default {
		components: {},
        props: ['imglists'],
		data: function() {
			return {
                thumbImage: this.imglists['img1'],
                thumbLists: [
                    { id: 0, img: this.imglists['img1'] },
                    { id: 1, img: this.imglists['img2'] },
                    { id: 2, img: this.imglists['img3'] },
                    { id: 3, img: this.imglists['img4'] },
                    { id: 4, img: this.imglists['img5'] },
                ]
            }
		},
		created: function() {
			// 必要に応じて、初期表示時に使用するLaravelのAPIを呼び出すメソッドを定義

        },
        created : function(){
        },
        mounted : function(){
        },
		computed: {},
		methods: {
            changeThumb: function() {
            }
        },
		watch: {},
	}
</script>
