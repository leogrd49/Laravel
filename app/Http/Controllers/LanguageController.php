<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class LanguageController extends Controller
{
    public function change(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'language' => ['required', 'string', 'in:' . implode(',', Config::get('app.available_locales', ['en', 'fr']))],
        ]);

        session()->put('locale', $validated['language']);
        app()->setLocale($validated['language']);

        return redirect()->back()->with('success', __('Language changed successfully'));
    }
}
