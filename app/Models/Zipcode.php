<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Zipcode extends Model
{
    protected $fillable = ['zipcode', 'city_id', 'street_address_id'];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function streetAddress()
    {
        return $this->belongsTo(StreetAddress::class);
    }
}
