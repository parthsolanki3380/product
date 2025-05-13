<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sells extends Model
{
    protected $table = 'sells';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
