<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class UserRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        $userId = $this->route('user');
        return [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . ($userId ? $userId->id : null),
            'password' => 'required|min:6'
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome é obrigatorio!',
            'email.required' => 'Campo email é obrigatorio!',
            'email.email' => 'Enviar um email válido!',
            'email.unique' => 'Email já cadastrado!',
            'password.required' => 'Campo senha é obrigatorio!',
            'password.min' => 'A senha tem que ter no mínimo :min caracteres!',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
      throw new HttpResponseException(response()->json([
        'status' => false,
        'erros' => $validator->errors()
      ], 422));
    }


}
