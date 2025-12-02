<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = ['name', 'state_id', 'zipcode_id'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function neighborhoods()
    {
        return $this->hasMany(Neighborhood::class);
    }

    public function zipcode()
    {
        return $this->belongsTo(Zipcode::class);
    }
}
