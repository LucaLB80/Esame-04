<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class SerieStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "idCategoria" => "required|integer|min:1|max:255|exists:categorie,idCategoria",
            "nome" => "required|string|max:255",
            "totaleStagioni" => "nullable|integer|min:0|max:255",
            "regista" => "nullable|string|max:45",
            "attori" => "nullable|string|max:45",
            "annoInizio" => "nullable|integer|min:0|max:65535",
            "annoFine" => "nullable|integer|min:0|max:65535"
        ];
    }
}
