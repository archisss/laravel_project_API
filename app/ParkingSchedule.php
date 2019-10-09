<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ParkingSchedule extends Model
{
    protected $guarded = [];

    protected $primaryKey = 'parking_id'; 
    
    // se cambio el ID primario para que la relación de el estacionamiento tiene parkings funcione porque de otra manera toamaba el id como campo del parking
    // la relación es 1 parking tiene muchos horarios 

    public function parking(){
        return $this->belongsTo(Parking::class);
    }

    public function getActiveAttribute($hasgate){
        return [
            0 => 'No Disponible',
            1 => 'Disponible',
        ][$hasgate];
    }
}
