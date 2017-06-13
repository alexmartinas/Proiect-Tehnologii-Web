<?php

namespace App\Http\Controllers;

use App\PointsOfInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class MyProfileController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void

     */
    protected $request;

    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->request = $request;
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
    protected function update()
    {
        $data=$this->request->all();
        $user = Auth::user();

        $user->name = $data['name'];
        $user->email = $data['email'];

        if ( ! $data['password'] == '')
        {
            $user['password'] = bcrypt($data['password']);
        }

        $user->save();

        return Redirect::to('/index');
    }

    public function updateLocation(Request $request){
        $lat=$request->input('location_x');
        $lng=$request->input('location_y');
        $user=Auth::user();
        $user['location_x']=$lat;
        $user['location_y']=$lng;
        $point=PointsOfInterest::all()->where('name',$user['name'])->first();

        if($point!=null)
        {
            $point['location_x']=$lat;
            $point['location_y']=$lng;
            $point->save();
        }

        $user->save();

        return  response("Location updated", 200)
            ->header('Content-Type', 'text/plain');
    }

    public function updateProfile(){

        return view('update');
    }
}
