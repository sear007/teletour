<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        $userId = auth()->user()->id;
        $revervation = Reservation::orderBy('id', 'desc')
            ->with(['branch', 'roomType'])
            ->whereuserAppId($userId)
            ->paginate('10');
        return view('user.index', ['reservation' => $revervation]);
    }
    public function logout(){
        Auth::logout();
        return redirect()->route('home');
    }
}