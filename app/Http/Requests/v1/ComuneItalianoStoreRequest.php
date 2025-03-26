<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class ComuneItalianoStoreRequest extends FormRequest
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
            "comune" => "required|string|max:50",
            "regione" => "required|string|max:50",
            "provincia" => "required|string|max:50",
            "sigla_provincia" => "required|string|size:2",
            "cap" => "required|string|max:10"
        ];
    }
}
