<?php

namespace App\Http\Requests;

use App\Models\League;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LeagueStoreRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'string', Rule::in([League::TYPE_OPEN, League::TYPE_PRIVATE ])],
            'business' => ['required', 'string'],
            'category' => ['required', 'string', Rule::in([League::TYPE_LIGHT_WEIGHT, League::TYPE_HEAVY_WEIGHT ])],
            'gender' => ['required', 'string', Rule::in(['male', 'female', 'other'])],
            'age' => ['required', 'numeric'],
            'allow_join' => ['required', Rule::in([0,1])],
            'athletes.*' => ['required', Rule::exists('users', 'id')]
        ];
    }
}
