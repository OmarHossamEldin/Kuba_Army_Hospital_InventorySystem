<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Output extends Model
{
    protected $guarded=[];

    public function OutputDetails()
    {
        return $this->hasMany(OutputDetail::class);
    }
}
