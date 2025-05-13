<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Add extends Model
{
    //
    protected $table = 'add';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
