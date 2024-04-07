<?php

namespace App\Http\Requests\Auth;

use App\Traits\EmailPasswordRules;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Validator;

class LoginRequest extends FormRequest
{
    use EmailPasswordRules;

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "phone_number"   => ["regex:/^\+7 \(\d{3}\) \d{3}-\d{2}-\d{2}$/", 'string', 'required'],
        ];
    }


}
