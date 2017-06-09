<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 10.06.2017
 * Time: 00:16
 */

namespace App\Http\Controllers;


use App\PointsOfInterest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            if($point==null)
                PointsOfInterest::create([
                    'id_user' =>Auth::user()->getAuthIdentifier(),
                    'id_child' =>$child,
                    'name' =>$nume,
                    'location_x'=>$lat,
                    'location_y'=>$long
                ]);
            else return  response("You alreade added this point", 200)
                ->header('Content-Type', 'text/plain');
        }
        return  response("We get the data", 200)
            ->header('Content-Type', 'text/plain');
    }

    public function childPointsOfInterest(Request $request){
        $id=$request->input('id');
        $points[]=PointsOfInterest::all()->where('id_user',Auth::user()->getAuthIdentifier())->where('id_child',$id);
        return $points;
    }

    public function deletePoint(Request $request){
        $id = $request->input("id");
        $data=PointsOfInterest::find($id);
        if($data==null)
            return  response($id, 200)
                ->header('Content-Type', 'text/plain');
        else
        $data->delete();
        return  response("Point deleted", 200)
            ->header('Content-Type', 'text/plain');
    }

}