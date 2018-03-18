<?php

namespace App\Http\Controllers\Auth;

use App\ActivationToken;
use App\Events\Auth\EmailVerified;
use App\Events\Auth\TokenRequested;
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
        $user = User::findBy($request->email);

        ActivationToken::createNewFor($user);

        event(new TokenRequested($user));

        return $this->resent();
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

    protected function verified()
    {
        $response = message('Your Account is now active. Please signin to access site content');

        return redirect()->route('login')->with($response);
    }

    protected function resent()
    {
        $response = message('Please check in your inbox for the activation link');

        return back()->with($response);
    }
}
