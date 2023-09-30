<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class LoginAuthRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'email'     => ['required', 'email'],
            'password'  => ['required', 'string', 'min:8', 'max:32'],
        ];
    }

    public function message(): array
    {
        return [
            'email.required' => 'El email es un campo obligatorio.',
            'email.email' => 'El email no es un correo electrónico válido.',
            'password.required' => 'El password es un campo obligatorio.',
            'password.min'      => 'La contraseña no puede contener menos de 8 caracteres.',
            'password.max'      => 'La contraseña no puede contener más de 32 caracteres.',
        ];
    }

    protected function failedValidation(Validator $validator): JsonResponse
    {
        throw new HttpResponseException(
            response()->json([
                'errors' => $validator->errors(),
            ], 422)
        );
    }
}
