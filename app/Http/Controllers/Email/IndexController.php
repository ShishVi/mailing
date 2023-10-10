<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Http\Filters\EmailFilter;
use App\Http\Requests\Email\FilterRequest;
use App\Models\Email;

class IndexController extends Controller
{
    public function __invoke(FilterRequest $request)
    {


       $data = $request->validated();

        /* $filter = app()->make(EmailFilter::class, ['queryParams' => array_filter($data)]);

        $emails = Email::where('user_id', auth()->user()->id)->filter($filter)->get();
        dd($emails); */

       return view('admin.email.list-emails', [
           'emails'=> Email::where('user_id', auth()->user()->id)->paginate(5),
       ]);
    }
}
