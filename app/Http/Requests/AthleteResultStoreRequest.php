<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AthleteResultStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'proof_photo' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:20000'],
            'type' => ['required'],
            'weight_class' => ['required'],
            'hours' => ['required', 'numeric'],
            'minutes' => ['required', 'numeric'],
            'seconds' => ['required', 'numeric'],
            'tenths' => ['required', 'numeric'],
            'distance' => ['required', 'numeric'],
            'workout_date' => ['required', 'date'],
            'comments' => ['required', 'string'],
        ];
    }
}
