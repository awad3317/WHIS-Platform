<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('pages.employees.index');
    }
    public function create()
    {
        return view('pages.employees.create');
    }
}