<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectsRequest extends FormRequest
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
            'title' => 'required|string|max:100|min:5',
            'text' => 'required|string|min:10',
            'path_image' => 'image|mimes:png,jpg|max:5120'
        ];
    }



    public function messages(): array
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una stringa',
            'title.max' => 'Il titolo non può superare i :max caratteri',
            'title.min' => 'Il titolo deve essere di almeno :min caratteri',
            'text.required' => 'La descrizione è obbligatoria',
            'text.string' => 'La descrizione deve essere una stringa',
            'text.min' => 'La descrizione deve essere di almeno :min caratteri',
            'path_image.image' => 'Il file caricato deve essere un\'immagine',
            'path_image.mimes' => 'Il file caricato deve essere un\'immagine di tipo :values',
            'path_image.max' => 'Il file caricato non può superare i :max KB',
        ];
    }
}
