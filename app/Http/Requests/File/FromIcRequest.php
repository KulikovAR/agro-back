<?php

namespace App\Http\Requests\File;

use Illuminate\Foundation\Http\FormRequest;

class FromIcRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'id_1c' => ['string','required'],
            'file' => ['string','required'],
            'inn' => ['string','required', 'exists:users,inn'],
            'type' => ['string', 'required', 'in:Акт,Договор,Заявка'],
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'inn' => $this->route('inn'),
        ]);
    }
}
