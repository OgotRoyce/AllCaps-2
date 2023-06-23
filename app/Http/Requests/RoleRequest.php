<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;

class RoleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $id = $this->route('id') ?: 0;
        // dd($id);

      $rules =[
            'first_name' => ['required'],
            'last_name' => ['required'],
            'email' => ['required'],
            'program' => ['required'],
            'password' => [
                Password::min(8)
                ->mixedCase()
                ->numbers()
                ->letters()
            ],
        ];
        
        if($id > 0){
            unset($rules['password']);
        }

        return $rules;
    }
}
