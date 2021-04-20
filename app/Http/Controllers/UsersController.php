<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::get();
        $count = $users->count();
        return view('users.index', compact('users', 'count'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->only('firstName', 'secondName', 'middleName', 'debt');
        $stateFee = $this->calcStateFee($user['debt']);
        $user['stateFee'] = $stateFee;
        //dd($user);
        User::create($user);
        return redirect()->route('users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.form', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $newUserData = $request->only(['firstName', 'secondName', 'middleName', 'debt']);
        $stateFee = $this->calcStateFee($newUserData['debt']);
        $newUserData['stateFee'] = $stateFee;
        $user->update($newUserData);
        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index');
    }

    /**
     * Calc stateFee of debt sum.
     *
     * @param float $debt
     * @return float
     */
    protected function calcStateFee(float $debt = 0)
    {
        $stateFee = $debt / 100 * 13;
        $stateFee = number_format($stateFee,2,'.','');
        return $stateFee;
    }
}
