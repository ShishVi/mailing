<?php

namespace App\Http\Controllers;

use App\Imports\EmailsImport;
use App\Mail\EmailShipped;
use App\Models\Email;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Maatwebsite\Excel\Facades\Excel;

class EmailController extends Controller
{
    public function index()
    {
        return view('admin.email.list-emails', [
            'emails'=> Email::where('user_id', auth()->user()->id)->get(),
        ]);
    }

    public function create()
    {
        return view('admin.email.create-email');
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|min:3',
            'email' => 'required|email'
        ]);

        Email::firstOrCreate([
            'email' => $request->email,
            'user_id' => auth()->user()->id,
        ],
        [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('emails.index')->with('successCreateEmail', "Вы успешно добавили почту {$request->email}");
    }

    public function edit($emailId)
    {
        return view('admin.email.edit-email', [
            'email' => Email::find($emailId),
        ]);
    }

    public function update(Request $request, $emailId)
    {
        $request->validate([
            'first_name' => 'required|min:3',
            'email' => 'required|email',
        ]);

        $email = Email::find($emailId);
        $email->update($request->all());

        return redirect()->route('emails.index');
    }

    public function destroy($emailId)
    {
        $email = Email::find($emailId);
        $email->delete();

        return back();
    }

    public function emailImport(Request $request)
    {
        $request->validate([
            'file' =>'required',
        ]);

        Excel::import(new EmailsImport, $request->file);

        return back();

    }

}
