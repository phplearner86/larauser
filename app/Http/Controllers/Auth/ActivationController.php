<?php

namespace App\Http\Controllers\Auth;

use App\ActivationToken;
use App\Events\Auth\EmailVerified;
use App\Http\Controllers\Controller;
use App\Http\Requests\ActivationTokenRequest;
use App\User;
use Illuminate\Http\Request;

class ActivationController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest');

        $this->middleware('token.valid')->only('show');
    }

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
        return view('auth.tokens.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivationTokenRequest $request)
    {
        $user = User::whereEmail($request->email)->firstOrFail();

        ActivationToken::createNewFor($user);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ActivationToken  $activationToken
     * @return \Illuminate\Http\Response
     */
    public function show(ActivationToken $activationToken)
    {

        $activationToken->user->verifyEmail();

        event(new EmailVerified($activationToken->user));

        return $this->verified();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ActivationToken  $activationToken
     * @return \Illuminate\Http\Response
     */
    public function edit(ActivationToken $activationToken)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ActivationToken  $activationToken
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ActivationToken $activationToken)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ActivationToken  $activationToken
     * @return \Illuminate\Http\Response
     */
    public function destroy(ActivationToken $activationToken)
    {
        //
    }

    protected function verified()
    {
        $response = message('Your Account is now active. Please signin to access site content');

        return redirect()->route('login')->with($response);
    }
}
