<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Description extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'description',
        'details',
        'color',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'description_size')->withPivot('stock');
    }
}
