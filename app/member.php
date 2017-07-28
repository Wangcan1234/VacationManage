<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Member extends Model
{
    protected $table='user';
    protected $primaryKey='id';
}