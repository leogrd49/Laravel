<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function change(Request $request)
    {
        $validated = $request->validate([
            'language' => 'required|in:en,fr',
        ]);

        session()->put('locale', $validated['language']);

        return redirect()->back();
    }
}
