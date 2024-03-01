<?php

namespace App\Http\Controllers;

use App\Http\Controllers\LatihController;
use App\Models\LatihModel;

use Illuminate\Http\Request;

class DataController extends Controller
{

    protected $LatihController;
    public function __construct()
    {
        $this->LatihModel = new LatihModel;
        $this->LatihController = new LatihController;
    }


    public function dataset()
    {

        $data = [
            'title' => 'Data Set',
            'latih' => $this->LatihModel->allData()
        ];
        return view('data/dataset', $data);
    }

    public function datalatih()
    {

        $data = [
            'title' => 'Data Latih',
            'latih' => $this->LatihController->getDataLatih()->toArray()
        ];
        // var_dump($data);
        // return;
        return view('data/datalatih', $data);
    }

    public function datatest()
    {

        $data = [
            'title' => 'Data Test',
            'latih' => $this->LatihController->getDataTest()->toArray()
        ];
        return view('data/datatest', $data);
    }
}
