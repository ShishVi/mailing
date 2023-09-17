<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

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

        Email::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('index.emails')->with('successCreateEmail', "Вы успешно добавили почту {$request->email}");
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

        return redirect()->route('index.emails');
    }

    public function destroy($emailId)
    {
        $email = Email::find($emailId);
        $email->delete();

        return back();
    }
}