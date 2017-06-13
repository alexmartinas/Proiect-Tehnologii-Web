<?php
/**
 * Created by PhpStorm.
 * User: Vladd
 * Date: 03.06.2017
 * Time: 15:34
 */

namespace App\Http\Controllers;


use App\Children;
use App\GeofenceModel;
use App\Http\Requests\AddChildrenRequest;
use App\LicenceCodes;
use App\Monitoring;
use App\PointsOfInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
class ChildrenController extends Controller
{


    protected $request;

    public function __construct(\Illuminate\Http\Request $request)
    {
        $this->request = $request;
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
        $query="SELECT U.ID ,C.ID ,C.NAME,C.AGE,C.GENDER,C.LOCATION_X,C.LOCATION_Y FROM CHILDREN C, MONITORING M, USERS U WHERE C.ID=M.ID_CHILD AND M.ID_USER=U.ID AND U.ID='";
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
        $result=LicenceCodes::where('device_id',$data['device_id'])->first();


        if ($result==null)
        {
            $message="Invalid licence code";
            return view('children.add-child')->with('message',$message);
        }
        else
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
                $user=Auth::user();

                $child=Children::where('device_id',$data['device_id'])->first();
                Monitoring::create([
                    'id_user' => Auth::user()->getAuthIdentifier(),
                    'id_child' =>$child['id'],
                ]);

                PointsOfInterest::create([
                    'id_user' => $user['id'],
                    'id_child' => $child['id'],
                    'name' => $user['name'],
                    'location_x' => $user['location_x'],
                    'location_y' => $user['location_y'],
                    'in_out'=>1
                ]);
                $point=PointsOfInterest::where('location_x', $user['location_x'])->where('location_y', $user['location_y'])->where('id_child',$child['id'])->first();
                GeofenceModel::create([
                    'id_user' => $user['id'],
                    'id_child' => $child['id'],
                    'distance' => 0,
                    'id_point' =>$point['id']
                ]);

                \Session::flash('flash_message_add',"Child added to your monitoring list");
                return Redirect::to('/index');
            }

    }

    public function addExistingChild()
    {
        $data=$this->request->all();
        $child=Children::where('device_id',$data['device_id'])->first();
        $result=LicenceCodes::where('device_id',$data['device_id'])->first();
        if ($result==null)
        {
            $message="Invalid licence code";
            return view('children.add-existing-child')->with('message',$message);
        }
        else
        {
            if ($result['used'] == 1) {
                $rez=Monitoring::where('id_child',$child['id'])->where('id_user',Auth::user()->id)->first();
                if($rez!=null)
                {
                    $message="You already monitor this child";
                    return view('children.add-existing-child')->with('message',$message);
                }
                else
                {
                    $user=Auth::user();

                    Monitoring::create([
                        'id_user' => $user['id'],
                        'id_child' => $child['id'],
                    ]);

                    PointsOfInterest::create([
                        'id_user' => $user['id'],
                        'id_child' => $child['id'],
                        'name' => $user['name'],
                        'location_x' => $user['location_x'],
                        'location_y' => $user['location_y'],
                        'in_out'=>1
                    ]);
                    $point=PointsOfInterest::where('location_x', $user['location_x'])->where('location_y', $user['location_y'])->where('id_child',$child['id'])->first();
                    GeofenceModel::create([
                        'id_user' => $user['id'],
                        'id_child' => $child['id'],
                        'distance' => 0,
                        'id_point' =>$point['id']
                    ]);

                    \Session::flash('flash_message_add',"Child added to your monitoring list");

                    return Redirect::to('/index');
                }
            } else {
                $message = "No child monitored with this licence code.Use the other form to register one";
                return view('children.add-existing-child')->with('message',$message);
            }
        }
    }

    public function child($id){

        $query="SELECT * FROM POINTS_OF_INTEREST WHERE ID_USER=".Auth::user()->getAuthIdentifier()." AND ID_CHILD=".$id;
        $query=$query." UNION SELECT * FROM POINTS_OF_INTEREST WHERE NAME IN (SELECT NAME FROM USERS WHERE ID IN (SELECT ID_USER FROM MONITORING WHERE ID_CHILD=".$id." and id_user!=".Auth::user()->getAuthIdentifier()."))";
        $points=DB::select($query);
        $child=Children::find($id);
        $query="select * from users where id in(select id_user from monitoring where id_child=";
        $query=$query.$child['id'].")";
        $tutori=DB::select($query);
        return view('children.child')->with('child',$child)->with('points',$points)->with('tutori',$tutori);
    }

    public function childInfo(Request $request){
        $id=$request->input('id');
        $child=Children::find($id);
        return $child;
    }

    public function deleteChildPOST(Request $request){
        $id_device = $request->input("device_id");
        $id_child=DB::table('children')->where('device_id', $id_device)->pluck('id');
        Monitoring::where('id_child', $id_child)->where('id_user',Auth::id())->delete();
        PointsOfInterest::where('id_child', $id_child)->where('id_user',Auth::id())->delete();
        GeofenceModel::where('id_child', $id_child)->where('id_user',Auth::id())->delete();

        return Redirect::to('/index');

    }

    public function deleteChildGET(){

        $message="Ok";
        return view('children.deletechild')->with('message',$message);
    }


}