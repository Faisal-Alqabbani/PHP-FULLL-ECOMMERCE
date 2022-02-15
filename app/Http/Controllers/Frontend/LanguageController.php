<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    //
    public function Arabic(){
        session()->get('language');
        session()->forget('language');
        Session::put('language','arabic');
        return Redirect()->back();
    }
    public function English(){
        session()->get('language');
        session()->forget('language');
        Session::put('language','english');
        return Redirect()->back(); 
    }
}
