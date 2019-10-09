<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Parking extends Model
{
    protected $guarded = [];

    //con esta propiedad puedes seterar parametros por default desde el inicio 
    protected $attributes = [ 
        'cost' => 15.00,
        'rentaltime' => 15.00,
        'waitingtime' => 15.00,
        'validated' => 0
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    //un Scope sirve para hacer una validación rápida de una resultado de una consulta y para 
    //limpiar la forma de verse en la vista 
    // se utiliza en el controller como $var = Parking::Hasgate()->get(); con eso obtendremos el valor y lo traduciremos

    public function scopeHasgate($query){
        return $query->where('Yess', 1);
    }

    // este es un Accesor lo que permite es ir a la base de datos y validar directamente el valor que tiene 
    // para poder regresar un valor
    
    public function getSizeAttribute($size){
        return [
            'S' => 'Pequeño',
            'M' => 'Mediano',
            'L' => 'Grande',
        ][$size];
    }

    public function getHasgateAttribute($hasgate){
        return [
            0 => 'No',
            1 => 'Si',
        ][$hasgate];
    }

    public function schedules(){
        return $this->hasMany(ParkingSchedule::class);
    }
}
