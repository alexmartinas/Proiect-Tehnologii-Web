<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 03.06.2017
 * Time: 15:24
 */

namespace App\Http\Controllers;


use App\Children;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChildrenController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function listChildren()
    {
        $query="SELECT U.ID AS USER_ID ,C.ID AS CHILD_ID,C.NAME,C.AGE,C.GENDER,C.LOCATION_X,C.LOCATION_Y FROM CHILDREN C, MONITORING M, USERS U WHERE C.ID=M.ID_CHILD AND M.ID_USER=U.ID AND U.ID='";
        $query=$query.Auth::user()->getAuthIdentifier()."'";
        $data[]=DB::select($query);

        return $data;
    }

   


}
