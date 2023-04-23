<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'card_number',
        'card_number_two_last_digits',
        'cardholder_name',
        'cvv',
        'expiration_month',
        'expiration_year',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
