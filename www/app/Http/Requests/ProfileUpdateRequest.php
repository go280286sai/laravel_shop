<?php

namespace App\Http\Requests;

use App\Models\User;
use App\Models\User_description;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
            'new_password' => ['nullable', 'string', 'min:8'],
            'current_password' => ['current_password'],
            'phone' => ['required', 'digits_between:10,15',  Rule::unique(User_description::class)->ignore($this->user()->id, 'user_id')],
            'birthday' => ['date'],
            'gender_id' => ['numeric'],
        ];
    }
}
