<?php

namespace App\Http\Requests;

use App\Models\League;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AthleteResultStoreRequest extends FormRequest
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
            'proof_photo' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:20000'],
            'hours' => ['required', 'numeric'],
            'minutes' => ['required', 'numeric'],
            'seconds' => ['required', 'numeric'],
            'tenths' => ['required', 'numeric'],
            'workout_date' => ['required', 'date'],
            'comments' => ['required', 'string'],
        ];
    }
}
