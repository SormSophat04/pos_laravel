<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LanguageController
{
    public function change(Request $request)
    {
        $lang = $request->lang;
        Session::put('locale', $lang);
        return redirect()->back();
    }
}
