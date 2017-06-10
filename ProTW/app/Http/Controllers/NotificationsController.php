<?php

namespace App\Http\Controllers;

use App\Children;
use App\Notifications;
use App\PointsOfInterest;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
     {

         $pages=DB::table('notifications')->where('id_user',Auth::id())->paginate(10);
         return view('notifications.notifications', compact('pages'));
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
             $description = $child['name'] . "in " . $point['name'] . " range!";
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
             'happened_at'=>Carbon::now()
         ]);

         return  response($description, 200)
             ->header('Content-Type', 'text/plain');

     }



}
