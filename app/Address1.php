<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address1 extends Model
{
    //
    protected $table = 'address';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
