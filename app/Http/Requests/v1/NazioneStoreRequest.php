<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class NazioneStoreRequest extends FormRequest
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
            "nome" => "required|string|max:45",
            "continente" => "required|string| max:45",
            "iso" => "required|string|size:2",
            "iso3" => "required|string|size:3",
            "prefissoTelefonico" => "required|string|max:45"
        ];
    }
}
