<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_users' => 1250,
            'revenue' => 45231,
            'orders' => 845,
            'growth' => 25.3
        ];
        
        return view('dashboard', compact('stats'));
    }
}