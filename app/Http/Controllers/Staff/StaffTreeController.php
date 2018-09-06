<?php

namespace App\Http\Controllers\Staff;

use App\User;
use App\UsersTree;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StaffTreeController extends Controller
{

    /**
     * Show page Tree Users
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff-tree.index');
    }

    /**
     * Return start ajax response with users 1 position
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            return response()->json(User::where('position_id', 1)
                ->with('position')->get());
        }
    }

    /**
     * Get users to pistition
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(UsersTree::where('user_parent_id', $id)
            ->with('childUsers')->get());
    }

}
