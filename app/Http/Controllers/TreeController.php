<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TreeController extends Controller
{
    public function index(){

    	$data = [
    		'title' => 'Pohon Keputusan'
    	];
    	return view('tree', $data);
    }
}
