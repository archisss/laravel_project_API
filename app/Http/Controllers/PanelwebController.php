<?php

namespace App\Http\Controllers;

use DB;
use App\Parking;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PanelwebController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $parkings = Parking::all();
            return view('panel.options', compact('user','parkings'));
        }else {
            return view('/home');
        }

    }
}
