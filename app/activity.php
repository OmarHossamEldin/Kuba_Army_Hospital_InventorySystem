<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class activity extends Model
{
    protected $fillable =[
        'user_id',
        'action',
        'description'
    ];
    
    public function user(){
        return $this->belongsTo(User::class);
    }
}
