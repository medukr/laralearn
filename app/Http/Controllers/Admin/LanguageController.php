<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cookie;

class LanguageController extends Controller
{
    public function change($locale)
    {

        if ($locale != 'en' && $locale != 'ru') return abort(404);

        Cookie::queue('lang', $locale);

        return redirect('/admin');
    }
}
