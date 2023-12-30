<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class authController extends Controller
{
    //login Page
    public function loginPage()
    {
        return view('login');
    }

    //register Page 
    public function registerPage(Request $request)
    {  
        return view('register');
    }

    //dashboard
    public function dashboardpage()
    {
        if (Auth::user()->role == 'admin') {
            return redirect()->route('category#list');
        }
        return redirect()->route('user#home');
    }
}
