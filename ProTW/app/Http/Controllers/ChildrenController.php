<?php
/**
 * Created by PhpStorm.
 * User: Vladd
 * Date: 03.06.2017
 * Time: 15:34
 */

namespace App\Http\Controllers;


use App\Children;

class ChildrenController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addChild(){

        return view('add-child');

    }

    public function monitorChildren(){

        return view('monitor-children');
    }

}