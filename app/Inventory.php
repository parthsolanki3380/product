<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{

    protected $table = 'inventorys';
    protected $primaryKey = 'id';
    protected $guarded = ['id'];
}
