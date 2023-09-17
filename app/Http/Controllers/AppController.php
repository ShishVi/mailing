<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{
   public function mainPage()
   {
        return view('admin.main-page');
   }
}
