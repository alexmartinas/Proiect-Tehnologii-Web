<?php

namespace App\Http\Controllers;

use App\Notifications;
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

        $pages=DB::table('notifications')->where('id_user',Auth::id())->paginate(10);
        $x = Carbon::now();
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

    public function listByInteractions(){
        $data=DB::table('notifications')
            ->where('id_user', Auth::user()->getAuthIdentifier())
            ->where('type', 'accident')
            ->get();
        return $data;
    }
}
