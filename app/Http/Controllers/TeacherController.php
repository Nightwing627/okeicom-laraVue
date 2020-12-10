<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\User;
use App\Http\Requests\Course\StoreRequest as CourseStoreRequest;
use App\Http\Requests\Course\UpdateRequest;
use App\Http\Requests\Lesson\StoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    private $course;
    private $category;
    private $lesson;
    private $user;

    public function __construct(
        Course $course,
        Category $category,
        Lesson $lesson,
        User $user
    )
    {
        $this->course = $course;
        $this->category = $category;
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
     * @param UpdateRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function updateCourses(UpdateRequest $request)
    {
        $course = Course::query()->find($request->courses_id);
        if($request->has('save')) {
            $course->title = $request->title;
            $course->detail = $request->detail;
            $course->saveCategories($request);
            $course->saveImgs($request);
            $course->save();
        } elseif ($request->has('delete')) {
            $course->deleteImgs();
            $course->delete();
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
     * @param StoreRequest $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function storeLessons(StoreRequest $request)
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
        return view('teachers.lesson-participation');
    }

    /**
     * レッスン参加ユーザ一覧表示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function lessonParticipationUsers(Request $request)
    {
        return view('teachers.lesson-participation-users');
    }

    /**
     * キャンセルリクエスト一覧表示
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function cancelRequests(Request $request)
    {
        return view('teachers.cancel-requests');
    }
}
