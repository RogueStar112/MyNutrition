<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ChangelogController extends Controller
{
    public function changelog_view() {

        return view('changelog');
    }
}
