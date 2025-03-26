<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class ThemeController extends Controller
{
    public function update(Request $request) {
        $user = Auth::user();
        if ($user) {
            $user->update(['theme' => $request->theme]);
        }
        session(['theme' => $request->theme]);
        return response()->json(['message' => 'Theme updated']);
    }
}
