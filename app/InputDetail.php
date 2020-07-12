<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InputDetail extends Model
{
    protected $fillable=[
        'input_id',
        'product_id',
        'quantity'
    ];

    public function input(){
        return $this->belongsTo(Input::class);
    }
    public function product(){
        return $this->belongsTo(product::class);
    }
}
