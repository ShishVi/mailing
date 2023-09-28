<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Models\Email;

class DestroyController extends Controller
{
    public function __invoke($email)
    {
        $email = Email::find($email);
        $email->delete();

        return back();
    }
}
