import { createApp } from 'vue'
import App from './components/App.vue'

// 共通
import HeaderComponent from './components/common/headerComponent.vue'
import HeaderUserComponent from './components/common/headerUserComponent.vue'
import SidebarComponent from './components/common/sidebarComponent.vue'
import DatepickerLite from "vue3-datepicker"

// 検索
import SearchComponent from './components/search/indexComponent.vue'

// レッスン：一覧
import LessonIndexComponent from './components/lesson/indexComponent.vue'
// レッスン：詳細
import LessonShowComponent from './components/lesson/showComponent.vue'

// 講師：一覧
import TeacherIndexComponent from './components/teacher/indexComponent.vue'
// 講師：詳細
import TeacherShowComponent from './components/teacher/showComponent.vue'

// 固定ページ：受講者よくある質問
import PageFaqUserComponent from './components/page/faqUserComponent.vue'
// 固定ページ：講師よくある質問
import PageFaqTeacherComponent from './components/page/faqTeacherComponent.vue'

// 共通管理画面：メッセージ
import UserMessageComponent from './components/user/messageComponent.vue'
// 共通管理画面：プロフィール
import UserProfileComponent from './components/user/profileComponent.vue'

// 受講者管理画面：受講済みレッスン一覧
import UserLessonComponent from './components/user/lessonComponent.vue'

// 管理者画面：ユーザー編集
import AdminEditUser from './components/admin/editUserComponent.vue'
// 管理者画面：ユーザー新規追加
import AdminCreateUser from './components/admin/createUserComponent.vue'
// 管理画面：コース詳細
import AdminUserShowCourse from './components/admin/showCourseComponent.vue'

// レッスン：一覧
createApp({
	components:{
		App,
		// 共通
		'header-component': HeaderComponent,
		'header-user-component': HeaderUserComponent,
		'sidebar-component': SidebarComponent,
		'vue-datapicker-lite': DatepickerLite,

		// 検索
		'search-component': SearchComponent,

		// レッスン：一覧
		'lesson-index-component': LessonIndexComponent,
		// レッスン：詳細
		'lesson-show-component': LessonShowComponent,

		// 講師：一覧
		'teacher-index-component': TeacherIndexComponent,
		// 講師：詳細
		'teacher-show-component': TeacherShowComponent,

		// 受講者よくある質問
		'page-faq-user-component': PageFaqUserComponent,
		// 講師よくある質問
		'page-faq-teacher-component': PageFaqTeacherComponent,

		// 共通管理画面：メッセージ
		'user-message-component' : UserMessageComponent,
		// 共通管理画面：プロフィール
		'user-profile-component' : UserProfileComponent,

		// 受講者管理画面：受講済みレッスン一覧
		'user-lesson-component' : UserLessonComponent,

		// 管理画面：ユーザー編集
		'admin-user-edit-component' : AdminEditUser,
		// 管理画面：ユーザー新規追加
		'admin-user-create-component' : AdminCreateUser,
		// 管理画面：コース詳細
		'admin-user-show-course-component' : AdminUserShowCourse,
	}
}).mount('#app')


// サンプル
// Vue.component('header-component', require('./components/common/headerComponent.vue').default);