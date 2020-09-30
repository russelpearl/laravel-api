<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CEO extends Model
{
    protected $fillable = [
        'name', 'company_name', 'company_address'
    ];
}