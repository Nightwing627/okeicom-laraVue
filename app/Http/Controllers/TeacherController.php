<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Cancel;
use App\Models\Category;
use App\Models\Course;
use App\Models\Lesson;
use App\Models\Country;
use App\Models\Language;
use App\Models\Prefecture;
use App\Models\User;
use App\Models\Evaluation;
use App\Http\Requests\Course\StoreRequest as CourseStoreRequest;
use App\Http\Requests\Course\UpdateRequest as CourseUpdateRequest;
use App\Http\Requests\Lesson\CancelRequest as LessonCancelRequest;
use App\Http\Requests\Lesson\StoreRequest as LessonStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;

use Carbon\Carbon;

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
     * カテゴリー処理も含む
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $categories = $this->category->getAll(true);
        $params     = $request->all();
        $teachers   = $this->user->searchTeacher($params)->paginate(20);
        return view('teachers.index', compact('teachers', 'params', 'categories'));
    }
    /**
     * 並び替え
     *
     * @param Request $request
     */
    public function changeOrder(Request $request)
    {
        session(['order' => $request->input("order")]);
        return redirect(url()->previous());
    }

    /**
     * カテゴリー一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function category(Request $request,$category=null)
    {
        //一覧の表示数
        $limit=config('const.paginate.teacher');



        //カテゴリー取得
        $categories=Category::all();

        $users=$this->user->getTeachersList($request->input("sex"),$category);
        $count=$this->user->countTeachersList($request->input("sex"),$category);

        //ページング処理
        $page=(int)$request->input("page");
        if(!$page){
            $page=1;
        }
        $start=$limit*($page-1)+1;
        $end=$start+$limit;
        if($end>$count){
            $end=$count;
        }
        if($limit) {
            $page_cnt=floor($count/$limit)+1;
            if($count%$limit==0){
                $page_cnt--;
            }
        } else {
            $page_cnt = 1;
        }

        $selected_category=null;

        //カテゴリーある場合はここで内容取得
        if($category){
            $selected_category=Category::find($category);
        }

        $order=session('order',0);

        $new_users=new Collection();
        foreach ($users as $key => $value) {
            $new_users->push($value);
        }


        //表示
        return view('teachers.index',["users"=>$new_users,'categories'=>$categories,'count'=>$count,'order'=>$order,'sex'=>$request->input("sex"),'selected_category'=>$selected_category,'page'=>$page,'start'=>$start,'end'=>$end,'page_cnt'=>$page_cnt]);

    }

    /**
     * 講師詳細
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function detail($id)
    {
        // ユーザー詳細情報
        // $user = User::find($id);
        $user    = $this->user->show($id)->first();
        // dd($user);
        return view('teachers.detail', compact('user'));

        //取得
        // $user=User::where("id",$id)->where('status',User::STATUS_TEACHER)->first();
        // //無い場合は404としておく
        // if(!$user){
        //     abort(404);
        // }

        // //子要素取得
        // $user["count"]=$user->countEvaluations();
        // $user["ave"]=$user->averageEvaluationPoint();
        // if($user->category1_id){
        //     $user["cat1"]=Category::find($user->category1_id)->name;
        // }
        // if($user->category2_id){
        //     $user["cat2"]=Category::find($user->category2_id)->name;
        // }
        // if($user->category3_id){
        //     $user["cat3"]=Category::find($user->category3_id)->name;
        // }
        // if($user->category4_id){
        //     $user["cat4"]=Category::find($user->category4_id)->name;
        // }
        // if($user->category5_id){
        //     $user["cat5"]=Category::find($user->category5_id)->name;
        // }
        // if($user->country_id){
        //     $user["country"]=Country::where("id",$user->country_id)->value("name");
        // }
        // if($user->language_id){
        //     $user["lang"]=Language::where("id",$user->language_id)->value("name");
        // }
        // if($user->prefecture_id){
        //     $user["pref"]=Prefecture::where("id",$user->prefecture_id)->value("name");
        // }

        // //レッスン取得
        // $lessons=Lesson::where("user_id",$id)->where("status",Lesson::STATUS_PLANS)->where("public",0)->orderBy("date","asc")->get();
        // foreach ($lessons as $key => $lesson) {
        //     $course=Course::find($lesson->course_id);
        //     if($course){
        //         if($course->category1_id){
        //             $lesson["cat1"]=Category::find($course->category1_id)->name;
        //         }
        //         if($course->category2_id){
        //             $lesson["cat2"]=Category::find($course->category2_id)->name;
        //         }
        //         if($course->category3_id){
        //             $lesson["cat3"]=Category::find($course->category3_id)->name;
        //         }
        //         if($course->category4_id){
        //             $lesson["cat4"]=Category::find($course->category4_id)->name;
        //         }
        //         if($course->category5_id){
        //             $lesson["cat5"]=Category::find($course->category5_id)->name;
        //         }
        //         if($course->img1){
        //             $lesson["img"]=$course->img1;
        //         }
        //     }
        //     $lesson["price"]=number_format($lesson->price);
        //     //日付の整形はバックエンドしておく
        //     $lesson["date_format"]=Carbon::parse($lesson["date"])->isoFormat("MM/DD(ddd)");
        //     $lesson["start_format"]=Carbon::parse($lesson["start"])->format("H:i");
        //     $lesson["finish_format"]=Carbon::parse($lesson["finish"])->format("H:i");
        //     $lessons[$key]=$lesson;
        // }
        // //評価取得
        // $evalutions=Evaluation::where("user_teacher_id",$id)->orderBy("id","desc")->get();
        // foreach ($evalutions as $key => $evalution) {
        //     $evalution_user=User::find($evalution->user_student_id);
        //     if($evalution_user){
        //         $evalution["user_name"]=$evalution_user["name"];
        //         $evalution["user_img"]=$evalution_user["img"];
        //     }
        //     $evalution["date"]=substr($evalution["created_at"], 0,10);
        //     $evalutions[$key]=$evalution;
        // }
        // return view('teachers.detail',["user"=>$user,"lessons"=>$lessons,"evalutions"=>$evalutions]);
    }

    /**
     * コース一覧
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function course(Request $request)
    {
        // コース一覧を取得
        $courses = $this->course->findByUsersId(Auth::user()->id, $this->user::STATUS_TEACHER);
        // dd($courses);
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
        // dd($course);
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
        ddd('届いてるよ！');
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
