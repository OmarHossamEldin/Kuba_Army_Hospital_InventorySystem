<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'name',
        'username',
        'password',
        'level'
    ];
    protected $hidden=[
        'password',
        'level'
    ];
    
    public function activities(){
    	return $this->hasMany(activity::class);
    }

    public function saftyquestion(){
    	return $this->hasMany(SaftyQuestion::class);
    }
}
