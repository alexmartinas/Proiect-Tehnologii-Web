<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10.06.2017
 * Time: 00:16
 */

namespace App\Http\Controllers;


use App\GeofenceModel;
use App\PointsOfInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PointsOfInterestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $redirectTo = '/index';

    public function addPoints(Request $request){
        $nume = $request->input("name");
        $lat = $request->input("lat");
        $long = $request->input("lng");
        $children=$request->input("children");
        foreach ($children as $child)
        {
            $point=PointsOfInterest::where('location_x',$lat)->where('location_y',$long)->where('id_child',$child)->first();
            if($point==null) {
                PointsOfInterest::create([
                    'id_user' => Auth::user()->getAuthIdentifier(),
                    'id_child' => $child,
                    'name' => $nume,
                    'location_x' => $lat,
                    'location_y' => $long,
                    'in_out'=>1

                ]);
                $point=PointsOfInterest::where('location_x',$lat)->where('location_y',$long)->where('id_child',$child)->first();
                GeofenceModel::create([
                    'id_user' => Auth::user()->getAuthIdentifier(),
                    'id_child' => $child,
                    'distance' => 0,
                    'id_point' =>$point['id'],
                ]);
            }
            else return  response("You alreade added this point", 200)
                ->header('Content-Type', 'text/plain');
        }
        return  response("We get the data", 200)
            ->header('Content-Type', 'text/plain');
    }

    public function childPointsOfInterest(Request $request){
        $id=$request->input('id');
        $query="SELECT * FROM POINTS_OF_INTEREST WHERE ID_USER=".Auth::user()->getAuthIdentifier()." AND ID_CHILD=".$id;
        $query=$query." UNION SELECT * FROM POINTS_OF_INTEREST WHERE NAME IN (SELECT NAME FROM USERS WHERE ID IN (SELECT ID_USER FROM MONITORING WHERE ID_CHILD=".$id." and id_user!=".Auth::user()->getAuthIdentifier()."))";
        $points=DB::select($query);
        return $points;
    }

    public function childGeofences(Request $request){
        $id=$request->input('id');
        $query="select * from geofences where id_point in";
        $query=$query." (SELECT id FROM POINTS_OF_INTEREST WHERE ID_USER=".Auth::user()->getAuthIdentifier()." AND ID_CHILD=".$id;
        $query=$query." UNION SELECT id FROM POINTS_OF_INTEREST WHERE NAME IN (SELECT NAME FROM USERS WHERE ID IN (SELECT ID_USER FROM MONITORING WHERE ID_CHILD=".$id." and id_user!=".Auth::user()->getAuthIdentifier().")))";
        $points=DB::select($query);
        return $points;
    }

    public function deletePoint(Request $request){
        $id = $request->input("id");
        $point=PointsOfInterest::find($id);
        $geofence=GeofenceModel::where('id_point',$id)->first();
        if($point!=null){
            $point->delete();
        }
        if($geofence!=null){
            $geofence->delete();
        }
        return  response("Point deleted", 200)
            ->header('Content-Type', 'text/plain');
    }

    public function setGeofences(Request $request)
    {
        $distanta= $request->input('distance');
        $idCopil= $request->input('idChild');
        $points=$request->input('points');
        foreach ($points as $point){
            $data=GeofenceModel::where('id_point',$point)->where('id_user',Auth::user()->getAuthIdentifier())->where('id_child',$idCopil)->first();
            if($data!=null){
                $data['distance']=$distanta;
                $data->save();
            }
        }
        return  response("Geofences updated", 200)
            ->header('Content-Type', 'text/plain');

    }

}