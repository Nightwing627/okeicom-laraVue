<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\Course;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ユーザー一覧を取得
        $userNew = new User();
        $users = $userNew->userList();
        return $users;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user = User::where('id', $user->id)->first();
        // 画像以外処理
        $user->update([
            'name'           => $request['name'],
            'country_id'     => $request['country_id'],
            'language_id'    => $request['language_id'],
            'prefecture_id'  => $request['prefecture_id'],
            'commition_rate' => number_format($request['commition_rate']),
            'email'          => $request['email'],
            // 'category1_id'   => $request['category1_id'],
            // 'category2_id'   => $request['category2_id'],
            // 'category3_id'   => $request['category3_id'],
            // 'category4_id'   => $request['category4_id'],
            // 'category5_id'   => $request['category5_id'],
            'profile'        => $request['profile'],
        ]);
        // カテゴリー保存処理
        $user->saveCategories($request);
        // 画像保存処理
        $user->saveImgs($request);
        $user->save();
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
    }
}
