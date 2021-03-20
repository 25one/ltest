<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Character extends Model
{
    protected $fillable = ['name', 'birthday', 'occupations', 'img', 'nickname', 'portrayed'];

    public function quotes()
    {
        return $this->hasMany('App\Models\Quote')->select(['id', 'character_id', 'episode_id', 'quote']);
    }
}
