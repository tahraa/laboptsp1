<?php

namespace App\Imports;


use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Hash;
use App\User;
class UserImport implements ToModel,WithHeadingRow
{

    public function model(array $row)
    {
        return new User([
            'name'=>$row['name'],
            'email'=>$row['email'],
            'password'=> Hash::make($row['password']),
            'profile'=>$row['profile'],
        ]);
    }
}
