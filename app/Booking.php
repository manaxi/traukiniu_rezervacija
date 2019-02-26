<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    // Table Name
    protected $table = 'booking';

    // Primary Key
    public $primaryKey = 'id';
}
