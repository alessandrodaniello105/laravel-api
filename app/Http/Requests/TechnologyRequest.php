<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TechnologyRequest extends FormRequest
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
            'name' => 'required|min:2|max:75',
            'link' => 'max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Devi inserire un nome per poter creare/modificare una nuova Tecnologia',
            'name.min' => 'Il nome della nuova tecnologia deve avere almeno :min caratteri',
            'name.max' => 'Il nome della nuova tecnologia può avere al massimo :max caratteri',

            'link.max' => 'L\'indirizzo link può avere al massimo :max caratteri'
        ];
    }
}
