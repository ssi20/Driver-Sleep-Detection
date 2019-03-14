<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class session extends Model
{
    protected $table ='session';
    public $primaryKey='s_id';
    public $timestamps=false;

   
}
