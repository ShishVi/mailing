<?php

namespace App\Http\Controllers\Email;

use App\Http\Controllers\Controller;
use App\Imports\EmailsImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

class ImportController extends Controller
{
    public function __invoke(Request $request)
    {
        $request->validate([
            'file' =>'required',
        ]);        

        Excel::import(new EmailsImport, $request->file);

        return back();
    }
}
