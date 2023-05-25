<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Province;
use App\Models\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WelcomeController extends Controller
{
    public function index()
	{
		$turism = DB::table('branches')->select('*')->where('branch_type_id','=','2')->take(4)->get();
		$turism = Branch::orderBy('id','desc')
			->whereBranchTypeId(2)
			->take(4)
			->get();
		$destination = Province::whereIsPopular(1)
			->whereIsActive(1)
			->limit(4)
			->orderBy('id', 'desc')
			->get();
		$guest_house = Branch::orderBy('id','desc')
			->whereHas('rooms')
			->whereBranchTypeId(1)
			->whereIsActive(1)
			->take(4)
			->get();
		return view('welcome')->with(compact('turism','guest_house', 'destination'));
	}
}
