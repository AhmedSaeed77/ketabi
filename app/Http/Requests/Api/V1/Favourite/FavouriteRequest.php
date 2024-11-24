<?php

namespace App\Http\Requests\Api\V1\Favourite;

use App\Http\Services\Api\V1\Favourite\Favouritable;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class FavouriteRequest extends FormRequest
{
    use Favouritable;
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
            'type' => ['required', Rule::in(array_keys($this->favouritables))],
            'id' => [
                'required',
                Rule::exists($this->input('type').'s', 'id'),
                Rule::unique('favourites', 'favouritable_id')
                    ->where('user_id', auth('api')->id())
                    ->where('favouritable_type', $this->favouritables[$this->input('type')])],
        ];
    }
}
