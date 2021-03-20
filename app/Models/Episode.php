<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Episode extends Model
{
    protected $fillable = ['title', 'air_date'];
   
    public function characters()
    {
        return $this->belongsToMany('App\Models\Character');
    }    
}
