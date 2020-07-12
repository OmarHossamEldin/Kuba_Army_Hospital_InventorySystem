<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SaftyQuestion extends Model
{
    protected $fillable = [
        'user_id',
        'key',
        'answer'
    ];

    protected $hidden = [
        'user_id',
        'key'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
