<?php

namespace App\Imports;

use App\Models\Email;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class EmailsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        
        
        $email = new Email();
        return $email::firstOrCreate(
        [
            'email' => $row['email'],
            'user_id' => auth()->user()->id,
        ],
        [
            
            'first_name' => $row['first_name'],
            'last_name' => $row['last_name'],
            'email' => $row['email'],
            'user_id' => auth()->user()->id,
        ]);    
    }
    
}
