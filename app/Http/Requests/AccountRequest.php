<?php

namespace App\Http\Requests;

use App\Rules\differentFromName;
use Illuminate\Foundation\Http\FormRequest;

class AccountRequest extends FormRequest
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
        return [
            'role_id' => 'exists:roles,id',
            'name' => 'required|string|alpha_num|max:30',
            'email' => 'required|string|email|max:100|unique:users,email',
            'password' => [
                'required', 'string', 'min:6',
                new differentFromName($this->name, $this->password)
            ],
        ];
    }
}
