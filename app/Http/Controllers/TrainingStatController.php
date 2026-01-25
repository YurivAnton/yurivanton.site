<?php

namespace App\Http\Controllers;

use App\Models\TrainingStat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TrainingStatController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->validate([
            'mistakes' => 'required|integer',
            'time_seconds' => 'required|integer',
            'tasks_total' => 'required|integer',
        ]);

        TrainingStat::create([
            'user_id' => $user->id,
            'mistakes' => $data['mistakes'],
            'time_seconds' => $data['time_seconds'],
            'tasks_total' => $data['tasks_total'],
        ]);

        /* dd($request->all()); */

        return response()->json([
            'status' =>'ok',
        ]);
    }
}
