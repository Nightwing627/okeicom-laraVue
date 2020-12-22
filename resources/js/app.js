import { createApp } from 'vue'
import App from './components/App.vue'
// 共通
import HeaderComponent from './components/common/headerComponent.vue'
import SidebarComponent from './components/common/sidebarComponent.vue'
import DatepickerLite from "vue3-datepicker";
// 検索
import SearchComponent from './components/search/indexComponent.vue'

// レッスン：一覧
import lessonIndexComponent from './components/lesson/indexComponent.vue'
// レッスン：詳細
import lessonShowComponent from './components/lesson/showComponent.vue'
// レッスン：予約
import lessonApplicationComponent from './components/lesson/applicationComponent.vue'

// 講師：一覧
import teacherIndexComponent from './components/teacher/indexComponent.vue'
// 講師：詳細
import teacherShowComponent from './components/teacher/showComponent.vue'

// レッスン：一覧
createApp({
	components:{
		App,
		// 共通
		'header-component': HeaderComponent,
		'sidebar-component': SidebarComponent,
		'vue-datapicker-lite': DatepickerLite,

		// 検索
		'search-component': SearchComponent,

		// レッスン：一覧
		'lesson-index-component': lessonIndexComponent,
		// レッスン：詳細
		'lesson-show-component': lessonShowComponent,

		// 講師：一覧
		'teacher-index-component': teacherIndexComponent,
		// 講師：詳細
		'teacher-show-component': teacherShowComponent,
	}
}).mount('#app')


// サンプル
// Vue.component('header-component', require('./components/common/headerComponent.vue').default);