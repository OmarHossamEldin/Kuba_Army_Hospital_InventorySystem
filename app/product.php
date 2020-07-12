<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable=[
        'id',
        'name',
        'category_id',
        'limit',
        'notes'
    ];

    protected $hidden=[
        'category_id',
    ];

    public function category()
    {
        return $this->belongsTo(category::class);
    }

    public function stock()
    {
        return $this->hasOne(stock_balance::class,'product_id');
    }

}
