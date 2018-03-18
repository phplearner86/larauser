<?php

namespace App\Http\Requests;

use App\Rules\EmailUnverified;
use App\User;
use Illuminate\Foundation\Http\FormRequest;

class ActivationTokenRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = User::whereEmail($this->email)->firstOrFail();

        return [
            'email'=>[
                'required',
                'email',
                'exists:users,email',
                new EmailUnverified($user),
            ], 
        ];
    }
}
