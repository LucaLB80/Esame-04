<?php

namespace App\Http\Requests\v1;

use App\Helpers\AppHelper;
use Illuminate\Foundation\Http\FormRequest;

class SerieUpdateRequest extends SerieStoreRequest
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
        $rules = parent::rules();
        return AppHelper::aggiornaRegoleHelper($rules);
    }
}
