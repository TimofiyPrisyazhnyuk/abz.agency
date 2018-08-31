<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\UserRequest;
use App\Position;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class StaffListController extends Controller
{

    /**
     * StaffListController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('staff-list.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
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
     * @throws \Exception
     */
    public function store(Request $request)
    {
        if ($request->ajax()) {
            return DataTables::of(User::with('position')->get())->toJson();
        }
        abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param User $staff_list
     * @return \Illuminate\Http\Response
     */
    public function show(User $staff_list)
    {
        return view('staff-list.show', ['user' => $staff_list]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $staff_list
     * @return \Illuminate\Http\Response
     */
    public function edit(User $staff_list)
    {
        return view('staff-list.edit', [
            'user' => $staff_list,
            'positions' => Position::all(),
            'boss' => User::where('position_id', $staff_list->position_id - 1)->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $staff_list
     * @return void
     */
    public function update(UserRequest $request, User $staff_list)
    {
//        dump($staff_list);
//        dd($request->all());
        $staff_list->update($request->except(['_token', '_method', 'id']));

        return redirect()->back();
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
