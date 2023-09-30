<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;

class UpdateUserRequest extends FormRequest
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
        $id = $this->segment(3);
        return [
            'email'     => ['required', 'email', 'unique:users,email,'.$id, 'max:255'],
            'name'      => ['required', 'string', 'max:255', 'unique:users,name,'.$id],
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
