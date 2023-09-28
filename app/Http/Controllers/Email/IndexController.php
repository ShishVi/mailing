<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Models\Email;

class IndexController extends Controller
{
    public function __invoke()
    {
        return view('admin.email.list-emails', [
            'emails'=> Email::where('user_id', auth()->user()->id)->paginate(3),
        ]);
    }
}
