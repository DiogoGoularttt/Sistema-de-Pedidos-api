<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StreetAddress extends Model
{
    protected $fillable = ['street_name', 'neighborhood_id', 'zipcode_id'];

    public function neighborhood()
    {
        return $this->belongsTo(Neighborhood::class);
    }

    public function zipcode()
    {
        return $this->belongsTo(Zipcode::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_addresses')
            ->withPivot(['number', 'complement', 'reference'])
            ->withTimestamps();
    }
}
