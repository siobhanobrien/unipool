<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Trip;
//use App\Http\Requests;

class SearchController extends Controller
{
   	public function index(Request $request)
   	{
   		$trips = Trip::search($request->q)->get();

   		return view('search', [
   				'trips' => $trips,
   			]);
   	}
}
