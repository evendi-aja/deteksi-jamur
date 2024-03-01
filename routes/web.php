<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LatihController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TreeController;
use App\Http\Controllers\DataController;
use App\Http\Controllers\IdentifikasiController;
use App\Http\Controllers\TestingController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('test', [LatihController::class, 'pembagianData']);

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/tree', [LatihController::class, 'tree'])->middleware('auth');

Route::get('/hitungtesting', [LatihController::class, 'testing'])->middleware('auth');


// Route::get('/identifikasi', [IdentifikasiController::class, 'index'])->middleware('auth');

Route::get('/latih', [LatihController::class, 'index'])->middleware('auth');
// Route::get('/latih', [LatihController::class, 'panggil'])->middleware('auth');
// Route::get('/latih/perhitungan', [LatihController::class, 'perhitungan'])->middleware('auth');
Route::get('/latih/perhitunganpruning', [LatihController::class, 'panggil'])->middleware('auth');
Route::get('/identifikasi', [LatihController::class, 'identifikasi'])->middleware('auth');

Route::post('identifikasi', [LatihController::class, 'prosesidentifikasi'])->middleware('auth');

Route::post('updateboosting', [LatihController::class, 'boosting'])->middleware('auth');

Route::post('prosesboosting', function (Request $request) {
    $request->session()->flash($request->input('boosting'));
    $request->session()->put('status', 'boost');
    return redirect('prosesboosting');
})->middleware('auth');
Route::get('prosesboosting', [LatihController::class, 'prosesboosting'])->middleware('auth');

Route::get('/latih/hasilperhitunganpruning', [LatihController::class, 'hasilperhitunganpruning'])->middleware('auth');
Route::get('/latih/perhitunganpruning', [LatihController::class, 'panggil'])->middleware('auth');

Route::get('/latih/boosting', [LatihController::class, 'boosting'])->middleware('auth');

Route::get('/latih/perhitunganawal', [LatihController::class, 'perhitunganawal'])->middleware('auth');
Route::get('/latih/hasilperhitunganawal', [LatihController::class, 'hasilperhitunganawal'])->middleware('auth');
Route::get('/latih/hasilawal', [LatihController::class, 'hasilawal'])->middleware('auth');


Route::get('/testing', [TestingController::class, 'index'])->middleware('auth');
Route::get('/testing/akurasi', [TestingController::class, 'akurasi'])->middleware('auth');


Route::get('/data/dataset', [DataController::class, 'dataset'])->middleware('auth');
Route::get('/data/datalatih', [DataController::class, 'datalatih'])->middleware('auth');
Route::get('/data/datatest', [DataController::class, 'datatest'])->middleware('auth');

Route::get('/', [LoginController::class, 'index'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);
