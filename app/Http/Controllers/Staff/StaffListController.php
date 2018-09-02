<?php

namespace App\Http\Controllers\Staff;

use App\Http\Requests\UserRequest;
use App\Position;
use App\User;
use App\UsersTree;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
        return view('staff-list.create', [
            'positions' => Position::all(),
            'boss' => User::where('position_id', 1)->get()
        ]);
    }


    /**
     * Save new user to DB and create relation with position
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveNewUser(UserRequest $request)
    {
        $newUser = User::create([
            'surname' => $request->input('surname'),
            'first_name' => $request->input('first_name'),
            'patronymic' => $request->input('patronymic'),
            'position_id' => $request->input('position_id'),
            'amount_of_wages' => $request->input('amount_of_wages'),
            'email' => $request->input('email'),
            'date_engagement' => date('Y-m-d'),
            'password' => $request->input('password'),
        ]);

        if ($newUser) {
            $position_id = $request->input('position_id') - 1;
            if ($position_id > 0) {
                $boss = User::where('position_id', $position_id)->inRandomOrder()->first();
                ($boss) ? UsersTree::create(['user_parent_id' => $boss->id, 'user_child_id' => $newUser->id]) : '';
            }

            return redirect()->route('staff_list.index')
                ->with('success', 'User created successfully!');
        }
        return redirect()->route('staff_list.index')
            ->with('warning', 'Problem create user, check your input data!');

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
        ($request->input('position_id') != $staff_list->position_id) ? $this->changeUsersBoss($staff_list) : false;
        ($staff_list->parentTree) ? $staff_list->parentTree->update(['user_parent_id' => $request->input('boss_id')]) : false;

        $staff_list->update($request->except(['_token', '_method', 'id', 'password_confirmation', 'boss_id']));
        if ($staff_list) {

            return redirect()->back()
                ->with('success', 'Success update user information');
        }
        return redirect()->back()
            ->with('warning', 'Problem with user updated information, check you input data');

    }

    /**
     * Change users Boss if current user has a child users
     *
     * @param $staff_list
     * @return bool
     */
    public function changeUsersBoss($staff_list)
    {
        $users = UsersTree::where('user_parent_id', $staff_list->id)->get();
        $bossId = User::where('position_id', $staff_list->position_id)->get(['id']);

        if (!$users->isEmpty()) {
            foreach ($users as $value) {
                $value->update(['user_parent_id' => $bossId->random()->id]);
            }
        }
        return true;
    }

    /**
     * Get boss from position user Ajax
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getBoss(Request $request)
    {
        if ($request->ajax()) {
            $bossPositionId = ($request->input('position_id') - 1 <= 0) ?
                false : $request->input('position_id') - 1;

            return response()->json(User::where('position_id', $bossPositionId)->get());
        }
        abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param User $staff_list
     * @return void
     * @throws \Exception
     */
    public function destroy(User $staff_list)
    {
        $this->changeUsersBoss($staff_list);
        UsersTree::where('user_parent_id', $staff_list->id)
            ->where('user_child_id', $staff_list->id)->delete();
        $staff_list->delete();

        if ($staff_list) {

            return redirect()->route('staff_list.index')
                ->with('success', 'This user deleted!');
        }
        return redirect()->route('staff_list.index')
            ->with('warning', 'Problem delete user, application have small mistake!');
    }
}
