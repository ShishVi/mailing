<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Http\Requests\Email\UpdateRequest;
use App\Http\Requests\FilterRequest;
use App\Mail\EmailShipped;
use App\Models\Email;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    public function __invoke(UpdateRequest $request, $email)
    {

        $data = $request->validated();

        $email = Email::find($email);
        $email->update($data);
        //Mail::to($email->email)->send(new EmailShipped($email));

        return redirect()->route('emails.index');
    }
}
