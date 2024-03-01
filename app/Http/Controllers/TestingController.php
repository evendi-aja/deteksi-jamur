<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestingModel;

class TestingController extends Controller
{
    public function __construct(){
        $this->TestingModel = new TestingModel;
    }


    public function index(){

    	$data = [
    		'title' => 'Data Testing',
            'testing' => $this->TestingModel->allData()
    	];
    	return view('testing.index', $data);
    }

    public function akurasi(){

    	$data = [
    		'title' => 'Akurasi',
            'testing' => $this->TestingModel->allData()
    	];
    	return view('testing.akurasi', $data);
    }
}
