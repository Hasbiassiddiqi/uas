<?php

namespace App\Http\Controllers;

use App\Models\Membership;
use App\Models\User;
use Illuminate\Http\Request;

class MembershipController extends Controller
{
    public function index()
    {
        $memberships = Membership::with('user')->get();
        return view('memberships.index', compact('memberships'));
    }

    public function create()
    {
        $users = User::all();
        return view('memberships.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'points' => 'required|integer',
            'total_purchases' => 'required|numeric',
        ]);

        Membership::create($request->all());

        return redirect()->route('memberships.index')
            ->with('success', 'Membership created successfully.');
    }

    public function show(Membership $membership)
    {
        return view('memberships.show', compact('membership'));
    }

    public function edit(Membership $membership)
    {
        $users = User::all();
        return view('memberships.edit', compact('membership', 'users'));
    }

    public function update(Request $request, Membership $membership)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'points' => 'required|integer',
            'total_purchases' => 'required|numeric',
        ]);

        $membership->update($request->all());

        return redirect()->route('memberships.index')
            ->with('success', 'Membership updated successfully.');
    }

    public function destroy(Membership $membership)
    {
        $membership->delete();

        return redirect()->route('memberships.index')
            ->with('success', 'Membership deleted successfully.');
    }
}