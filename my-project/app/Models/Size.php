<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    public function descriptions()
    {
        return $this->belongsToMany(Description::class, 'description_size');
    }
}
