<?php

namespace App\Http\Requests;

use App\Enums\VisibilityEnum;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:10'],
            'introduction' => ['nullable', 'string', 'max:160'],
            'icon_file' => ['nullable', 'image'],
            'icon_change_flag' => ['required'],
            'area' => ['nullable', 'string', 'max:255'],
            'area_visibility' => ['nullable', new Enum(VisibilityEnum::class)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }
}
