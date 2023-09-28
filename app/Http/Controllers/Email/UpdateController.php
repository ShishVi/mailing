<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Mail\EmailShipped;
use App\Models\Email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(Request $request, $email)
    {
        $request->validate([
            'first_name' => 'required|min:3',
            'email' => 'required|email',
        ]);

        $email = Email::find($email);
        $email->update($request->all());
        Mail::to($email->email)->send(new EmailShipped());

        return redirect()->route('emails.index');
    }
}
