<template>
  <ul class="couse-detail-img">
    <li
      v-for="(item, index) in couseDetailFiles"
      :key="index"
      class="couse-detail-img-inner"
    >
      <div class="c-img--cover">
        <img
          v-if="item.url !== ''"
          :src="item.url"
        >
        <span
          class="delete-file pc-only"
          :class="{active: item.isDelete}"
          @click="deleteFile(index)"
        />
        <span
          class="add-file"
          :class="{active: item.isAdd}"
        >
          <input
            :id="'img' + (index + 1)"
            :ref="'file' + index"
            :src="item.url"
            :name="'img' + (index + 1)"
            type="file"
            accept="image/*"
            @change="uploadFile(index)"
          >
        </span>
      </div>
      <span
        class="change-file"
        :class="{active: item.isChange}"
      >
        <span class="change-file-inner">
          <button @click.prevent="changeFile(index)">
            <img src="/img/common/icon-camera-black.png">
          </button>
        </span>
      </span>
      <span
        class="delete-icon sp-only"
        :class="{active: item.isDelete}"
        @click="deleteFile(index)"
      >
        <img src="/img/common/icon-dust-black.png">
      </span>
    </li>
  </ul>
</template>
<script>
	export default {
    props: {
      course: {
        type: Object,
        required: false,
        default () {}
      },
     old: {
        type: Array,
        required: false,
        default () {}
      },
    },
    emits: ['remove', 'add'],
    data() {
      return {
        courseDate: this.course ?? '',
        couseDetailFiles: [
          { url: "", isAdd: true, isDelete: false, isChange: false },
          { url: "", isAdd: false, isDelete: false, isChange: false },
          { url: "", isAdd: false, isDelete: false, isChange: false },
          { url: "", isAdd: false, isDelete: false, isChange: false },
          { url: "", isAdd: false, isDelete: false, isChange: false },
        ],
      }
    },
    created: function() {
      // ?????????????????????
      if(this.courseDate.img1) {
        this.couseDetailFiles[0].url = '/storage/courses/' + this.courseDate.img1;
        this.couseDetailFiles[0].isAdd = false;
        this.couseDetailFiles[0].isDelete = false;
        this.couseDetailFiles[0].isChange = true;
        this.couseDetailFiles[1].isAdd = true
        this.couseDetailFiles[1].isDelete = false;
      }
      if(this.courseDate.img2) {
        this.couseDetailFiles[1].url = '/storage/courses/' + this.courseDate.img2;
        this.couseDetailFiles[1].isAdd = false;
        this.couseDetailFiles[1].isDelete = true;
        this.couseDetailFiles[1].isChange = true;
        this.couseDetailFiles[2].isAdd = true;
        this.couseDetailFiles[2].isDelete = false;
      }
      if(this.courseDate.img3) {
        this.couseDetailFiles[2].url = '/storage/courses/' + this.courseDate.img3;
        this.couseDetailFiles[2].isAdd = false;
        this.couseDetailFiles[2].isDelete = true;
        this.couseDetailFiles[2].isChange = true;
        this.couseDetailFiles[3].isAdd = true;
        this.couseDetailFiles[3].isDelete = false;
      }
      if(this.courseDate.img4) {
        this.couseDetailFiles[3].url = '/storage/courses/' + this.courseDate.img4;
        this.couseDetailFiles[3].isAdd = false;
        this.couseDetailFiles[3].isDelete = true;
        this.couseDetailFiles[3].isChange = true;
        this.couseDetailFiles[4].isAdd = true;
        this.couseDetailFiles[4].isDelete = false;
      }
      if(this.courseDate.img5) {
        this.couseDetailFiles[4].url = '/storage/courses/' + this.courseDate.img5;
        this.couseDetailFiles[4].isAdd = false;
        this.couseDetailFiles[4].isDelete = true;
        this.couseDetailFiles[4].isChange = true;
      }
    },
    methods: {
      // ???????????????????????????
      uploadFile: function(index) {
        // // ???????????????????????????
        const files = this.$refs['file' + index]
        const fileImg = files[0].files[0]
        // ???????????????????????????????????????????????????????????????????????????
        if (fileImg.size > 1048576) {
          alert('??????????????????????????????1MB?????????????????????')
        } else {
          const target = this.couseDetailFiles
          if (fileImg.type.startsWith("image/")) {
              target[index].isAdd = false
              target[index].isChange = true
              target[index].url = window.URL.createObjectURL(fileImg)
              if (index < 4 && target[index+1].url == "" && target[index+1].isAdd == false) {
                  // ??????????????????????????????????????????
                  target[index+1].isAdd = true
              }
              if(!index == 0) {
                  target[index].isDelete = true
              }
          }
          // ????????????????????????
          this.validationNumber += 1
          this.$emit('add')
          // // ???????????????????????????????????????????????????
          // if (fileImg.type.startsWith("image/")) {
          // 	if(index === 4) {
          // 		this.couseDetailFiles[index].isAdd = false
          // 		this.couseDetailFiles[index].isDelete = true
          // 		this.couseDetailFiles[index].isChange = true
          // 		this.couseDetailFiles[index].url = window.URL.createObjectURL(fileImg)
          // 	} else {
          // 		this.couseDetailFiles[index].isAdd = false
          // 		this.couseDetailFiles[index].isDelete = true
          // 		this.couseDetailFiles[index].isChange = true
          // 		this.couseDetailFiles[index].url = window.URL.createObjectURL(fileImg)
          // 		// ??????????????????????????????????????????
          // 		this.couseDetailFiles[index+1].isAdd = true
          // 	}
          // }
        }
      },
      // ???????????????
      changeFile: function(index) {
        this.$refs['file' + index][0].click()
      },
      // ???????????????
      deleteFile: function(index) {
        // ???????????????????????????
        const target = this.couseDetailFiles
        target[index].url = ""
        // ?????????????????????????????????????????????????????????
        const coureImage = target.filter(element => {
          return element.url !== ""
        })
        const targetNumber = coureImage.length

        // ????????????????????????
        coureImage.forEach(function(element, index) {
          target[index].url = element.url
        });

        // ????????????????????????
        target[targetNumber].url = ""
        target[targetNumber].isAdd = true
        target[targetNumber].isDelete = false
        target[targetNumber].isChange = false

        // ?????????????????????????????????????????????????????????
        if(targetNumber !== 4) {
          target[targetNumber + 1].isAdd = false
        }

        // ???????????????????????????????????????
        this.validationNumber -= 1
        this.$emit('remove');
      }
    },
  }
</script>
