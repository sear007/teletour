<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Support\Facades\DB;

class RoomController extends Controller
{
    public function index()
	{
		$branch = Branch::all()->take(6);
		return view('rooms.index')->with(compact('branch'));
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function room_detail($id)
	{
		$guest_house = DB::table('branches')->select('branches.name','branches.short_description','room_types.description','branches.photo')
						->join('room_types','branches.id','=','room_types.branch_id')
						->where('branches.id','=',$id)
						->where('branches.branch_type_id','=','1')
						->where('branches.is_active','=','1')
						->groupby('branches.id')
						->get();
		$available = DB::table('branches')->where('ordering','!=','2')->where('id','=',$id)->count();
		return view('rooms.room_detail')->with(compact('guest_house','available'));
	}
}
