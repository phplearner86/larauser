<?php

namespace App\Http\Controllers\User;

use App\Avatar;
use App\Http\Controllers\Controller;
use App\Profile;
use Illuminate\Http\Request;

class AvatarController extends Controller
{
    protected $avatarPath = 'images/avatars';

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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Avatar  $avatar
     * @return \Illuminate\Http\Response
     */
    public function show(Avatar $avatar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Avatar  $avatar
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        //return view('users.profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Avatar  $avatar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {


        $file = $request->filename;
        $filename = $profile->id . '-' . $file->getClientOriginalName();

        $profile->avatar ? unlink($this->avatarPath . '/' . $profile->avatar->filename) : "";
        $file->move($this->avatarPath, $filename);
        
        $avatar =  $profile->avatar ?: new Avatar();
        $avatar->filename = $filename;

        $profile->avatar()->save($avatar);

        return message('Avatar has been changed');
        
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Avatar  $avatar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Avatar $avatar)
    {
        //
    }
}
