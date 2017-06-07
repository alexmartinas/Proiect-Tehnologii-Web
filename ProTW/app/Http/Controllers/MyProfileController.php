<?php
/**
 * Created by PhpStorm.
 * User: Vladd
 * Date: 03.06.2017
 * Time: 17:01
 */

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;

class MyProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function update(array $data)
    {
        $user = Auth::user();

        $user->username = $data->username;
        $user->email = $data->email;

        if ( ! $data->password == '')
        {
            $user->password = bcrypt($data->password);
        }

        $user->save();

        Flash::message('Your account has been updated!');
        return Redirect::to('/index');
    }

    public function updateProfile(){

       return view('update');
    }
}