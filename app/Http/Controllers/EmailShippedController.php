<?php

namespace App\Http\Controllers;

use App\Mail\EmailShipped;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class EmailShippedController extends Controller
{
    public function create()
    {
        return view('admin.email.create-message-email', [
            'emails' => Email::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function shippedEmail(Request $request)

    {

        $request->validate([
            'subject_email' => 'required|min:3',
            'to_email' => 'required',
            'email_text' => 'required|min:3',
        ]);

        dd($request->to_email);


        foreach($request->to_email as $email_id)
        {
            $email = Email::find($email_id);
            Mail::to($email->email)->queue(new EmailShipped($email, $request->subject_email, $request->email_text));
        }
        return redirect()->route('emails.index')->with('successCreateEmail', "Вы успешно отправили письма");
    }
}
