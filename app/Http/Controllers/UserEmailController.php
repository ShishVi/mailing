<?php

namespace App\Http\Controllers;

use App\Models\UserMailer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserEmailController extends Controller
{
    public function index()
    {
        $user_email = Auth::user()->user_mailer;
        return view('admin.user.email-list', [
            'user_email' => $user_email,
        ]);
    }

    public function create()
    {
        return view('admin.user.create-email');
    }

    public function store(Request $request)
    {
        $request->validate([
            'mail_host' => 'required|min:3',
            'mail_port' => 'required',
            'mail_encryption' => 'required|min:3',
            'mail_username' => 'required|email',
            'mail_password' => 'required',
        ]);

        UserMailer::firstOrCreate([
            'mail_username' => $request->mail_username,
            'user_id' => auth()->user()->id,
        ],[
            'mail_host' => $request->mail_host,
            'mail_port' => $request->mail_port,
            'mail_encryption' => $request->mail_encryption,
            'mail_username' => $request->mail_username,
            'mail_password' => $request->mail_password,
            'user_id' => auth()->user()->id,
        ]);
        return redirect()->route('mailer-list.index')->with('successCreateEmailUser', "Вы успешно зарегистрировали почтовый ящик для рассылки!");
    }

    public function edit($email)
    {

        return view('admin.user.edit-email', [
            'email' => UserMailer::find($email),
        ]);
    }

    public function update(Request $request, $email)
    {
        $request->validate([
            'mail_host' => 'required|min:3',
            'mail_port' => 'required',
            'mail_encryption' => 'required|min:3',
            'mail_username' => 'required|email',
            'mail_password' => 'required',
        ]);

        $email = UserMailer::find($email);

        $email->update($request->all());

        return redirect()->route('mailer-list.index');

    }

    public function destroy($email)
    {
        $email = UserMailer::find($email);
        $email->delete();

        return back();
    }
}
