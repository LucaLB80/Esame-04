<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class EpisodiStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
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
            "idSerie" => "required|integer|min:1|max:255|exists:serie,idSerie",
            "titolo" => "required|string|max:255",
            "numeroStagione" => "required|integer|min:1|max:255",
            "numeroEpisodio" => "required|integer|min:1|max:255",
            "durata" => "required|integer|min:1|max:255"
        ];
    }
}
