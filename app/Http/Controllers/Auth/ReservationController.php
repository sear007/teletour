<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function store(Request $request){
        try {
            $data = $request->all();
            $data['user_app_id'] = auth()->user()->id;
            $data['tele_chat_id'] = auth()->user()->telegram_id;
            Reservation::create($data);
            return response()->json([
                'success' => true,
                'data' => $data,
            ]);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json([
                'success' => false,
            ]);
        }
    }
}
