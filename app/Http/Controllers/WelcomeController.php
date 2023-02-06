<?php

namespace App\Http\Controllers;

use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
	{
		$rooms = Room::all()->take(4);
		$turism = DB::table('branches')->select('*')->where('branch_type_id','=','2')->take(4)->get();
		$guest_house = DB::table('branches')->select('*')->where('branch_type_id','=','1')->where('is_active','=','1')->take(6)->get();
		return view('welcome')->with(compact('rooms','turism','guest_house'));
	}
}
