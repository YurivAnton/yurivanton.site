<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Worker;

class ReportController extends Controller
{
    public function show()
    {
        $customers = Customer::with('offices')->get();
        $workers = Worker::all();

        return view('dashboard', [
            'customers' => $customers,
            'workers' => $workers,
        ]);
    }
}
