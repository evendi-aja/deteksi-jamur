<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index(){
    	return view('register.index', [
    		'title' => 'Registrasi'
    	]);
    }

    public function store(Request $request){
    	$validatedData = $request->validate([
    		'name' => 'required|max:125',
    		'username' => 'required|min:3|max:125|unique:users',
    		'email' => 'required|email:dns|unique:users',
    		'password' => 'required|min:3|max:125'
    	]);

    	$validatedData['password'] = Hash::make($validatedData['password']);

    	User::create($validatedData);

    	return redirect('/login')->with('success', 'Registrasi berhasil!! Silahlak login.');
    }
}
