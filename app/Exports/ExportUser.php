<?php

namespace App\Exports;
use App\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ExportUser implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function headings(): array
    {
    	return [
    		'Name',
    		'Email',
    		'gender',
            'image',
            'show_password'
    	];
    }
    public function collection()
    {
    	$data = User::get();
    	foreach($data as $key=>$value)
    	{
            $value->gender = $value->gender == 1 ? 'Male' : ($value->gender == 2 ? 'Female' : '-');
            
            unset($data[$key]['id'],$data[$key]['password'],$data[$key]['email_verified_at'],$data[$key]['status'],$data[$key]['remember_token'],$data[$key]['created_at'],$data[$key]['updated_at']);
        }	
    
        return $data;
    }
}
