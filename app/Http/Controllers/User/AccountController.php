<?php

namespace App\Http\Controllers\User;

use App\Events\Auth\AccountCreatedByAdmin;
use App\Http\Controllers\Controller;
use App\Http\Requests\AccountRequest;
use App\Role;
use App\User;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->ajax()) 
        {
            $users = User::all();
            return ['data' => $users->load('roles:name', 'profile')];
        }
    }

    public function accountsList()
    {
        $roles = Role::all();
        return view('users.accounts.index', compact('roles'));
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
     * @param  App\Http\Requests\AccountRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountRequest $request)
    {
        $user = User::createAccount($request);

        event(new AccountCreatedByAdmin($user, $request->password));

        return message('User has been created.');
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
        
        $revoke_roles_html = view('users.roles.partials._revokeRolesHtml', compact('user'))->render();

        return response([
            'user' => $user->load('roles'),
            'revoke_roles_html' => $revoke_roles_html,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.accounts.edit')->with([
            'user' => Auth::user()
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\AccountRequest  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(AccountRequest $request, $userId=null)
    {
        if (request()->ajax()) 
        {
            $user = User::find($userId);

            $user->updateAccount($request);

            return message('Account has been updated');
        }
        Auth::user()->updateAccount($request);

        return $this->updated();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($userId)
    {
        $user = User::find($userId);

        $user->delete();

        return message('User has been deleted');
    }

    protected function updated()
    {
        $response = message('Your account has been saved.');

        return back()->with($response);
    }
}
