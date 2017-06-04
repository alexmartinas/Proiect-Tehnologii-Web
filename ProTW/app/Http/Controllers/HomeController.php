<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query="SELECT U.ID AS USER_ID ,C.ID AS CHILD_ID,C.NAME,C.AGE,C.GENDER,C.LOCATION_X,C.LOCATION_Y FROM CHILDREN C, MONITORING M, USERS U WHERE C.ID=M.ID_CHILD AND M.ID_USER=U.ID AND U.ID='";
        $query=$query.Auth::user()->getAuthIdentifier()."'";
        $children=DB::select($query);
        return view('index',compact('children'));
    }

}
