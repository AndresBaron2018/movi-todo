<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'model', 'year', 'vehicle_color', 'license_plate', 'driver',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function trip()
    {
        return $this->belongsTo(Trip::class, 'id');
    }

    public function users()
    {
        return $this->hasMany('\App\User', 'user_trip_vehicle')
            ->withPivot('trip_id', 'status');
    }

    public function trips()
    {
        return $this->belongsTo('\App\Trip', 'user_trip_vehicle')
            ->withPivot('user_id', 'status');
    }
}
