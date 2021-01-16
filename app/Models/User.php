<?php

namespace App\Models;

use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    use CascadeSoftDeletes;
    protected $cascadeDeletes = ['notes'];


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_fixo',
        'whatsapp',
        'sendFile'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function arquivos(){
        return $this->hasMany(User::class);
    }
    public function level()
    {
        return $this->belongsTo(Level::class);
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class);
    }
    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function scopeListAdm($query){
            return $query->where('level_id','>', '2');
    }

    public function scopeListUser($query)
    {
        return $query->where('level_id', '<=', '2');
    }


}
