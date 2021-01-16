<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tenant extends Model
{
    use HasFactory;
    use SoftDeletes;
    use CascadeSoftDeletes;
    protected $cascadeDeletes = ['users'];

    public function user(){

        return $this->hasMany(User::class);
    }

    public function scopeAtivos($query){
        return $query->orderBy('name');
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

}
