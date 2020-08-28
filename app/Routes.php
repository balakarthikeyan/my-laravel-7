<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model
{
    protected $table = 'routes';

    protected $fillable = ['controller', 'method'];
}