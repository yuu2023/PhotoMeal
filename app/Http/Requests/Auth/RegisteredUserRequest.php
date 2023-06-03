<?php

namespace App\Http\Requests\Auth;

use App\Enums\VisibilityEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;
use Illuminate\Validation\Rules;

class RegisteredUserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:10'],
            'introduction' => ['nullable', 'string', 'max:160'],
            'icon_file' => ['nullable', 'image'],
            'area' => ['nullable', 'string', 'max:255'],
            'area_visibility' => ['nullable', new Enum(VisibilityEnum::class)],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }
}
