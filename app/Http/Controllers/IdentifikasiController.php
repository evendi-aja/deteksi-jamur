<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IdentifikasiController extends Controller
{
    public function index(){

    	$data = [
    		'title' => 'Identifikasi'
    	];
    	return view('identifikasi', $data);
    }
}
