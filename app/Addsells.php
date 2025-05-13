<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Addsells extends Model
{
    protected $table = 'addsells';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
