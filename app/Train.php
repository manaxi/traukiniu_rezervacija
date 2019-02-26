<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Train extends Model
{
    // Table Name
    protected $table = 'trains';

    // Primary Key
    public $primaryKey = 'id';
}
