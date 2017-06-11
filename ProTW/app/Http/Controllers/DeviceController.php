<?php

namespace App\Http\Controllers;


use App\Children;
use App\LicenceCodes;
use App\Monitoring;
use App\Notifications;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class DeviceController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function notification(Request $request){

        $id = $request->input("ID");
        $description = $request->input("NOTIF");
        if($description == "IMPORTANT!! Severe accident such as a car crash might have taken place!") $warningid=1;
        else if($description == "Warning! Possible fall") $warningid=2;
        else $warningid=3;
        $child=Children::where('device_id',$id)->first();

        if($child==null){
            return response('Wrong device id'.$id.' '.$description, 200)
                ->header('Content-Type', 'text/plain');
        }
        else{

            $user=Monitoring::where('id_child',$child['id'])->first();
            Notifications::create([
                'id_child' => $child['id'],
                'id_user' => $user['id'],
                'name' => $child['name'],
                'description' =>$description,
                'type' => 'accident',
                'accident_type' => $warningid,
                'location_x' =>$child['location_x'],
                'location_y' =>$child['location_y'],
                'happened_at' =>Carbon::now(),
            ]);

            \Session::flash('flash_message',$description);
            return response('New Notification!', 200)
                ->header('Content-Type', 'text/plain');
        }

    }

    public function checkDeviceId(Request $request){

        $id = $request->input('ID');
        $code=LicenceCodes::where('device_id',$id)->first();
        if($code==null){
            return response('Wrong device id!', 200)
                ->header('Content-Type', 'text/plain');
        }
        else
        {
            return response('You are now being tracked!', 200)
                ->header('Content-Type', 'text/plain');
        }
    }

    public function checkDeviceId2(Request $request){

        $id = $request->input('ID');
        $lat = $request->input('LAT');
        $long = $request->input('LONG');
        $child=Children::where('device_id',$id)->first();
        if($child!=null){
            $child->location_x=$lat;
            $child->location_y=$long;
            $child->save();
            return response('Updated', 200)
                ->header('Content-Type', 'text/plain');
        }
        else
        {
            return response('Wrong device ???'.$lat.' '.$long.' '.$id.' ', 200)
                ->header('Content-Type', 'text/plain');
        }
    }
}