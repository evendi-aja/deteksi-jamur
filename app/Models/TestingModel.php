<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TestingModel extends Model
{
    public function allData(){
    	return DB::table('data_testing')->get();
    }
}
