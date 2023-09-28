<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Models\Email;
use Illuminate\Http\Request;


class StoreController extends Controller
{
    public function __invoke(Request $request)
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
}
