<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class manager extends Model
{
    protected $table ='Manager';
    public $primaryKey='m_id';
    public $timestamps=false;

   
}
