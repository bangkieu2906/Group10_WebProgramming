<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ValidationRequest;
use Illuminate\Validation\Rules\Password;

class ValidateRuleCustomController extends Controller
{
    public function show()
    {
        return view('pages.fregistor');
    }

    public function validateCustom(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Password::min(8)
                    ->mixedCase()
                    ->letters()
                    ->numbers()
                    ->symbols()
                    ->uncompromised(),
            ],
        ]);
        
        return 'You have validated success';
    }
}

