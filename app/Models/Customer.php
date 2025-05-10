<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Office;

class Customer extends Model
{
    public function offices()
    {
        return $this->hasMany(Office::class);
    }
}
