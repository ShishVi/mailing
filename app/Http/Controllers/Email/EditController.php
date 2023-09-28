<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Models\Email;

class EditController extends Controller
{
    public function __invoke($email)
    {

        return view('admin.email.edit-email', [
            'email' => Email::find($email),
        ]);
    }
}
