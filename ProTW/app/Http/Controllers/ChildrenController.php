<?php
/**
 * Created by PhpStorm.
 * User: Vladd
 * Date: 03.06.2017
 * Time: 15:34
 */

namespace App\Http\Controllers;


use App\Children;
use App\Http\Requests\AddChildrenRequest;
use App\LicenceCodes;
use App\Monitoring;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Request;
class ChildrenController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $redirectTo = '/index';

    public function addChild(){
        $message="Ok";
        return view('children.add-child')->with('message',$message);

    }

    public function addEChild(){
        $message="Ok";
        return view('children.add-existing-child')->with('message',$message);

    }


    public function monitorChildren(){
        $query="SELECT U.ID AS USER_ID ,C.ID AS CHILD_ID,C.NAME,C.AGE,C.GENDER,C.LOCATION_X,C.LOCATION_Y FROM CHILDREN C, MONITORING M, USERS U WHERE C.ID=M.ID_CHILD AND M.ID_USER=U.ID AND U.ID='";
        $query=$query.Auth::user()->getAuthIdentifier()."'";
        $children=DB::select($query);
        return view('children.monitor-children')->with('children',$children);
    }

    public function listChildren()
    {
        $query="SELECT U.ID AS USER_ID ,C.ID AS CHILD_ID,C.NAME,C.AGE,C.GENDER,C.LOCATION_X,C.LOCATION_Y FROM CHILDREN C, MONITORING M, USERS U WHERE C.ID=M.ID_CHILD AND M.ID_USER=U.ID AND U.ID='";
        $query=$query.Auth::user()->getAuthIdentifier()."'";
        $data[]=DB::select($query);

        return $data;
    }

    public function addNewChild(AddChildrenRequest $data)

    {
        $results=LicenceCodes::all()->where('device_id',$data['device_id']);


        if ($results==null)
        {
            $message="Invalid licence code";
            return view('children.add-child')->with('message',$message);
        }
        else
            foreach ($results as $result)
                if($result['used']==1)
                 {
                       $message="Child already monitored by someone else.Please use the other form";
                       return view('children.add-child')->with('message',$message);
                 }
             else {
            Children::create([
                'name' => $data['name'],
                'age' => $data['age'],
                'gender' => $data['gender'],
                'device_id' => $data['device_id'],
                'location_x' =>35,
                'location_y' =>24,
            ]);

            $result['used']=1;
            $result->save();

            $child=Children::all()->where('device_id',$data['device_id']);

            Monitoring::create([
                'id_user' => Auth::user()->getAuthIdentifier(),
                'id_child' =>$child[0]['id'],
            ]);
                 return Redirect::to('/index');
        }

    }


    public function addExistingChild()
    {
        $data=Request::all();
        $children=Children::all()->where('device_id',$data['device_id']);
        $results=LicenceCodes::all()->where('device_id',$data['device_id']);
        if ($results==null)
        {
            $message="Invalid licence code";
            return view('children.add-existing-child')->with('message',$message);
        }
        else
        {
            foreach ($results as $result){
                foreach ($children as $child) {
                    if ($result['used'] == 1) {
                        $rez=Monitoring::all()->where('id_child',$child['id'])->where('id_user',Auth::user()->id)->count();

                        if($rez!=0)
                        {
                            $message="You already monitor this child";
                            return view('children.add-existing-child')->with('message',$message);
                        }
                        else
                            {
                                Monitoring::create([
                                    'id_user' => Auth::user()->id,
                                    'id_child' => $child['id'],
                                ]);
                                return Redirect::to('/index');
                            }
                    } else {
                        $message = "No child monitored with this licence code.Use the other form to register one";
                         return view('children.add-existing-child')->with('message',$message);
                    }

                }
            }
        }
    }

}