<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Input extends Model
{
    protected $fillable=[
        'id',
        'orgin_number',
        'State',
        'notes'
    ];

    protected $hidden=[
        'orgin_number'
    ];

    public function inputDetails()
    {
        return $this->hasMany(InputDetail::class);
    }
}
