<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    use HasFactory;

     protected $fillable = [
        'user_id',
        'status',
        'notes',
        'path',
        'assunt',
        'user_id',
        'direction'
    ];

    public function user(){
    	return $this->belongsTo(User::class);
    }
}
