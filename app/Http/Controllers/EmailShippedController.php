<?php

namespace App\Http\Controllers;

use App\Jobs\MailSendJob;
use App\Mail\EmailShipped;
use App\Models\Email;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
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
        $user = User::find(auth()->user()->id);

        $request->validate([
            'subject_email' => 'required|min:3',
            'to_email' => 'required',
            'email_text' => 'required|min:3',
        ]);

        MailSendJob::dispatch($user, $request->all());


        return redirect()->route('emails.index')->with('successCreateEmail', "Вы успешно отправили письма");
    }
}
