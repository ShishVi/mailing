<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Http\Requests\Email\StoreRequest;
use App\Http\Requests\FilterRequest;
use App\Models\Email;
use Illuminate\Http\Request;


class StoreController extends Controller
{
    public function __invoke(StoreRequest $request)    {

        $data = $request->validated();
        Email::firstOrCreate([
            'email' => $data['email'],
            'user_id' => auth()->user()->id,
        ],
        [
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'user_id' => auth()->user()->id,
        ]);

        return redirect()->route('emails.index')->with('successCreateEmail', "Вы успешно добавили почту {$request->email}");
    }
}
