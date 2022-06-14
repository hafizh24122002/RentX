<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Buyer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterRequest;

class RegisterController extends Controller
{
    /**
     * Display register page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('register.index', [
            'title' => 'Register'
        ]);
    }

    /**
     * Handle account registration request
     *
     * @param RegisterRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name'=>'required|max:255',
            'username' => 'required|unique:users',
            'password' => 'required|min:8',
            'email' => 'required|email:rfc,dns|unique:users',
        ]);

        $request->validate([
            'repassword' => 'required|same:password'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        $user = User::firstWhere('username', $validatedData['username']);
        $data['user_id'] = $user->id;
        Buyer::create($data);

        return redirect('/login')->with('success', "Account successfully registered.");
    }
}
