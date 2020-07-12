<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OutputDetail extends Model
{
    protected $guarded=[];

    public function Output()
    {
        return $this->belongsTo(Output::class);
    }
    public function product(){
        return $this->belongsTo(product::class);
    }
}
