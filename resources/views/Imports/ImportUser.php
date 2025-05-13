<?php

namespace App\Imports;

use App\User;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str; // Import Str class from Illuminate\Support
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class ImportUser implements ToModel, WithHeadingRow, WithValidation
{
    public function model(array $row)
    {
        $data = User::where('name', $row['name'])->first();

        if (!$data) {
            return new User([
                'name' => $row['name'],
                'email' => $row['email'],
                'gender' => $row['gender'] == 1 ? 'male' : ($row['gender'] == 2 ? 'female' : null),
                'image' => $row['image'],
                'password' => isset($row['password']) ? bcrypt($row['password']) : bcrypt(Str::random(16)) // Use Str::random(16) for generating random password
            ]);
        } else {
            $data->name = $row['name'];
            $data->email = $row['email'];
            $data->gender = $row['gender'] == 'male' ? 1 : ($row['gender'] == 'female' ? 2 : null);
            $data->password = isset($row['password']) ? bcrypt($row['password']) : bcrypt(Str::random(16));
           
            $data->save();

            return $data;
        }
    }

    public function rules(): array
    {
        return [
            '*.name' => 'required',
        ];
    }
}