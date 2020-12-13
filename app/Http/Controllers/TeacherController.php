<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Cancel;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use App\Http\Requests\Course\StoreRequest as CourseStoreRequest;
use App\Http\Requests\Course\UpdateRequest as CourseUpdateRequest;
use App\Http\Requests\Lesson\CancelRequest as LessonCancelRequest;
use App\Http\Requests\Lesson\StoreRequest as LessonStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    private $application;
    private $course;
    private $category;
    private $cancel;
    private $lesson;
    private $user;

    public function __construct(
        Application $application,
        Course $course,
        Category $category,
        Cancel $cancel,
        Lesson $lesson,
        User $user
    )
    {
        $this->application = $application;
        $this->course = $course;
        $this->category = $category;
        $this->cancel = $cancel;
        $this->lesson = $lesson;
        $this->user = $user;
    }

    /**
     * 講師一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        return view('teachers.index');
    }

    /**
     * カテゴリー一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function category(Request $request)
    {
        return view('teachers.category');
    }

    /**
     * 講師詳細
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail(Request $request)
    {
        return view('teachers.detail');
    }

    /**
     * コース一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function course(Request $request)
    {
        $courses = $this->course->findByUsersId(Auth::user()->id, $this->user::STATUS_TEACHER);

        return view('teachers.course', compact('courses'));
    }

    /**
     * コース作成ページ
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createCourse(Request $request)
    {
        $categories = $this->category->getAll();
        return view('teachers.course-create', compact('categories'));
    }

    /**
     * コースの登録処理
     *
     * @param CourseStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storeCourse(CourseStoreRequest $request)
    {
        $course = new Course();
        $course->user_id = Auth::user()->id;
        $course->title = $request->title;
        $course->detail = $request->detail;
        $course->saveCategories($request);
        $course->saveImgs($request);
        $course->save();
        return redirect(route('mypage.t.courses'));
    }

    /**
     * コース詳細
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function coursesDetail(Request $request)
    {
        $course = Course::query()->find($request->courses_id);
        $categories = $this->category->getAll();
        $lessons = $this->lesson->findByCoursesId($request->courses_id, Auth::user()->id);

        return view('teachers.course-detail', compact('course', 'categories', 'lessons'));
    }

    /**
     * コースの更新/削除
     *
     * @param CourseUpdateRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function updateCourses(CourseUpdateRequest $request)
    {
        $course = Course::query()->find($request->courses_id);
        if($request->has('save')) {
            // 更新
            $course->title = $request->title;
            $course->detail = $request->detail;
            $course->saveCategories($request);
            $course->saveImgs($request);
            $course->save();
        } elseif ($request->has('delete')) {
            // 削除
            DB::transaction(function () use ($course) {
                $course->deleteImgs();
                $this->lesson->deleteByCoursesId($course->id);
                $course->delete();
            });
        }
        return redirect(route('mypage.t.courses'));
    }

    /**
     * レッスン作成画面表示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function createLessons(Request $request)
    {
        $courses_id = $request->courses_id;
        $types = $this->lesson->getArrayTypes();
        return view('teachers.lesson-create', compact('courses_id', 'types'));
    }

    /**
     * レッスンの登録
     *
     * @param LessonStoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storeLessons(LessonStoreRequest $request)
    {
        $lesson = new Lesson();
        $lesson->fill([
            'user_id' => Auth::user()->id,
            'course_id' => $request->courses_id,
            'status' => $this->lesson::STATUS_PLANS,
            'number' => $request->number,
            'public' => 0,
            'type' => $request->type,
            'date' => $request->date,
            'start' => $request->start,
            'finish' => $request->finish,
            'price' => $request->price,
            'cancel_rate' => $request->cancel_rate,
            'title' => $request->title,
            'detail' => $request->detail,
        ])->save();

        return redirect(route('mypage.t.courses.detail', ['courses_id' => $request->courses_id]));
    }

    /**
     * レッスン参加状況画面表示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function lessonsParticipation(Request $request)
    {
        $lessons = $this->lesson->findByUsersIdGetApplicationCnt(Auth::user()->id);

        return view('teachers.lesson-participation', compact('lessons'));
    }

    /**
     * レッスン参加ユーザ一覧表示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function lessonParticipationUsers(Request $request)
    {
        $users = $this->user->findByLessonsId($request->lessons_id, Auth::user()->id);

        return view('teachers.lesson-participation-users', compact('users'));
    }

    /**
     * キャンセルリクエスト一覧表示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cancelRequests(Request $request)
    {
        $cancels = $this->cancel->findByUsersId(Auth::user()->id);

        return view('teachers.cancel-requests', compact('cancels'));
    }

    /**
     * キャンセル実行
     *
     * @param LessonCancelRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function doCancel(LessonCancelRequest $request)
    {
        DB::transaction(function () use ($request) {
            if ($request->has('save')) {
                // 承認
                foreach ($request->cancels as $id) {
                    $this->cancel->approvalCancel($id);
                }
            } else {
                // 拒否
                foreach ($request->cancels as $id) {
                    $this->cancel->rejectionCancel($id);
                }
            }
        });

        return redirect(route('mypage.t.cancel-requests'));
    }
}
