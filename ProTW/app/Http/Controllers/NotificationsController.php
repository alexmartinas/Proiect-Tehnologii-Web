<?php

namespace App\Http\Controllers;

use App\Children;
use App\Interactions;
use App\Notifications;
use App\PointsOfInterest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Requests\ContactFormRequest;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class NotificationsController extends Controller
{

    public function index()
    {

        $pages=DB::table('notifications')->where('id_user',Auth::id())->orderBy('happened_at', 'DESC')->paginate(10);
        $x = Carbon::now();
        $update = 1;
        DB::table('notifications')->where('id_user',Auth::id())->update(['dynamic_added' => 1]);
        return view('notifications.notifications', compact('pages'),compact('x'));
    }

    public function listNotifications(){
        $data=DB::table('notifications')
            ->where('id_user',Auth::user()->getAuthIdentifier())
            ->get();

        return $data;
    }

    public function listByAccident(){
        $data=DB::table('notifications')
            ->where('id_user', Auth::user()->getAuthIdentifier())
            ->where('type', 'accident')
            ->get();
        return $data;
    }

    public function listByDistance(){
        $data=DB::table('notifications')
            ->where('id_user', Auth::user()->getAuthIdentifier())
            ->where('type', 'accident')
            ->get();
        return $data;
    }

    public function notification(Request $request){
        $idPoint=$request->input('idPoint');
        $idChild=$request->input('idChild');
        $child=Children::find($idChild);
        $point=PointsOfInterest::find($idPoint);
        if($request->input('poz')==0) {
            $description = $child['name'] . " out of " . $point['name'] . " range!";
            $type="Out of range";
        }
        else {
            $description = $child['name'] . " in " . $point['name'] . " range!";
            $type="Back in range";
        }
        Notifications::create([
            'id_child'=>$idChild,
            'id_user'=>Auth::user()->getAuthIdentifier(),
            'name'=>$child['name'],
            'description'=>$description,
            'type'=>$type,
            'accident_type'=>"None",
            'location_x'=>$child['location_x'],
            'location_y'=>$child['location_y'],
            'happened_at'=>Carbon::now(),
            'dynamic_added'=>0
        ]);

        return  response($description, 200)
            ->header('Content-Type', 'text/plain');

    }

    public function listByInteractions(){
        $data=DB::table('notifications')
            ->where('id_user', Auth::user()->getAuthIdentifier())
            ->where('type', 'accident')
            ->get();
        return $data;
    }

    public function setDynamic(){

        DB::table('notifications')->where('id_user',Auth::id())->update(['dynamic_added' => 1]);

    }

    public function compare($lat1, $lat2, $lat3, $lat4){

        $x = $lat1 - $lat3;
        if($x < 0 ) $x=$x*(-1);

        $y = $lat2 - $lat4;
        if($y < 0 ) $y=$y*(-1);

        $x=$x*100;
        $y=$y*100;

        if($x < 1 && $y < 1 ) return 1;
        return 0;
    }

    public function addChildrenNotification(){

        $data1=DB::table('children')->get();
        $data2=DB::table('children')->get();
        $data3=$data2;
        foreach( $data1 as $child1) {
            $data2 = $data3;
            foreach( $data2 as $child2) {

                if($this->compare($child1->location_x,$child1->location_y,$child2->location_x,$child2->location_y) == 1 && $child1->id != $child2->id){

                    $int1 = DB::table('interactions')->where('id_child',$child1->id)->get();
                    $OK = 1;
                    foreach( $int1 as $inn) {

                        if($inn->id_contact == $child2->id) $OK=0;
                    }

                    if($OK == 1 ){

                        Interactions::create([
                            'id_child' => $child1->id,
                            'id_contact' => $child2->id,
                            'location_x' => $child1->location_x,
                            'location_y' =>$child1->location_y,
                            'happened_at' => Carbon::now()
                        ]);

                        Interactions::create([
                            'id_child' => $child2->id,
                            'id_contact' => $child1->id,
                            'location_x' => $child2->location_x,
                            'location_y' =>$child2->location_y,
                            'happened_at' => Carbon::now()
                        ]);

                        $user = DB::table('monitoring')->where('id_child',$child1->id)->get();

                        foreach( $user as $tutore) {

                            Notifications::create([
                                'id_child' => $child1->id,
                                'id_user' => $tutore->id_user,
                                'name' => $child1->name,
                                'description' => $child1->name.' has interacted with '.$child2->name,
                                'type' => 'interaction',
                                'accident_type' => 4,
                                'location_x' => $child1->location_x,
                                'location_y' => $child1->location_y,
                                'happened_at' => Carbon::now(),
                                'dynamic_added' => 0
                            ]);

                        }
                        $user = DB::table('monitoring')->where('id_child',$child2->id)->get();

                        foreach( $user as $tutore) {

                            Notifications::create([
                                'id_child' => $child2->id,
                                'id_user' => $tutore->id_user,
                                'name' => $child2->name,
                                'description' => $child2->name.' has interacted with '.$child1->name,
                                'type' => 'interaction',
                                'accident_type' => 4,
                                'location_x' => $child2->location_x,
                                'location_y' => $child2->location_y,
                                'happened_at' => Carbon::now(),
                                'dynamic_added' => 0
                            ]);

                        }

                    }

                }
            }
        }

        echo "Gets here I guess";
    }


}
