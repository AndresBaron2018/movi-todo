<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'general_load', 'date', 'vehicle', 'money_advance', 'tons',  'feeding', 'Toll', 'fuel', 'other', 'driver', 'tour_driver'
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id');
    }

    public function vehicle()
    {
        return $this->toMany(Vehicle::class, 'id');
    }

    public function users()
    {
        return $this->belongsToMany('\App\User', 'user_trip_vehicle')
            ->withPivot('vehicle_id', 'status');
    }
    // public function vehicles()
    // {
    //     return $this->belongsTo('\App\Vehicle', 'user_trip_vehicle')
    //         ->withPivot('user_id', 'status');
    // }
}
