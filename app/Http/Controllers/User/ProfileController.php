<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Profile;
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
    public function show($userId)
    {
        $user = User::find($userId);

        if (request()->ajax()) 
        {
            return response([
                'user' => $user->load('profile', 'profile.subjects')
            ]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($userId)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $userId)
    {
        return $request->all();
        $user = User::find($userId);

        $request->validate(['name' => 'nullable']);

        //$user->createOrUpdateProfile($request);

        // if(request()->ajax()){
        //     return response(['profile' => $p]);
        // }
        
        $profile = $user->profile ?: new Profile();

        
        if ($request->name) 
        {
            $profile->name = $request->name;
        }

        $user->profile()->save($profile);

        if ($subjects = $request->subject_id) 
        {
            $profile->subjects()->attach($subjects);
        }

        if (request()->ajax()) 
        {
            return response([
                'user' => $user->load('profile', 'profile.subjects'),
                'message' => 'bla'
            ]);
        }

        //return back();
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
