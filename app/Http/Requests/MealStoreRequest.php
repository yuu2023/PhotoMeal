<?php

namespace App\Http\Requests;

use App\Enums\VisibilityEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class MealStoreRequest extends FormRequest
{
    protected $errorBag = 'mealError';

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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'shop_id' => ['nullable'],
            'title' => ['required', 'string', 'max:20'],
            'introduction' => ['nullable', 'string', 'max:500'],
            'photo_file' => ['required', 'image'],
            'visibility' => ['nullable', new Enum(VisibilityEnum::class)],
            'can_others_use' => ['required', 'boolean']
        ];
    }
}
