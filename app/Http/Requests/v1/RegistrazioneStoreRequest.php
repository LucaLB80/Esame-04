<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class RegistrazioneStoreRequest extends FormRequest
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
            'nome' => 'required|string|max:45',
            'cognome' => 'required|string|max:45',
            'user' => 'required|string|unique:contatti_auth,user',
            'psw' => 'required|string|min:8|max:45',
        ];
    }
    // Messaggi personalizzati
    public function messages()
    {
        return [
            'nome.required' => 'Il nome è obbligatorio.',
            'cognome.required' => 'Il cognome è obbligatorio.',
            'user.required' => 'L\'user è obbligatorio.',
            'user.unique' => 'Questo user è già registrato.',
            'psw.required' => 'La password è obbligatoria.',
            'psw.min' => 'La password deve avere almeno 8 caratteri.',
            'psw.max' => 'La password può avere massimo 45 caratteri.'
        ];
    }
}
