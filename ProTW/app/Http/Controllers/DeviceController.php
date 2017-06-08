<?php
/**
 * Created by PhpStorm.
 * User: alex
 * Date: 08.06.2017
 * Time: 12:32
 */

namespace App\Http\Controllers;


use App\Children;
use App\Notifications;
use Carbon\Carbon;

class DeviceController
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

    public function location($lat,$long,$device)
    {
        $child=Children::where('device_id',$device)->first();
        if($child!=null){
            $child->location_x=$lat;
            $child->location_y=$long;
            $child->save();
            return response('Location updated', 200)
                ->header('Content-Type', 'text/plain');
        }
        else
            return response('Wrong device id', 405)
                ->header('Content-Type', 'text/plain');
    }

    public function notification($device,$description){

        $child=Children::where('device_id',$device)->first();
        if($child==null){
            return response('Wrong device id', 405)
                ->header('Content-Type', 'text/plain');
        }
        else{

            Notifications::create([
                'id_child' => $child['id'],
                'description' =>$description,
                'location_x' =>$child['location_x'],
                'location_y' =>$child['location_y'],
                'happened_at' =>Carbon::now()
            ]);
            return response('Notification added', 200)
                ->header('Content-Type', 'text/plain');
        }

    }


}