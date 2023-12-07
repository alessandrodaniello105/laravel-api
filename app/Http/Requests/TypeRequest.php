<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TypeRequest extends FormRequest
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
            'name' => 'required|min:2|max:30',
            'description' => 'max:100',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Devi inserire un nome per poter creare un nuovo Tipo',
            'name.min' => 'Il nome del nuovo Tipo deve avere almeno :min caratteri',
            'name.max' => 'Il nome del nuovo Tipo può avere al massimo :max caratteri',

            'description.max' => 'La descrizione può avere al massimo :max caratteri'
        ];
    }
}
