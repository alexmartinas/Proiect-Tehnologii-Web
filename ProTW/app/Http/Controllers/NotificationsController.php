<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class NotificationsController extends Controller
{

     public function index()
     {

         $pages=DB::table('notifications')->where('id_user',Auth::id())->paginate(10);
         return view('notifications.notifications', compact('pages'));
     }



}
