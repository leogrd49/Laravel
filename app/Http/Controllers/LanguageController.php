<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class LanguageController extends Controller
{
    public function change(Request $request): RedirectResponse
    {
        $availableLocales = Config::get('app.available_locales', ['en', 'fr']);

        if (! is_array($availableLocales)) {
            $availableLocales = ['en', 'fr']; // fallback to default if not an array
        }

        $validated = $request->validate([
            'language' => ['required', 'string', 'in:'.implode(',', $availableLocales)],
        ]);

        session()->put('locale', $validated['language']);
        app()->setLocale($validated['language']);

        return redirect()->back()->with('success', __('Language changed successfully'));
    }
}
