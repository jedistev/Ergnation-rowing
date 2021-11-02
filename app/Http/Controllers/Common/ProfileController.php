<?php

namespace App\Http\Controllers\Common;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'firstname' =>['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(auth()->id())],
        ]);

        if ($request->has('avatar')){
            $request->validate([
                'avatar' => ['image', 'mimes:jpg,png,jpeg', 'max:20000'],
            ]);
            $validated['avatar'] = $request->file('avatar')->store('avatar', 's3');;
        }

        auth()->user()->update($validated);

        session()->flash('success', 'User profile updated successfully.');

        return back();
    }
}
