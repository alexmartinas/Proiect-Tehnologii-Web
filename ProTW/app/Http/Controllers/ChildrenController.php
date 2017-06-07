<?php
/**
 * Created by PhpStorm.
 * User: Vladd
 * Date: 03.06.2017
 * Time: 15:34
 */

namespace App\Http\Controllers;


use App\Children;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ChildrenController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $redirectTo = '/index';


    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:1|max:255',
            'gender' => 'required|string',
            'device_id' => 'required|string|max:44|min:44|unique:children',
        ]);
    }

    public function addChild(){

        return view('add-child');

    }

    public function monitorChildren(){
        $query="SELECT U.ID AS USER_ID ,C.ID AS CHILD_ID,C.NAME,C.AGE,C.GENDER,C.LOCATION_X,C.LOCATION_Y FROM CHILDREN C, MONITORING M, USERS U WHERE C.ID=M.ID_CHILD AND M.ID_USER=U.ID AND U.ID='";
        $query=$query.Auth::user()->getAuthIdentifier()."'";
        $children=DB::select($query);
        return view('monitor-children')->with('children',$children);
    }

    public function listChildren()
    {
        $query="SELECT U.ID AS USER_ID ,C.ID AS CHILD_ID,C.NAME,C.AGE,C.GENDER,C.LOCATION_X,C.LOCATION_Y FROM CHILDREN C, MONITORING M, USERS U WHERE C.ID=M.ID_CHILD AND M.ID_USER=U.ID AND U.ID='";
        $query=$query.Auth::user()->getAuthIdentifier()."'";
        $data[]=DB::select($query);

        return $data;
    }

    protected function create(array $data)
    {

        return Children::create([
            'name' => $data['name'],
            'age' => $data['age'],
            'gender' => $data['gender'],
            'device_id' => $data['device_id'],
        ]);
    }

}