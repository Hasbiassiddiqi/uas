<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $email = $request->email;
        $password = $request->password;
        $user = User::where('email', $email)->first();
        // dd($user);


        if (!$user) {
            return back()->withErrors([
                'email' => 'Tidak ada pengguna dengan email yang Anda masukkan.'
            ]);
        }
        if ($password === $user->password) {
            Auth::login($user);
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()->withErrors([
            'password' => 'Password yang Anda masukkan salah.'
        ]);
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required',
        ]);
        $email = $request->email;
        $password = $request->password;
        $user = User::create([
            'name' => $request->name,
            'email' => $email,
            'password' => $password,
        ]);

        Auth::login($user);

        return redirect()->route('login');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        return redirect()->route('dashboard');
    }
}