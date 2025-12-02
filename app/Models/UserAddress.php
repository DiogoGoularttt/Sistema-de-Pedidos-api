<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    protected $table = 'user_addresses';

    protected $fillable = [
        'user_id',
        'street_address_id',
        'number',
        'complement',
        'reference',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function streetAddress()
    {
        return $this->belongsTo(StreetAddress::class);
    }
}
