<?php

namespace App\Http\Controllers\Staff;

use App\Position;
use App\User;
use App\UsersTreePatch;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use function PHPSTORM_META\map;

class StaffTreeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//          $user = Position::where('id', 2)->with('users')->first();
//          dd($user);
//        $user = UsersTreePatch::where('user_parent_id', 1)->with('parentUsers','childUsers')->get();
//        dd($user);
//
//        foreach($user->childTreePatch as $key => $val){
//            dump($val);
//            dd($val->childUsers);
//        }
        return view('staff-tree.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->isJson()) {
            return response()->json(UsersTreePatch::where('user_parent_id', 1)->with('parentUsers','childUsers')->get());
//            return response()->json(User::where('position_id', 1)->with('childTreePatch')->first());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(UsersTreePatch::where('user_parent_id', $id)->with('childUsers')->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
