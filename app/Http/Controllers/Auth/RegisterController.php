<?php

namespace App\Http\Controllers\Auth;

use App\Position;
use App\User;
use App\Http\Controllers\Controller;
use App\UsersTree;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/staff_list';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Index page register users
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegistrationForm()
    {
        return view('auth.register', [
            'positions' => Position::all()
        ]);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'surname' => 'required|string|max:30|min:3',
            'first_name' => 'required|string|max:30|min:3',
            'patronymic' => 'required|string|max:30|min:3',
            'position_id' => 'required|integer|exists:positions,id',
            'amount_of_wages' => 'required|numeric|between:3800,400000|regex:/^\d*(\.\d{1,2})?$/',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'surname' => $data['surname'],
            'first_name' => $data['first_name'],
            'patronymic' => $data['patronymic'],
            'position_id' => $data['position_id'],
            'amount_of_wages' => $data['amount_of_wages'],
            'email' => $data['email'],
            'date_engagement' => date('Y-m-d'),
            'password' => Hash::make($data['password']),
        ]);
        $this->selectBossFromPositions($data['position_id'], $user->id);

        return $user;
    }

    /**
     * Select boss from position new user and create to table UsersTreePatch
     *
     * @param $user_position_id
     * @param $user_id
     */
    protected function selectBossFromPositions($user_position_id, $user_id)
    {
        $position_id = $user_position_id - 1;
        if ($position_id > 0) {
            $boss = User::where('position_id', $position_id)->inRandomOrder()->first();
            ($boss) ? UsersTree::create(['user_parent_id' => $boss->id, 'user_child_id' => $user_id]) : '';
        }
        return;
    }
}
