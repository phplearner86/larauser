<?php

namespace App\Http\Controllers\User;

use App\Day;
use App\Http\Controllers\Controller;
use App\Profile;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($userId)
    {
        $user = User::find($userId);

        return view('users.profiles.create', compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $userId)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($profileId)
    {
        $profile = Profile::find($profileId);

        if (request()->ajax())
        {
            return response([
                'profile' => $profile->load('days'),
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($profileId)
    {
        $profile = Profile::find($profileId);
        $days = Day::all();
        $roles = Role::all();

        return view('users.profiles.edit',with([
            'profile' => $profile,
            'days' => $days,
            'roles' => $roles,
        ]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update($profileId)
    {
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId)
    {
        //
    }

   


    
}
