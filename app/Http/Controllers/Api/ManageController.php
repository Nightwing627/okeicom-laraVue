<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Manage\StoreRequest;
use App\Http\Resources\ManageResource;
use App\Http\Resources\SuccessResource;
use App\Models\Manage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ManageController extends Controller
{
    /**
     * 管理者一覧
     *
     * @param Request $request
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $manages = $query = Manage::all();
        return ManageResource::collection($manages);
    }

    /**
     * 管理者の登録
     *
     * @param StoreRequest $request
     * @return SuccessResource
     */
    public function store(StoreRequest $request)
    {
        $Manage = new Manage();
        $Manage->fill([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'authority' => $request->authority,
        ])->save();
        return new SuccessResource(null);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return ManageResource
     */
    public function show(int $id)
    {
        $manage = Manage::query()->find($id);
        return new ManageResource($manage);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
