<?php

namespace App\Http\Requests\Transport;

use Illuminate\Foundation\Http\FormRequest;

class CreateTransportRequest extends FormRequest
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
            'driver_id' => ['required', 'string', 'exists:drivers,id'],
            'type' => ['integer', 'required'],
            'number' => ['required', 'string'],
            'model' => ['required', 'string'],
            'description' => ['string'],
            'free' => ['boolean', 'required'],
            'is_active' => ['boolean', 'required'],
            'capacity' => ['integer', 'required'],
            'volume_cm' => ['string', 'required'],
        ];
    }
}
