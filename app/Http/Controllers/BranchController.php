<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function show($id){
        $branch = Branch::with('rooms')->whereId($id)->first();
        return view('branch.show', [
            'branch' => $branch
        ]);
    }
}
