<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use App\Rules\ConfirmPassword;

class StoreUserRequest extends FormRequest
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
            'email'     => ['required', 'email', 'unique:users,email', 'max:255'],
            'name'      => ['required', 'string', 'max:255', 'unique:users,name'],
            'password'  => ['required', 'string', 'min:8', 'max:32', new ConfirmPassword],
            'confirm'   => ['required'],
            'country'   => ['required', 'string', 'max:32'],
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'    => 'El email es un campo obligatorio.',
            'email.email'       => 'El email no es un correo electrónico válido.',
            'email.unique'      => 'El email ya se encuentra en uso por otro usuario.',
            'email.max'         => 'El email no puede contener más de 255 caracteres.',
            'name.required'     => 'El nombre es un campo obligatorio.',
            'name.max'          => 'El nombre no puede contener más de 255 caracteres.',
            'name.unique'       => 'El nombre ya se encuentra en uso por otro usuario.',
            'password.required' => 'La contraseña es un campo obligatorio.',
            'password.min'      => 'La contraseña no puede contener menos de 8 caracteres.',
            'password.max'      => 'La contraseña no puede contener más de 32 caracteres.',
            'confirm.required'  => 'La confirmación de la contraseña es un campo obligatorio.',
            'country.required'  => 'El pais es un campo obligatorio.',
            'country.max'       => 'El pais no puede contener más de 32 caracteres.',
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
