<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    protected $guarded = [];

    /*protected $appends = [
        'rental_status',
    ];*/

    protected $attributes = [ 
        'start_time' => '00:00:00',
        'end_time' => '00:00:00',
        'total_time' => '00:00:00',
        'rental_status' => 'waiting',
    ];

    /*public function getrental_statusAttribute($rental_status){
        return [
            'closed' => 'Cobrado',
            'charging' => 'En cobranza',
            'timing' => 'Calculando costos',
            'busy' => 'Ocupado',
            'available' => 'Disponible',
            'waiting' => 'En espera',
        ][$rental_status];
    }*/

    public function user(){
        return $this->belongsTo(User::class);
    }
}
