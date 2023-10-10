<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'title' => 'required|max:50',
            'description' => 'required|string',
            'thumb' => 'required|image|max:5120',
            'creation_date' => 'required|date',
            'link' => 'required|string',
            'language' => 'required|string'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.max' => 'La lunghezza del titolo è di massimo 50 caratteri',
            'description.required' => 'La descrizione è obbligatoria',
            'thumb.required' => 'L\'immagine è obbligatoria',
            'thumb.max' => 'La dimensione massima dell\'immagine è di 5MB',
            'creation_date.required' => 'La data è obbligatoria',
            'link.required' => 'Il link è obbligatorio',
            'language.required' => 'La lingua è obbligatoria'
        ];
    }
}
