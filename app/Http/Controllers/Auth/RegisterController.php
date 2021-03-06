<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\UserRequest;
use App\Position;
use App\User;
use App\Http\Controllers\Controller;
use App\UsersTree;
use Illuminate\Auth\Events\Registered;
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
     * Register Users
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function register(UserRequest $request)
    {
        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
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
            'password' => $data['password'],
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
