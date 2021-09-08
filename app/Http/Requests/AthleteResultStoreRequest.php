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
            'logo' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:20000'],
            'type' => ['required', 'string', Rule::in([League::TYPE_OPEN, League::TYPE_PRIVATE ])],
            'machine_type' => ['required', 'string', Rule::in([League::MACHINE_SKIING, League::MACHINE_BIKE, League::MACHINE_ROWING ])],
            'business' => ['required', 'string'], // @todo change to description in DB
            'category' => ['required', 'string', Rule::in ([League::TYPE_LIGHT_WEIGHT, League::TYPE_HEAVY_WEIGHT ])],
            'gender' => ['required', 'string', Rule::in(['male', 'female', 'other'])],
            'age' => ['required', Rule::in(League::AGE_GROUP)],
            'registration_start_date' => ['required', 'date'],
            'registration_expiration_date' => ['required', 'date'],
            'race_date' => ['required', 'date'],
            'allow_join' => ['required', Rule::in([0,1])],
            'athletes.*' => ['required', Rule::exists('users', 'id')]
        ];
    }
}
