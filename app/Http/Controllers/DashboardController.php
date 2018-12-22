<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
	/**
     * Return dashboard for loggedin user
     */
	
	public function index()
   	{
   		return view('dashboard');
   	}
}
